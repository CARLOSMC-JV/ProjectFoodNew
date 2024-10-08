<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
