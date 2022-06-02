<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier_category()
    {
        return $this->belongsTo(SupplierCategory::class);
    }
    public function special_category()
    {
        return $this->belongsTo(SpecialCategory::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
