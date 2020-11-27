<?php


namespace App\Repositories\Products;


use App\Constants\ProductStatus;
use App\Contracts\Repository\AbstractRepository;
use App\Models\Products\Products;

class ProductsRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Products::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findAll()
    {
        return $this->getModel()
            ::with('images')
            ->with('type')
            ->where('status','=',ProductStatus::ATIVO)
            ->get();
    }
}
