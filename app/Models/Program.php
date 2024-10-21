<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'points',
        'start_date',
        'end_date',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'program_products');
    }
}
