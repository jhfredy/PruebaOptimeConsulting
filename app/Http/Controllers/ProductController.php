<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $criteria=$request->criteria;

        if ($search=='') {
            $product=Product::join('categories','products.category_id','=','categories.id')
            ->select('products.id','products.category_id','products.code','products.name','categories.name as category_name','products.price','products.brand','products.description','categories.active')
            ->orderBy('products.id','desc')->paginate(3);
        }else{
            $product=Product::join('categories','products.category_id','=','categories.id')
            ->select('products.id','products.category_id','products.code','products.name','categories.name as category_name','products.price','products.brand','products.description','categories.active')
            ->where('products.'.$criteria,'like','%'.$search.'%')
            ->orderBy('products.id','desc')->paginate(3);
        }

        return[
            'pagination'=>[
                'total'=>$product->total(),
                'current_page'=>$product->currentPage(),
                'per_page'=>$product->perPage(),
                'last_page'=>$product->lastPage(),
                'from'=>$product->firstItem(),
                'to'=>$product->lastItem(),
            ],
            'product'=>$product
        ];
    }

    
    public function store(Request $request)
    {
        $product =new Product();
        $product->code=$request->code;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->brand=$request->brand;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->save();
    }

    public function update(Request $request)
    {
        $product =Product::findOrFail($request->id);
        $product->code=$request->code;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->brand=$request->brand;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->save();
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
