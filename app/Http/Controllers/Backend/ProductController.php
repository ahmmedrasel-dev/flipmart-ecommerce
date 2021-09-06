<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeSet;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.product-index', [
            'products' => Product::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.product-create', [
            'categories' => Category::orderBy('name', 'asc')->get(),
            'brands' => Brand::orderBy('name', 'asc')->get(),
            'attributesetnames' => AttributeSet::get(),
            'attributeValue' => AttributeValue::get(),
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
        $image = $request->file('thmbnail');
        $namGenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('backend-assets/upload-images/product/thmbnail/'.$namGenerate);
        $imgLocation = 'backend-assets/upload-images/product/thmbnail/'.$namGenerate;

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug;
        $product->product_code = $request->product_code;
        $product->product_qty = $request->product_qty;
        $product->selling_price = $request->selling_price;
        $product->descount_price = $request->descount_price;
        $product->short_details = $request->short_details;
        $product->long_details = $request->long_details;
        $product->hotdeal_product = $request->hotdeal_product;
        $product->featured_product = $request->featured_product;
        $product->special_offer = $request->special_offer;
        $product->special_deals = $request->special_deals;
        $product->thmbnail = $imgLocation;
        $product->save();

        $multiImage = $request->file('image_name');
        foreach ($multiImage as $multiImg) {
            $multiImgName = hexdec(uniqid()).'.'.$multiImg->getClientOriginalExtension();
            Image::make($multiImg)->save('backend-assets/upload-images/product/product-img/'.$multiImgName);
            $multiImgLocation = 'backend-assets/upload-images/product/product-img/'.$multiImgName;
            $geleryImg = new ProductGallery;
            $geleryImg->image_name = $multiImgLocation;
            $geleryImg->product_id = $product->id;
            $geleryImg->save();
        }


        $attributeId= $request->attribute_id;
        foreach ($attributeId as $key => $value) {
            $productAttr = new ProductAttribute;
            $productAttr->product_id = $product->id;
            $productAttr->attributeset_id = $value;
            $productAttr->value = $request->value[$key];
            $productAttr->save();
        }

        $notification = array(
            'message' => 'Product Created Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function ajax_subsubcat_request($subcat_id){
        $subsubcat = Subsubcategory::where('subcategory_id', $subcat_id)->orderBy('name', 'asc')->get();
        return json_encode($subsubcat);
    }
}
