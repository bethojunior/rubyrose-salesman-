<?php


namespace App\Services\Blog;


use App\Models\Blog\Blog;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogService
{

    private $repository;

    /**
     * BlogService constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->repository = $blogRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll()
    {
        return $this->repository->all()
            ->sortDesc();
    }

    /**
     * @param array $request
     * @return Blog
     * @throws \Exception
     */
    public function create(array $request)
    {
        try{
            DB::beginTransaction();
            $data = [
                'title'    => $request['title'],
                'content'  => $request['content'],
                'link'     => $request['link']
            ];
            $blog = new Blog($data);
            $blog->save();
            $image = Storage::disk('public')->putFile('blog-'.$blog->id, $request['image']);
            $blog->update(['image' => $image]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return $blog;

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


}
