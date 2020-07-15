<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'price', 'pdf', 'thumbnail', 'status', 'download_count', 'view_count', 'user_id'
    ];

    protected $appends = ['image_url', 'pdf_url'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function review()
    {
        return $this->hasMany('App\Review');
    }

    public function getImageUrlAttribute()
    {
        return env('APP_URL') . '/storage/uploads/thumbs/' . $this->thumbnail;
    }

    public function getPdfUrlAttribute()
    {
        return env('APP_URL') . '/storage/uploads/pdf/' . $this->pdf;
    }
}
