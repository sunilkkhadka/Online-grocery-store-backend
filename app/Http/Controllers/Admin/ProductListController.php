<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ProductList;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductListController extends Controller
{

    public function index()
    {
        $product_datas = ProductList::all();
        return view('admin.index', compact('product_datas'));
    }

    public function AddProduct()
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        return view('backend.product.product_add', compact('category', 'subcategory'));
    } // End Method 


    public function StoreProduct(Request $request)
    {

        $request->validate([
            'product_code' => 'required',
        ], [
            'product_code.required' => 'Input Product Code'

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/uploads/product', $name_gen, "public");
        $save_url = 'http://127.0.0.1:8000/storage/uploads/product/' . $name_gen;

        ProductList::insertGetId([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'special_price' => $request->special_price,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    } // End Method 



    public function EditProduct($id)
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $product = ProductList::findOrFail($id);
        // $details = ProductDetails::where('product_id', $id)->get();
        return view('backend.product.product_edit', compact('category', 'subcategory', 'product'));
    }

    public function DeleteProduct($id)
    {

        ProductList::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }


    // ======================================FOR API=================================================

    public function GetProductListByRemarks($remark)
    {
        // $remark = $remark;
        // $productList = ProductList::where('remark', $remark)->get();

        $productList = ProductList::with('categories')->where('remark', $remark)->orderBy('id', 'DESC')->limit(5)->get();

        return $productList;
    }

    public function GetProductListByCategory($id)
    {
        $products = ProductList::where('category_id', $id)->get();
        return $products;
    }

    public function GetProductsById($id)
    {
        $products = ProductList::where('id', $id)->get();
        return $products;
    }

    public function SearchProduct($search_term)
    {
        $key = $search_term;
        $searchProduct = ProductList::where('title', 'LIKE', "%{$key}%")->orWhere('brand', 'LIKE', "%{$key}%")->limit(6)->get();

        return $searchProduct;
    }

    public function SimilarProducts($subcategory)
    {
        $products = ProductList::where('subcategory_id', $subcategory)->orderBy('id', 'DESC')->limit(5)->get();
        return $products;
    }

    // ======================================END FOR API=================================================


}
