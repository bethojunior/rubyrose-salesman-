<?php

namespace App\Http\Controllers\User;

use App\Constants\UserConstant;
use App\Constants\UserStatusConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\InsertUser;
use App\Http\Responses\ApiResponse;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $request = $request->all();

        if(!isset($request['email']))
            return ApiResponse::error('','Email é um campo válido','false');

        if(!isset($request['password']))
            return ApiResponse::error('','Senha é um campo válido','false');

        try{
            $user = $this->service
                ->authenticate($request);
        }catch (\Exception $e){
            return ApiResponse::error('',$e->getMessage());
        }

        return ApiResponse::success($user,'Usuário logado');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->service
            ->getAll();
        return view('users.index')->with(['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param InsertUser $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(InsertUser $request)
    {
        try{
            $insert = $this
                ->service
                ->insertUser($request->all());
        }catch (\Exception $exception){
            return redirect()->route('user.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('user.index')
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findById($id)
    {
        $user = $this->service
            ->find($id);
        return view('users.id')->with(['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try{
            $this->service
                ->update($request->all());
        }catch (\Exception $exception){
            return redirect()->route('user.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('user.index')
            ->with('success', 'Usuário atualizado com sucesso');
    }

}
