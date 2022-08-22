<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Product::Select("*")->count();
        $sum = Product::sum("qty");
        return view('admin.dashboard',compact('result','sum'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //using Ajax
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'desc' => 'required',
          'price' => 'required|numeric',
          'qty'   => 'required|numeric',
          'image' => 'mimes:png,jpg,jpeg'

        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->qty = $request->qty;

        if($request->hasFile('image')){

         $image = $request->file('image');
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image -> storeAs('/public/media', $image_name);
           $product->img = $image_name;
        }
        $product->save();
        return response()->json(['status' => 'sucess', 'msg' => "Product Added SucessFully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::orderby('id', 'desc')->get();
        return view('admin.manage_product', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $productedit = Product::find($product);

        if (!is_null($productedit)) {
            return view('admin.edit_product',compact('productedit'));
        } else {
            return redirect()->route('product.show');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    //using ajax
    public function update(Request $request, $id)

    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'qty'   => 'required|numeric',
            'image' => 'mimes:png,jpg,jpeg'

          ]);

          $productup =  Product::find($id);

          $productup->name = $request->name;
          $productup->desc = $request->desc;
          $productup->price = $request->price;
          $productup->qty = $request->qty;

          //insert image also
          if (!is_null($request->image)) {

              //delete the old image from folder
              if (Storage::exists('/public/media/'.  $productup->img)) {
                Storage::delete('/public/media/'.  $productup->img);
              }
              $image = $request->file('image');
              $ext = $image->extension();
              $image_name = time().'.'.$ext;
              $image -> storeAs('/public/media', $image_name);
              $productup->img = $image_name;
          }

          $productup->save();
          return response()->json(['status' => 'sucess', 'msg' => "Product Added SucessFully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $product)
    {
        $product = Product::find($product);
        if (!is_null($product)) {
            //if it is parent $product , then delete all its subcategory

            //delete $product image
            if (Storage::exists('/public/media/'.  $product->img)) {
                Storage::delete('/public/media/'.  $product->img);
            }
            $product->delete();
        }

        return redirect()->route('product.show');
    }
}
