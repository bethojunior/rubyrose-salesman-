<?php


namespace App\Repositories\TypeProduct;


use App\Contracts\Repository\AbstractRepository;
use App\Models\TypeProduct\TypeProduct;

class TypeProductRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(TypeProduct::class);
    }
}
