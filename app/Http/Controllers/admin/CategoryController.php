<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryModel;
use App\Models\SubCategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function ListCategories(){
        $data['header_title']="List Category";
        $data['getRecord']=CategoryModel::getRecord();
        return view("admin.category.list",$data);
    }
    public function AddCategory(){
        $data['header_title']="Add Category";
        return view("admin.category.add",$data);
    }
    public function InsertCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required',
            'slug'=>'required|unique:categories,slug'
        ]);
       if($validator->passes()){
        $category=new CategoryModel();
        $category->name=trim($request->category_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->save();
        session()->flash("success","Category successfully created");
        return redirect(route("admin.categories.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function EditCategory($id){
        $data['getRecord']=CategoryModel::getSingle($id);
        $data['header_title']="Edit Category";
        return view("admin.category.edit",$data);
    }
    public function UpdateCategory($id,Request $request){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required',
            'slug'=>'required|unique:categories,slug,'.$id
        ]);
       if($validator->passes()){
        $category=CategoryModel::getSingle($id);
        $category->name=trim($request->category_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->save();
        session()->flash("success","Category successfully updated");
        return redirect(route("admin.categories.list"));
       }else{
            return back()
            ->withErrors($validator) 
            ->withInput();
        }
    }
    public function DeleteCategory($id){
        $category=CategoryModel::getSingle($id);
        $category->is_delete=1;
        $category->save();
        session()->flash("success","Category successfully deleted");
        return redirect()->back();
    }
   
}
