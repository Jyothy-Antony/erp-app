<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
      'order_no',
      'order_date',
      'net_amount',
      'discount',
      'supplier_id',
      'item_total'
  ];

    public function supplier()
    {
      return $this->belongsTo(Supplier::class, 'supplier_id','id');
    }

    public function items()
    {
      return $this->hasMany(PurchaseOrderItem::class,'purchase_order_id','id');
    }
}
