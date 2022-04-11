<?php

namespace app\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

class ProductService {
    protected $ProductRepository;

    public function __construct(
        ProductRepository $ProductRepository,
    ) {
        $this->ProductRepository = $ProductRepository;
    }

    public function store(Array $data): Product {
        try {
            return $this->ProductRepository->store($data);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function getAll(): Collection {
        return $this->ProductRepository->getAll();
    }

    public function findByCode(String $code) {
        $product =$this->ProductRepository->where([['code', '=', $code]]);

        if($product->first()) {
            return $product->first(); 
        }

        return null;
    }
}