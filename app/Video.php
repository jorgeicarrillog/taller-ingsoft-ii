<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'description', 'category', 'status', 'duration',
    ];

    /**
     * Get the user associated with the new.
     */
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    
}
