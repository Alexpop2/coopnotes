<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'users_accessed',
        'content',
    ];

    protected $attributes = [
        'users_accessed' => '{}'
    ];

    protected $casts = [
        'users_accessed' => 'json',
    ];
}
