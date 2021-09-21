<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.category-index', [
            'categories' => Category::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.category-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
        ]);

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $namGenerate = Str::slug($request->name).'-'.random_int(1, 1000).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('backend-assets/upload-images/category/'.$namGenerate);
            $imgLocation = 'backend-assets/upload-images/category/'.$namGenerate;
            $category = new Category;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->icon = $request->icon;
            $category->image = $imgLocation;
            $category->save();
        }else{
            $category = new Category;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
        }

        $notification = array(
            'message' => 'Category Created Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.category-edit', [
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $namGenerate = Str::slug($request->name).'-'.random_int(1, 1000).'.'.$image->getClientOriginalExtension();
            $category->icon = $request->icon;
            $oldImage = $category->image;
            if($oldImage != null){
                unlink($oldImage);
            }else{
                Image::make($image)->save('backend-assets/upload-images/category/'.$namGenerate);
                $imgLocation = 'backend-assets/upload-images/category/'.$namGenerate;
                $category->name = $request->name;
                $category->slug = $request->slug;
                $category->icon = $request->icon;
                $category->image = $imgLocation;
                $category->save();
            }
            Image::make($image)->save('backend-assets/upload-images/category/'.$namGenerate);
            $imgLocation = 'backend-assets/upload-images/category/'.$namGenerate;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->icon = $request->icon;
            $category->image = $imgLocation;
            $category->save();
        }else{
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->icon = $request->icon;
            $category->save();
        }

        $notification = array(
            'message' => 'Category Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $notification = array(
            'message' => 'Category Move to Trash Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function catagory_trash(){
        return view('backend.category.category-trash', [
            'categories' => Category::onlyTrashed()->latest()->paginate(10),
        ]);
    }

    public function category_restore($id, Category $category){
        $category->onlyTrashed()->findOrFail($id)->restore();
        $notification = array(
            'message' => 'Category Restore Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function category_delete($id, Category $category){
        $catagoryImg = $category->onlyTrashed()->findOrFail($id)->image;
        if($catagoryImg !== null ){
            unlink($catagoryImg);
            $category->onlyTrashed()->findOrFail($id)->forceDelete();
        }else{
            $category->onlyTrashed()->findOrFail($id)->forceDelete();
        }

        $notification = array(
            'message' => 'Category Deleted Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }


}
