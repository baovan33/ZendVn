<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'feature_image_path',
        'content',
        'category_id',
        'user_id',
        'feature_image_name'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tags',
            'product_id',
            'tag_id'
        )->withTimestamps();
    }
}
