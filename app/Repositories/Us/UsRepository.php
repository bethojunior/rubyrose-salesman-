<?php


namespace App\Repositories\Us;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Us\Us;

class UsRepository extends AbstractRepository
{
    /**
     * UsRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(Us::class);
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
