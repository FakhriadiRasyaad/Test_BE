<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'topic_id', 'language_id', 'created_by_id',
        'title', 'description', 'short_description',
        'price', 'discount_rate', 'thumbnail_url', 'level'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}