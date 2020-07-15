<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        "name", "mobile", "email", "address", "status", "user_id"
    ];

    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['created', 'updated'];

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
