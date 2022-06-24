<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    // ===================================FOR API========================================
    public function GetAllCategories()
    {
        $categories = Category::all();
        $categoryDetailsArr = [];

        foreach ($categories as $value) {
            $subcategory = Subcategory::where('category_id', $value['id'])->get();

            $item = [
                'category_id' => $value['id'],
                'category_name' => $value['category_name'],
                "category_image" => $value['image'],
                'subcategories' => $subcategory
            ];

            array_push($categoryDetailsArr, $item);
        }

        // return response()->json([
        //     "message" => $categories
        // ]);

        return $categoryDetailsArr;
    }

    public function GetCategoriesById($id)
    {

        $category = Category::with('subCategories')->where('id', $id)->get();

        return $category;
    }

    // =============================END FOR API ================================================

    // ===============================FOR BACKEND ==============================================

    public function GetAllCategory()
    {

        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }



    public function AddCategory()
    {
        return view('backend.category.category_add');
    } // End Mehtod 


    public function StoreCategory(Request $request)
    {

        $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'Input Category Name'

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(128, 128)->save('upload/category/' . $name_gen);
        // $image->move(public_path('upload/category'), $image);
        $image->storeAs('/uploads/category', $name_gen, "public");
        $save_url = 'http://127.0.0.1:8000/storage/uploads/category/' . $name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    } //End Method 


    public function UpdateCategory(Request $request)
    {

        $category_id = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/uploads/category', $name_gen, "public");
            $save_url = 'http://127.0.0.1:8000/storage/uploads/category/' . $name_gen;

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Update With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } else {

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,

            ]);

            $notification = array(
                'message' => 'Category Updateed Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        }
    } //End Method 


    public function DeleteCategory($id)
    {

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    // ===============================END FOR CATEGORY ==============================================



    // ===============================FOR SUBCATEGORY ==============================================

    public function GetAllSubCategory()
    {
        $subcategory = Subcategory::latest()->get();
        return view('backend.subcategory.subcategory_view', compact('subcategory'));
    } //End Method 


    public function AddSubCategory()
    {

        $category = Category::latest()->get();
        return view('backend.subcategory.subcategory_add', compact('category'));
    } //End Method 

    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required',
        ], [
            'subcategory_name.required' => 'Input SubCategory Name'

        ]);

        $category = Category::find($request->category_id);

        $cat_name = $category['category_name'];
        $cat_id = (int) $category['id'];
        // dd($cat_id);

        // dd($id);

        Subcategory::insert([
            'category_name' => $cat_name,
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $cat_id
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } //End Method 


    public function EditSubCategory($id)
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('category', 'subcategory'));
    } //End Method 

    public function UpdateSubCategory(Request $request)
    {

        $subcategory_id = $request->id;

        Subcategory::findOrFail($subcategory_id)->update([
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } //End Method 


    public function DeleteSubCategory($id)
    {

        Subcategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method 



}
