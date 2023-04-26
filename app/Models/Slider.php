<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'link',
        'user_id',
        'thumb'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
