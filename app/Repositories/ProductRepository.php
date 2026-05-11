<?php

namespace App\Repositories;

use App\Models\Backend\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function paginate($perPage = 5)
    {
        return $this->model->with(['category', 'subCategory', 'images'])->latest()->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->with(['category', 'subCategory', 'images'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $product = $this->model->create($data);

        // Handle image uploads if present
        if (isset($data['images']) && is_array($data['images'])) {
            $this->uploadImages($product, $data['images']);
        }

        return $product;
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);

        // Handle image uploads if present
        if (isset($data['images']) && is_array($data['images'])) {
            $this->uploadImages($model, $data['images']);
        }

        return $model;
    }

    public function getSubCategoriesByCategory($categoryId)
    {
        return \App\Models\Backend\SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();
    }

    private function uploadImages($product, $images)
    {
        $uploadPath = public_path('uploads/file');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        foreach ($images as $image) {
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $imageName = $time.'-'.$image->getClientOriginalName();
            $image->move($uploadPath, $imageName);

            $product->images()->create([
                'path' => '/uploads/file/'.$imageName
            ]);
        }
    }
}