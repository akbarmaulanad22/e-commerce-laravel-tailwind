<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Product extends Model
{
    use HasFactory, Searchable;

    protected $table = 'products';
    protected $guarded = ['id'];
    protected $with = ['user', 'category'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function  sizes(){
        return $this->belongsToMany(Size::class);
    }
}
