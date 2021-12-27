<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function parents()
    {
        return $this->belongsToMany(Category::class, 'categories_categories', 'parent_id', 'child_id');
    }

    public function childs()
    {
        return $this->belongsToMany(Category::class, 'categories_categories', 'child_id', 'parent_id');
    }
}
