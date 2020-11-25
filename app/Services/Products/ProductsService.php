<?php


namespace App\Services\Products;


use App\Models\Products\ProductImage;
use App\Models\Products\Products;
use App\Repositories\Products\ProductsImageRepository;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Support\Facades\Storage;

class ProductsService
{

    private $repository;
    private $imageRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepository $productsRepository
     * @param ProductsImageRepository $productsImageRepository
     */
    public function __construct(ProductsRepository $productsRepository , ProductsImageRepository $productsImageRepository)
    {
        $this->repository = $productsRepository;
        $this->imageRepository = $productsImageRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findAll(){
        return $this->repository
            ->findAll();
    }

    /**
     * @param array $request
     */
    public function insert(array $request)
    {
        $data = [
            'name'  => $request['name'],
            'type_product_id'  => $request['type_product_id'],
            'description' => $request['description'],
            'minimum_order' => $request['minimum_order'],
            'value' => $request['value'],
        ];
        $product = new Products($data);

        $insert = $this->repository->save($product);

        if($insert){
            if (isset($request['images'])) {
                foreach ($request['images'] as $image){
//                    dd($product->id);
                    $filename = Storage::disk('public')->putFile($product->id, $image);
                    $images = [
                        'image' => $filename,
                        'product_id' => $product->id,
                    ];
                    $imageProduct = new ProductImage($images);
                    $this->imageRepository->save($imageProduct);
                }
                return false;
            }
        }

        return true;
    }
}
