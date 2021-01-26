<?php

namespace App\Http\Controllers;

use App\Services\Sales\SalesService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $userService;
    private $salesService;

    /**
     * HomeController constructor.
     * @param UserService $userService
     * @param SalesService $salesService
     */
    public function __construct(UserService $userService , SalesService $salesService)
    {
        $this->userService = $userService;
        $this->salesService = $salesService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $sales = $this->salesService
            ->getAllByUser($user->id);

        if(count($sales) !== 0){
            foreach ($sales as $sale) {
                $sales_grouped[$sale->sale_id][] = $sale;
            }
            return view('home.home')->with(['sales' => $sales_grouped]);
        }
        return view('home.home')->with(['sales' => $sales]);

    }

}
