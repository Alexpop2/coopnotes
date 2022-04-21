<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'note_id',
    ];

    public function note() {
        return $this->belongsTo(Note::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
