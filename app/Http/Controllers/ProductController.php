<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest
    ;
use Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductIndexRequest $request)
    {
        return Product::paginate($request["number"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        try{
            Product::create($request->toArray());

            return Response::json([
                'message' => "product Created"
            ], 201);
        }
        catch(Exception $e){
            return Response::json([
                'message' => $e
            ], 500);
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
        $product= Product::findOrFail($id);
        return Response::json(
            $product
        , 200);


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try{
            Product::where('id',$id)->update($request->toArray());

            return Response::json([
                'message' => "product Updated"
            ], 200);
        }
        catch(Exception $e){
            return Response::json([
                'message' => $e
            ], 500);
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
        try{
            Product::where('id',$id)->delete();

            return Response::json([
                'message' => "product Deleted"
            ], 200);
        }
        catch(Exception $e){
            return Response::json([
                'message' => $e
            ], 500);
        }
    }
}
