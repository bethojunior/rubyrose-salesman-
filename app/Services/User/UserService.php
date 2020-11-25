<?php


namespace App\Services\User;


use App\Constants\UserConstant;
use App\Constants\UserStatusConstant;
use App\Http\Responses\ApiResponse;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(){
        return $this->repository->findAll();
    }

    /**
     * @return mixed
     */
    public function getAllSalesMan(){
        return $this->repository->findAllSalesMan();
    }

    /**
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update(array $request)
    {
        $result = $this->repository->find($request['id']);
        $result->update($request);
        return $result;
    }

    /**
     * @param array $request
     * @return User
     * @throws \Exception
     */
    public function insertUser(array $request)
    {
        try{
            DB::beginTransaction();

            $data = [
                'name'              => $request['name'],
                'email'             => $request['email'],
                'phone'             => $request['phone'],
                'user_type_id'      => $request['user_type_id'],
                'user_status_id'    => UserStatusConstant::ACTIVE,
                'password'          => Hash::make($request['password']),
            ];

            $user = new User($data);

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

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

}
