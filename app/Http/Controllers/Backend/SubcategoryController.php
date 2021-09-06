<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.subcategory.subcategory-index', [
            'subcategories' => Subcategory::with('category')->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subcategory.subcategory-create', [
            'categories' => Category::get(),
        ]);
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
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);

        $subcategory = new Subcategory;
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->save();

        $notification = array(
            'message' => 'Subcategory Created Successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        return view('backend.subcategory.subcategory-edit', [
            'subcategory' => $subcategory,
            'categories' => Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->save();
        $notification = array(
            'message' => 'Subcategory Updated Successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        $notification = array(
            'message' => 'Subcategory Move Trash Successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);

    }

    public function subcategory_trash(){
        return view('backend.subcategory.subcategory-trash', [
            'subcategories' => Subcategory::onlyTrashed()->latest()->paginate(5),
        ]);
    }

    public function subcategory_restore($id, Subcategory $subcategory){
        $subcategory->onlyTrashed()->findOrFail($id)->restore();
        $notification = array(
            'message' => 'Subategory Restore Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function subcategory_delete ($id, Subcategory $subcategory){
        $subcategory->onlyTrashed()->findOrFail($id)->forceDelete();
        $notification = array(
            'message' => 'Subategory Delete Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }









}
