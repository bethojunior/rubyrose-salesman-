<?php


namespace App\Models\Products;


use App\Models\TypeProduct\TypeProduct;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['name','type_product_id','description','value','promotional_value','minimum_order','status','color'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type()
    {
        return $this->hasMany(TypeProduct::class,'id');
    }
}
