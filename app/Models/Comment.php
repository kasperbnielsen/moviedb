<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentsId',
        'movieId',
        'userId',
        'body'
    ];

    protected $primaryKey = 'commentsId';

    protected $keyType = 'string';
}
