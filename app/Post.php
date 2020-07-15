<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'thumbnail', 'status', 'view_count', 'user_id'
    ];

    protected $appends = ['image_url', 'created'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getImageUrlAttribute()
    {
        return env('APP_URL') . '/storage/uploads/thumbs/' . $this->thumbnail;
    }
}
