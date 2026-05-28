<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'category', 'price', 'discount',
        'condition', 'stock', 'location', 'sold_count', 'rating',
        'image', 'wa_link'
    ];

    protected $casts = [
        'price' => 'integer',
        'discount' => 'integer',
        'stock' => 'integer',
        'sold_count' => 'integer',
        'rating' => 'float',
    ];

    public function getDiscountedPriceAttribute()
    {
        if ($this->discount && $this->discount > 0) {
            return $this->price - ($this->price * $this->discount / 100);
        }
        return $this->price;
    }
}
