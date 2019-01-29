<?php

namespace App;

use App\Contracts\Product;

class Payment extends Metropolis
{
	protected $with = ['product'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function product()
    {
    	return $this->morphTo();
    }

    public function scopeRecord($query, Product $product = null)
    {
        if ($product && ! $this->byCode($product->transaction_code)->exists()) {
        	return $this->create([
        		'user_id' => $product->creator_id,
        		'product_id' => $product->id,
        		'product_type' => get_class($product),
        		'transaction_code' => $product->transaction_code
        	]);
        }
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('transaction_code', $code);
    }
}
