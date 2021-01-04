<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Product;

class SubCategoryController extends Controller
{

    //Show All Subcategories
    function SubCategoryList(){

        $scategories = SubCategory::with('get_category')->paginate(3);
        $strash = SubCategory::onlyTrashed()->get();

        return view('backend.sub category.subcategory-list',
            [
                'scategories' => $scategories,
                'strash' => $strash
            ]
        );
    }

    // Sub Category Add View
    function SubCategoryAdd(){

        $scategories = SubCategory::with('get_category')->paginate(5);

        return view('backend.sub category.subcategory-add',
            [
                'scategories' => $scategories,
                'categories' => Category::orderBy('category_name', 'asc')->get()
            ]
        );
    }

    // Sub category Post
    function SubCategoryPost(Request $req){

        SubCategory::insert([
            'subcategory_name' => $req->subcategory_name,
            'slug' => Str::slug($req->subcategory_name),
            'category_id' => $req->category_id,
            'created_at' => Carbon::now()
        ]);

        return back()->with('scategory_add', 'Sub Category Added Successfully!!!');
    }

    //Sub Category soft delete
    function SubCategoryDelete($id){
        $cat_product = Product::where('subcategory_id', $id)->count();

        if ($cat_product > 0) {
            return back()->with('ProductAvailable', 'You can not delete the Sub category with existing Product.');
        } else{
            SubCategory::findOrFail($id)->delete();
            return back()->with('scategory_delete', 'Sub Category Deleted Successfully!!!');
        }
    }

    //Sub category Restore
    function SubCategoryRestore($id){
        SubCategory::withTrashed()->findOrFail($id)->restore();
        return back()->with('scategory_restore','Sub Category Restored Successfully!!!');
    }

    // Sub category permanent delete
    function SubCategoryParmanentDelete($id){
        SubCategory::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('scategory_permanent_delete', 'Sub Category Deleted Permanently!!!');
    }

    // Sub Category Edit view
    function SubCategoryEdit($id){
        $scategories = SubCategory::with('get_category')->paginate(3);
        $edit_subcategory = SubCategory::findOrFail($id);
        return view('backend.sub category.subcategory-edit',
            [
                'scategories' => $scategories,
                'edit_subcategory' => $edit_subcategory,
                'categories' => Category::orderBy('category_name', 'asc')->get()
            ]
        );
    }

    // Sub Category Update
    function SubCategoryUpdate(Request $req){

        $update = SubCategory::findOrFail($req->id);
        $update->subcategory_name = $req->subcategory_name;
        $update->slug = Str::slug($req->subcategory_name);
        $update->category_id = $req->category_id;
        $update->save();

        return redirect()->route('SubCategoryList')->with('scategory_update', 'Sub Category Updated Successfully!!!');
    }
}
