<?php


namespace App\Services\TypeProduct;


use App\Repositories\TypeProduct\TypeProductRepository;
use Illuminate\Support\Facades\DB;

class TypeProductService
{
    /**
     * @var TypeProductRepository
     */
    private $repository;

    /**
     * TypeProductService constructor.
     * @param TypeProductRepository $repository
     */

    public function __construct(TypeProductRepository $repository)
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
     * @param array $request
     * @return \App\Models\TypeProduct\TypeProduct
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            DB::beginTransaction();

            $user = new \App\Models\TypeProduct\TypeProduct($request);

            $user->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $user;
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $result = $this->repository->find($id);
            $result->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return $result;
    }
}
