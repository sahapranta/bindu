<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        "title",
        "status",
        "description",
        "pdf",
        "thumbnail",
        "slug",
        "download_count",
        "reader_count",
        "user_id"
    ];

    protected $appends = ['image_url', 'pdf_url'];

    public function user()
    {
        return $this->belongsTo('App\User');
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
