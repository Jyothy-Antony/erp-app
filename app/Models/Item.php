<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inventory_location',
        'brand',
        'category',
        'supplier_id',
        'item_no',
        'stock_unit',
        'unit_price',
        'status'
    ];

    public function images()
    {
      return $this->hasMany(ItemImage::class,'item_id','id');
    }

    public function supplier()
    {
      return $this->belongsTo(Supplier::class, 'supplier_id','id');
    }

    public function scopeActiveItem($query)
    {
        return $query->where('status', 'ENABLED');
    }
}
