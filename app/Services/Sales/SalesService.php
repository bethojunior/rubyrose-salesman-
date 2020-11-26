<?php


namespace App\Services\Sales;


use App\Constants\SalesStatus;
use App\Models\Sales\Sales;
use App\Repositories\Sales\SalesRepository;
use Illuminate\Support\Facades\DB;

class SalesService
{
    private $repository;

    /**
     * SalesService constructor.
     * @param SalesRepository $repository
     */
    public function __construct(SalesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(){
        return $this->repository->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByUser($id){
        return $this->repository->getAllByUser($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByUserSalesNull($id){
        return $this->repository->getAllByUserSalesNull($id);
    }

    /**
     * @param array $request
     * @return Sales
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            $saleId = [];
            DB::beginTransaction();
            foreach ($request['data'] as $data){
                $data['status'] = SalesStatus::EM_ABERTO;
                $sale = new Sales($data);
                $sale->save();
                array_push($saleId,$sale->id);
                $sale->update(['sale_id' => $saleId[0]]);
//
//                $sale->sale_id = $sale->id;
//                $this->repository->update($sale);
            }

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $sale;
    }

}
