<?php


namespace App\Repositories\Phone;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Phone\Phone;

class PhoneRepository extends AbstractRepository
{

    public function __construct()
    {
        $this->setModel(Phone::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getLast()
    {
        return $this->getModel()
            ::orderByDesc('id')
            ->limit(1)
            ->get();
    }

}
