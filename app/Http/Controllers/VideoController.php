<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Video;

class VideoController extends Controller
{

    /**
     * list videos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $query = Video::select('*');
        }else{
            $query = Video::where('status',1);
        }
        $videos = $query->orderBy('created_at','desc')->paginate(10);

        return view('video.index')->with(compact('videos'));
    }

    /**
     * create video.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('video.create');
    }

    /**
	 * Store a new video post.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'name' => 'required|unique:videos|max:255|min:5',
	        'description' => 'required|max:255|min:2',
	        'category' => 'required|max:255',
	        'status' => 'required|integer:min:0|max:2',
	        'image' => 'required|image|mimes:jpeg,jpg,png',
	        'video' => 'required|mimes:mp4,mpg4',
	    ]);

	    $video = new Video();
        $video->fill($request->except(['image','video']));
        $video->user_id = auth()->id();
        $nameFile = \Uuid::generate()->string;
        $pathImage=$request->image->storeAs('public/images', $nameFile.'.'.$request->image->extension());
        $pathVideo=$request->video->storeAs('public/videos', $nameFile.'.'.$request->video->extension());
        $video->image = $pathImage;
        $video->video = $pathVideo;

        if ($video->save()) {
            return redirect()->route('videos.index')->withStatus('Video Guardado correctamente.');
        }
        return redirect()->back()->withErrors(['Ocurrio algo intenta de nuevo.']);

	}
}
