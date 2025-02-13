<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

/*    protected $casts = [
        'bundle_entries' => 'array',
    ];*/


    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Product::class, 'product_bundle_pivot', 'product_bundle_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }



}
