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
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Tag;
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
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'product_slug' => 'required',
            'product_code' => 'required|unique:products',
            'product_qty' => 'required',
            'selling_price' => 'required',
            'short_details' => 'required',
            'long_details' => 'required',
            'thmbnail' => 'required',
            'image_name' => 'required',
        ]);

        // Insert Product Thubmanil.
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
        $product->offer_exp_date = $request->offer_exp_date;
        $product->featured_product = $request->featured_product;
        $product->special_offer = $request->special_offer;
        $product->special_deals = $request->special_deals;
        $product->thmbnail = $imgLocation;
        $product->save();

        // Tag::insert([
        //     'product_id' => $product->id,
        //     'tag_name' => $request->product_tag
        // ]);

        $productTag = $request->product_tag;
        foreach ( $productTag as $value) {
            $tag = new Tag;
            $tag->product_id = $product->id;
            $tag->tag_name = $value;
            $tag->save();
        }

        // Insert Multiple Image into Product Gallary Model.
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

        // Insert Attribute Data into Product Attribute Model.
        if($request->has('attribute_id')){
            $attributeId= $request->attribute_id;
            foreach ($attributeId as $key => $value) {
                $productAttr = new ProductAttribute;
                $productAttr->product_id = $product->id;
                $productAttr->attributeset_id = $value;
                $productAttr->value = $request->value[$key];
                $productAttr->save();
            }
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
        return view('backend.product.product-edit', [
            'products'=>$product,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'subcategories' => Subcategory::where('category_id', $product->category_id)->orderBy('name', 'asc')->get(),
            'subchild' => Subsubcategory::where('subcategory_id', $product->subcategory_id)->orderBy('name', 'asc')->get(),
            'brands' => Brand::orderBy('name', 'asc')->get(),
            'attributeValue' => AttributeValue::get(),
            'attributesetnames' => AttributeSet::get(),
            'productAttributes' => ProductAttribute::where('product_id', $product->id)->get(),
            'tags' => Tag::where('product_id', $product->id)->get(),
            'productMultiImg' => ProductGallery::where('product_id', $product->id)->get(),
        ]);
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

        if($request->hasFile('thmbnail')){
            $pthmbnail = $request->file('thmbnail');
            $namGenerate = hexdec(uniqid()).'.'.$pthmbnail->getClientOriginalExtension();
            $oldImage = $product->thmbnail;
            if(file_exists($oldImage)){
                unlink($oldImage);
            }
            Image::make($pthmbnail)->save('backend-assets/upload-images/product/thmbnail/'.$namGenerate);
            $imgLocation = 'backend-assets/upload-images/product/thmbnail/'.$namGenerate;

            $product->thmbnail = $imgLocation;
            $product->product_name = $request->product_name;
            $product->product_slug = $request->product_slug;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->subsubcategory_id = $request->subsubcategory_id;
            $product->brand_id = $request->brand_id;
            $product->short_details = $request->short_details;
            $product->product_code = $request->product_code;
            $product->product_qty = $request->product_qty;
            $product->selling_price = $request->selling_price;
            $product->descount_price = $request->descount_price;
            $product->long_details = $request->long_details;
            $product->hotdeal_product = $request->hotdeal_product;
            $product->offer_exp_date = $request->offer_exp_date;
            $product->featured_product = $request->featured_product;
            $product->special_offer = $request->special_offer;
            $product->special_deals = $request->special_deals;
            $product->save();
        }else{
            $product->product_name = $request->product_name;
            $product->product_slug = $request->product_slug;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->subsubcategory_id = $request->subsubcategory_id;
            $product->brand_id = $request->brand_id;
            $product->short_details = $request->short_details;
            $product->product_code = $request->product_code;
            $product->product_qty = $request->product_qty;
            $product->selling_price = $request->selling_price;
            $product->descount_price = $request->descount_price;
            $product->long_details = $request->long_details;
            $product->hotdeal_product = $request->hotdeal_product;
            $product->offer_exp_date = $request->offer_exp_date;
            $product->featured_product = $request->featured_product;
            $product->special_offer = $request->special_offer;
            $product->special_deals = $request->special_deals;
            $product->save();
        }

        // Insert Product Tag into Tag Model.

        $productTag = $request->ptag;
        if($productTag != NULL){
            foreach ( $productTag as $key => $value) {
                $tag = Tag::findOrFail($request->ptagid[$key]);
                $tag->product_id = $product->id;
                $tag->tag_name = $value;
                $tag->save();
            }
        }


        // Insert Attribute Data into Product Attribute Model.
        $attributeId= $request->attribute_id;
        if($request->attribute_id !== null){
            foreach ($attributeId as $key => $value) {
                $productAttr = ProductAttribute::findOrFail($request->pAttributeId[$key]);
                $productAttr->product_id = $product->id;
                $productAttr->attributeset_id = $value;
                $productAttr->value = $request->value[$key];
                $productAttr->save();
            }
        }

        $notification = array(
            'message' => 'Product Created Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    // Product Multi Image Update Here
    public function storeProductImg(Request $request){
      if($request->has('image_name')){
        $imageId = $request->image_name;
        foreach ($imageId as $id => $img) {
            $oldImg = ProductGallery::findOrFail($id);
            unlink($oldImg->image_name);
            $multiImgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
             Image::make($img)->save('backend-assets/upload-images/product/product-img/'.$multiImgName);
             $multiImgLocation = 'backend-assets/upload-images/product/product-img/'.$multiImgName;
             $oldImg->image_name = $multiImgLocation;
             $oldImg->product_id = $request->product_id;
             $oldImg->save();
        }
      }
       $notification = array(
            'message' => 'Product Image Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function multiimgDelete($id){
        $oldImage= ProductGallery::findOrFail($id)->image_name;
        if(file_exists($oldImage)){
            unlink($oldImage);
        }
        ProductGallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image Delete Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $producAttr= ProductAttribute::where('product_id', $product->id)->get();
        foreach ($producAttr as  $value) {
            $value->delete();
        }

        $productTag = Tag::where('product_id', $product->id)->get();
        foreach ($productTag as  $value) {
            $value->delete();
        }

        $productImg = ProductGallery::where('product_id', $product->id)->get();
        foreach ($productImg as  $value) {
            $value->delete();
        }

        $notification = array(
            'message' => 'Product Move to Trash.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    // Product Trash List View.
    public function productTrash(){
        return view('backend.product.product-trash', [
            'products' => Product::onlyTrashed()->latest()->paginate(10),
        ]);
    }

    // Product Restore From Trash List.
    public function productRestore($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        ProductGallery::onlyTrashed()->where('product_id', $id)->restore();
        ProductAttribute::onlyTrashed()->where('product_id', $id)->restore();
        Tag::onlyTrashed()->where('product_id', $id)->restore();

        $notification = array(
            'message' => 'Product Restore Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    // Proudct Remove Permanently From Database.
    public function productDelete($id){

        ProductAttribute::onlyTrashed()->where('product_id', $id)->forceDelete();
        Tag::onlyTrashed()->where('product_id', $id)->forceDelete();

        $image= ProductGallery::onlyTrashed()->where('product_id', $id)->get();
        foreach ($image as $img) {
            $oldImage = $img->image_name;
            unlink($oldImage);
        }
        ProductGallery::onlyTrashed()->where('product_id', $id)->forceDelete();

        $thmbnail = Product::onlyTrashed()->findOrFail($id)->thmbnail;
        unlink($thmbnail);
        Product::onlyTrashed()->findOrFail($id)->forceDelete();

        $notification = array(
            'message' => 'Product Delete Permanently.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    // Ajax Request for Subcategory Data
    public function ajax_subsubcat_request($subcat_id){
        $subsubcat = Subsubcategory::where('subcategory_id', $subcat_id)->orderBy('name', 'asc')->get();
        return json_encode($subsubcat);
    }
}
