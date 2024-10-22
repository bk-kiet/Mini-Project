<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Testing\Fluent\Concerns\Interaction;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Product extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;


/*    protected $casts = [
        'price' => 'decimal:2',
    ];*/

    protected $fillable = [
        'name',  // Add 'name' to allow mass assignment
        'sku',
        'category_id',
        'price',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function images()
    {
        return $this->morphMany(Media::class, 'model ');
    }

    public function registerMediaCollections(): void
    {
        // a collection for a single image
     //   $this->addMediaCollection('images')->singleFile();
        $this->addMediaCollection('images')
            ->useFallbackUrl('/path-to-placeholder-image.jpg')
            ->useFallbackPath(public_path('/path-to-placeholder-image.jpg'))
            ->useDisk('public');
    }


    public function itemBundles(): BelongsToMany
    {
        return $this->belongsToMany(ProductBundle::class, 'product_bundle_pivot', 'product_id', 'product_bundle_id');
    }
}
