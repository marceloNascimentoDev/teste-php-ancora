<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        DB::beginTransaction();

        if($this->ProductService->findByCode($request->get('code'))) {
            return Response()->json(['data' => 'Code has already been registered', 'success' => false], 422);
        }

        try {
            $product = $this->ProductService->store($request->all());

            DB::commit();
            
            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], 500);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}