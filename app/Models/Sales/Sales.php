<?php


namespace App\Models\Sales;


use App\Models\Products\Products;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['amount','product_id','user_id','status','sale_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Products::class,'id','product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }
}
