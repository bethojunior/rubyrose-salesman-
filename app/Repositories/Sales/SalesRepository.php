<?php


namespace App\Repositories\Sales;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Sales\Sales;

class SalesRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Sales::class);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByUser($id)
    {
        return $this->getModel()
            ::with('products')
            ->with('user')
            ->where('user_id','=',$id)
            ->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByUserSalesNull($id)
    {
        return $this->getModel()
            ::with('products')
            ->with('user')
            ->where('user_id','=',$id)
            ->where('sale_id','=',0)
            ->get();
    }
}
