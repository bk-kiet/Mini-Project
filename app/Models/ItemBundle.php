<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBundle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'item_bundles'];

    /*   protected $casts = [
           'items' => 'array',
       ];*/

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Product::class, 'product_bundle_pivot', 'item_bundle_id', 'product_id');
    }
}
