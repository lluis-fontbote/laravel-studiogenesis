<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function getAllCategoriesIDs()
    {
        $categories = $this->categories;
        $arrayIDs = [];
        foreach ($categories as $category) {
            array_push($arrayIDs, $category->id);
        }

        return implode(',', $arrayIDs);
    }
}
