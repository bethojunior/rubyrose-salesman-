<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Services\Blog\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private $service;

    /**
     * BlogController constructor.
     * @param BlogService $blogService
     */
    public function __construct(BlogService $blogService)
    {
        $this->service = $blogService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blog.create');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $blogs = $this->service
            ->getAll();
        return view('blog.index')->with(['blogs' => $blogs]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try{
            $this
                ->service
                ->create($request->all());
        }catch (\Exception $exception){
            return redirect()->route('blog.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('blog.list')
            ->with('success', 'Blog inserido com sucesso');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->service
                ->delete($id);
        } catch (\Exception $exception){
            return redirect()->route('blog.list')
                ->with('error', 'Erro ao excluir blog');
        }
        return redirect()->route('blog.list')
            ->with('success', 'Blog excluido com sucesso');
    }

}
