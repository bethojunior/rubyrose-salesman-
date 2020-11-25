<?php


namespace App\Http\Controllers\TypeProduct;


use App\Http\Responses\ApiResponse;
use App\Services\TypeProduct\TypeProductService;
use Illuminate\Http\Request;

class TypeProductController
{
    private $service;

    public function __construct(TypeProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types = $this->service
            ->getAll();
        return view('typeProduct.index')->with(['types' => $types]);
    }
    public function insert(Request $request)
    {
        try{
            $insert = $this
                ->service
                ->create($request->all());
        }catch (\Exception $exception){
            return redirect()->route('typeProduct.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('typeProduct.index')
            ->with('success', 'Usuário inserido com sucesso');
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $this
                ->service
                ->delete($id);
        }catch (\Exception $exception){
            return ApiResponse::error('',$exception->getMessage());
        }
        return ApiResponse::success('','Excluido com sucesso');
    }
}
