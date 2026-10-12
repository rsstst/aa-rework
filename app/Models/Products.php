<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = ['name', 'description', 'price', 'category', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (Products $product): void {
            if ($product->isDirty('name') || blank($product->slug)) {
                $product->slug = static::makeUniqueSlug($product->name, $product->id);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    private static function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'produk';
        $slug = $baseSlug;
        $suffix = 2;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
