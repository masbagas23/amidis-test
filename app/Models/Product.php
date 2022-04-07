<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'stock',
        'unit',
        'location_id'
    ];

    // Pivot to RequestTransaction
    public function requestTransactions()
    {
        return $this->belongsToMany(RequestTransaction::class, 'product_request_transactions');
    }

    // Relationship to Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
}
