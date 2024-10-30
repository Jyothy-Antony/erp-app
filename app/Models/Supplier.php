<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'email',
        'tax_no',
        'supplier_no',
        'country',
        'mobile',
        'status'
    ];

    public function countries()
    {
      return $this->belongsTo(Country::class, 'country','id');
    }

    public function scopeActiveSupplier($query)
    {
        return $query->where('status', 'ACTIVE');
    }

}
