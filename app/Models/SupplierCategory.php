<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
