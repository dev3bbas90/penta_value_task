<?php
namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductInterface
{
    protected $model;
    public function __construct(Product $model)
    {
        $this->model =$model;
    }
}
