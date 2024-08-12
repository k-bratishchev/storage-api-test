<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    public function operations() {
        return $this->hasMany(Operation::class);
    }
}
