<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.brand.brand-index', [
            'brands' => Brand::latest()->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.brand-create');
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
            'name' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
            'brand_image' => 'required'
        ]);

        $image = $request->file('brand_image');
        $nameGenerate = Str::slug($request->name).'-'.random_int(1, 1000).'.'.$image->getClientOriginalExtension();
        $savePath = public_path('backend-assets/upload-images/brand/');
        File::makeDirectory($savePath, $mode=0777, true, true);
        Image::make($image)->save($savePath.$nameGenerate);
        $saveUrl = $nameGenerate;

        $brands = new Brand;
        $brands->name = $request->name;
        $brands->slug = $request->slug;
        $brands->image = $saveUrl;
        $brands->save();

        $notification = array(
            'message' => 'Brand Create Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
    * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.brand.brand-edit', [
            'brands' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        if($request->hasFile('brand_image')){
            $image = $request->file('brand_image');
            $oldImg = public_path('backend-assets/upload-images/brand/'.$brand->image);
            $nameGenerate = Str::slug($request->name).'-'.random_int(1, 1000).'.'.$image->getClientOriginalExtension();
            $savePath = public_path('backend-assets/upload-images/brand/');
            if(fileExists($oldImg)){
                unlink($oldImg);
            };
            File::makeDirectory($savePath, $mode=0777, true, true);
            Image::make($image)->save($savePath.$nameGenerate);
            $brand->image =  $nameGenerate;
            $brand->save();
        }
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();

        $notification = array(
            'message' => 'Brand Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        $notification = array(
            'message' => 'Brand Move Trash Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function brand_trash(){
        return view('backend.brand.brand-trash', [
            'brands_trash' => Brand::onlyTrashed()->get(),
        ]);
    }

    public function brand_restore($id, Brand $brand){
        $brand->onlyTrashed()->findOrFail($id)->restore();
        $notification = array(
            'message' => 'Brand Restore Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function brand_delete($id, Brand $brand){
        $brandImg= $brand->onlyTrashed()->findOrFail($id)->image;
        // Image File Path.
        $file_path = public_path('backend-assets/upload-images/brand/'.$brandImg);
        unlink($file_path);
        $brand->onlyTrashed()->findOrFail($id)->forceDelete();
        $notification = array(
            'message' => 'Brand Delete Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }



}
