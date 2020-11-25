<?php


namespace App\Repositories\Products;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Products\ProductImage;

class ProductsImageRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(ProductImage::class);
    }
}
