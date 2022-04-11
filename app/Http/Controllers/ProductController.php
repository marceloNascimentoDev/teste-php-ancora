<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Enums\StatusCode;

class ProductController extends Controller
{
    protected $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = $this->ProductService->getAll();

            return Response()->json([
                'data'    => ProductResource::collection($products),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();


        if($this->ProductService->findByCode($request->get('code'))) {
            return Response()->json(['data' => 'Code has already been registered', 'success' => false], StatusCode::UNPROCESSABLE_CONTENT);
        }

        try {
            $product = $this->ProductService->store($request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Throwable $th) {
            DB::rollback();

            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->ProductService->findById($id);

            if(!$product) {
                return Response()->json(['data' => 'Product not found', 'success' => false], StatusCode::NOT_FOUND);
            }

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $product = $this->ProductService->findById($id);

            if(!$product) {
                return Response()->json(['data' => 'Product not found', 'success' => false], StatusCode::NOT_FOUND);
            }

            if($productCode = $this->ProductService->findByCode($request->get('code'))) {
                if($productCode->id != $product->id) {
                    return Response()->json(['data' => 'Code has already been registered', 'success' => false], StatusCode::UNPROCESSABLE_CONTENT);
                }
            } 

            $product = $this->ProductService->update($id, $request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], StatusCode::SUCCESS);

        } catch (\Throwable $th) {
            DB::rollback();

            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $product = $this->ProductService->findById($id);

            if(!$product) {
                return Response()->json(['data' => 'Product not found', 'success' => false], StatusCode::NOT_FOUND);
            }

            $product = $this->ProductService->destroy($id);

            DB::commit();

            return Response()->json([
                'data'    => 'Product was deleted',
                'success' => true
            ], StatusCode::SUCCESS);

        } catch (\Throwable $th) {
            DB::rollback();

            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }
}
