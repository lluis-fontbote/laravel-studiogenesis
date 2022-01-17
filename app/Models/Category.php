<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_parent'
    ];

    public function parents()
    {
        return $this->belongsToMany(Category::class, 'categories_categories', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(Category::class, 'categories_categories', 'parent_id', 'child_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getAllChildrenIDs()
    {
        $children = $this->children;
        $arrayIDs = [];
        foreach ($children as $child) {
            array_push($arrayIDs, $child->id);
        }

        return implode(',', $arrayIDs);
    }

    public function getAllParentsIDs()
    {
        $parents = $this->parents;
        $arrayIDs = [];
        foreach ($parents as $parent) {
            array_push($arrayIDs, $parent->id);
        }

        return implode(',', $arrayIDs);
    }
}
