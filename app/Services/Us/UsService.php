<?php


namespace App\Services\Us;


use App\Models\Us\Us;
use App\Repositories\Us\UsRepository;
use Illuminate\Support\Facades\DB;

class UsService
{
    private $repository;

    /**
     * UsService constructor.
     * @param UsRepository $repository
     */
    public function __construct(UsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLast()
    {
        return $this->repository
            ->getLast();
    }

    /**
     * @param array $request
     * @return Us
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            DB::beginTransaction();

            $us = new Us($request);

            $us->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $us;
    }

}
