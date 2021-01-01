<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{
    //Authintication
    function __construct()
    {  
        $this->middleware('verified');
    }

    // Category List View
    function CategoryList(){

        $categories = Category::paginate(5);
        $trash = Category::onlyTrashed()->get();

        return view('backend.category.category-list',
            [ 
                'categories' => $categories,
                'trash' => $trash
            ]
        );
    }

    // Category Add View
    function CategoryAdd(){

        $categories = Category::paginate(3);
        //$trash = Category::onlyTrashed()->get();

        return view('backend.category.category-add',
            [ 
                'categories' => $categories,
                //'trash' => $trash
            ]
        );
    }


    // Category add
    function CategoryPost(Request $req){
        // Form Validation
        $req->validate([
            'category_name' => ['required', 'min:3', 'unique:categories', 'regex:/^[a-zA-Z ]*$/']
        ],
        [
            'category_name.required' => 'Please enter category name'
        ]);

        $data = new Category;
        $data->category_name = $req->category_name;
        $data->slug = Str::slug($req->category_name);
        $data->save();

        // Category::insert([
        //     'category_name' => $req->category_name,
        //     'created_at' => Carbon::now()
        // ]);
        return back()->with('category_add', 'Category Added Successfully!!!');
    }

    // Category Delete
    function CategoryDelete($id){

        Category::findOrFail($id)->delete();

        return back()->with('category_delete', 'Category Deleted Successfully!!!'); 
    }

    // Category Restore
    function CategoryRestore($id){

        Category::withTrashed()->findOrFail($id)->restore();

        return back()->with('category_restore','Category Restored Successfully!!!');
    }

    // Permanent Delete
    function CategoryPermanentDelete($id){

        Category::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('category_permanent_delete', 'Category Deleted Permanently!!!');
    }

    // Category Edit view
    function CategoryEdit($id){

        $categories = Category::paginate(3);
        $trash = Category::onlyTrashed()->get();

        $edit_category = Category::findOrFail($id);

        return view('backend.category.category-edit',
            [ 
                'categories' => $categories,
                'trash' => $trash,
                'edit_category' => $edit_category
            ]
        );
    }
    // Category Edit post
    function CategoryUpdate(Request $req){

        // For updateing using this way have to write protected fillable in model(update, create)

        // Category::findOrFail($req->id)->update([
        //     'category_name' => $req->category_name,
        //     'slug' => Str::slug($req->category_name),
        //     'updaated_at' => Carbon::now()
        // ]);

        // There is no need to write in Model in this way

        $update = Category::findOrFail($req->id);
        $update->category_name = $req->category_name;
        $update->slug = Str::slug($req->category_name);
        $update->save();

        return redirect()->route('CategoryList')->with('category_update', 'Category Updated Successfully!!!');
    }
}
