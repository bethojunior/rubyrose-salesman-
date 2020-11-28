<?php


namespace App\Http\Controllers\Sales;


use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\Sales\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    private $service;

    /**
     * SalesController constructor.
     * @param SalesService $salesService
     */
    public function __construct(SalesService $salesService)
    {
        $this->service = $salesService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try{
            $response = $this
                ->service
                ->create($request->all());
        }catch (\Exception $exception){
            return ApiResponse::error('',$exception->getMessage());
        }
        return ApiResponse::success($response,'Inserido com sucesso');
    }

}
