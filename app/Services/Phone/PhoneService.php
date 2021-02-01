<?php


namespace App\Services\Phone;


use App\Models\Phone\Phone;
use App\Repositories\Phone\PhoneRepository;
use Illuminate\Support\Facades\DB;

class PhoneService
{
    private $repository;

    /**
     * PhoneService constructor.
     * @param PhoneRepository $repository
     */
    public function __construct(PhoneRepository $repository)
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
     * @return Phone
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            DB::beginTransaction();

            $us = new Phone($request);

            $us->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $us;
    }
}
