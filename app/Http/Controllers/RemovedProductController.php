<?php

namespace App\Http\Controllers;

use App\Models\RemovedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemovedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RemovedProduct::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make([
            'product_id' => $request->input('product_id')
        ], [
            'product_id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $removedProduct = new RemovedProduct($request->all());
        $removedProduct->save();
        return $removedProduct;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RemovedProduct  $removedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(RemovedProduct $removedProduct)
    {
        return RemovedProduct::where("product_id", $removedProduct->product_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RemovedProduct  $removedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemovedProduct $removedProduct)
    {
        $removedProduct->update($request->all());

        return $removedProduct;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RemovedProduct  $removedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(RemovedProduct $removedProduct)
    {
        $removedProduct->delete();
    }
}
