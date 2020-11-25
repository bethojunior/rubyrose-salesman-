<?php

namespace App\Repositories\User;

use App\Constants\UserConstant;
use App\Contracts\Repository\AbstractRepository;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends AbstractRepository
{

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(User::class);
    }

    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findAll(){
        return $this->getModel()
            ::with('userStatus')
            ->with('userType')
            ->orderByDesc('users.id')
            ->get();
    }

    /**
     * @return mixed
     */
    public function findAllSalesMan(){
        return $this->getModel()
            ::with('userStatus')
            ->where('user_type_id','=',UserConstant::REVENDEDORA)
            ->count('id');
    }


}
