<?php

namespace app\Services;

use App\Repositories\ProductRepository;

class ProductService {
    protected $ProductRepository;

    public function __construct(
        ProductRepository $ProductRepository,
    ) {
        $this->ProductRepository = $ProductRepository;
    }

    public function store(Array $data) {
        try {
            return $this->ProductRepository->store($data);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function findByCode(String $code) {
        $product =$this->ProductRepository->where([['code', '=', $code]]);

        if($product->first()) {
            return $product->first(); 
        }

        return null;
    }
}