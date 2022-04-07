<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status'
    ];

    // Pivot to Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_request_transactions');
    }

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
