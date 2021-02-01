<?php


namespace App\Http\Controllers\Us;


use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\Phone\PhoneService;
use App\Services\Us\UsService;
use Illuminate\Http\Request;

class UsController extends Controller
{

    private $service;

    public function __construct(UsService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $us = $this->service
            ->getLast();
        return view('home.us')->with(['us' => $us]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try{
            $insert = $this
                ->service
                ->create($request->all());
        }catch (\Exception $exception){
            return redirect()->route('us.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('us.index')
            ->with('success', 'Inserido com sucesso');
    }

    /**
     * @param PhoneService $phoneService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPhone(PhoneService $phoneService)
    {
        try{
            $phone = $phoneService->getLast();
        }catch (\Exception $exception)
        {
            return ApiResponse::error('',$exception->getMessage());
        }
        return ApiResponse::success($phone[0],'');
    }

}
