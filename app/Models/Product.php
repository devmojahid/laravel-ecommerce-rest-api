<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
    use HasFactory;

    protected $fillable =[
        'title',
        'slug',
        'summary',
        'description',
        'image',
        'stock',
        'price',
        'sale_price',
        'discount',
        'weight',
        'category_id',
        'subcategory_id',
        'brand_id',
        'user_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }


}
