<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_idx', 'user_name', 'title', 'content'];

    // get user_name
    public function getUserNameAttribute($value)
    {
        return $value ?? '나';
    }
}
