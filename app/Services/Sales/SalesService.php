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
     * @param array $request
     * @return Sales
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            DB::beginTransaction();

            foreach ($request['data'] as $data){
                $data['status'] = SalesStatus::EM_ABERTO;
                $user = new Sales($data);
                $user->save();
            }
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $user;
    }

}
