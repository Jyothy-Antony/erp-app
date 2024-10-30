<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'purchase_order_id',
        'net_amount',
        'discount',
        'supplier_id',
        'item_total',
        'quantity',
        'packing_unit'
      ];

    public function item()
    {
      return $this->belongsTo(Item::class, 'item_id','id');
    }
}
