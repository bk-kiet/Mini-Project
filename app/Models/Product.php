<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'sku'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function itemBundles(): BelongsToMany
    {
        return $this->belongsToMany(ItemBundle::class, 'product_bundle_pivot', 'product_id', 'item_bundle_id');
    }
}
