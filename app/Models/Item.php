<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['picture', 'name', 'price'];
    // Add other fillable columns if necessary

    public function users() {
        return $this->belongsToMany(User::class, 'cart', 'item_id', 'user_id')
            ->withPivot('quantity');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
