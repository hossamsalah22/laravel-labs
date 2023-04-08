<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected function getHumanReadableDateAttribute()
    {
        return $this->created_at->format('j-F-Y, g:i A');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
