<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subsubcategory;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.subsubcategory.subsub-index', [
            'subsubcategories' => Subsubcategory::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subsubcategory.subsub-create', [
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
            'subcategory_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);

        $subsubcategory = new Subsubcategory;
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->name = $request->name;
        $subsubcategory->slug = $request->slug;
        $subsubcategory->save();

        $notification = array(
            'message' => 'Sub-subcategory Created Successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subsubcategory $subsubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsubcategory $subsubcategory)
    {
        return view('backend.subsubcategory.subsub-edit', [
            'subsubedit' => $subsubcategory,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'subcategories' => Subcategory::where('category_id', 5 )->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsubcategory $subsubcategory)
    {
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->name = $request->name;
        $subsubcategory->slug = $request->slug;
        $subsubcategory->save();
        $notification = array(
            'message' => "Sub subcategory updated.",
            'alert-type' => "success",
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsubcategory $subsubcategory)
    {
        $subsubcategory->delete();
        $notification = array(
            'message' => "Sub subcategory Deleted.",
            'alert-type' => "warning",
        );
        return back()->with($notification);
    }

    public function ajax_subcategory_request($id){
        $subcategory = Subcategory::where('category_id', $id)->orderBy('name', 'asc')->get();
        return json_encode($subcategory);
    }
}
