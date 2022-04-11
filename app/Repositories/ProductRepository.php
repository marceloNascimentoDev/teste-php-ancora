<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function __construct(Product $model) {
        $this->model = $model;
    }   

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    
    public function destroy(String $id): Object
    {
        $model = $this->find($id);

        $model->delete();
        
        return $model;
    }

    public function where(Array $condition = [])
    {
        $query = $this->model;

        foreach ($condition as $key => $value) {
            $query = $query->where($value[0], $value[1], $value[2]);
        }

        return $query;
    }

    public function store($data)
    {   
        $model = $this->save($this->model, $data);

        return $model;
    }

    public function update($id, $data)
    {
        $model = $this->find($id);
        
        return $this->save($model, $data);
    }

    public function save(Product $model, $data)
    {
        if(isset($data['name'])) {
            $model->name = $data['name'];
        }
        
        if(isset($data['code'])) {
            $model->code = $data['code'];
        }

        if(isset($data['price'])) {
            $model->price = $data['price'];
        }

        if(isset($data['amount'])) {
            $model->amount = $data['amount'];
        }

        if(isset($data['brand'])) {
            $model->brand = $data['brand'];
        }
        $model->save();

        return $model;
    }

}