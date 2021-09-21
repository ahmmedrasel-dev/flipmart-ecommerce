<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $product = Product::with('category.subcategory')->where('status', 1)->orderBy('product_name', 'asc')->whereNull('hotdeal_product')->limit(8)->get();
        $latestproduct = Product::where('status', 1)->latest()->limit(8)->get();
        $featuredProduct = Product::with('productAttribute.attributeSet')->where('status', 1)->where('featured_product', 1)->orderBy('product_name', 'asc')->limit(8)->get();
        $currentDate = Carbon::now()->format('Y/m/d');
        $hotDeals = Product::where(['status' => 1, 'hotdeal_product' => 1])->where('descount_price', '!=', NULL)->orderBy('product_name', 'asc')->where('offer_exp_date', '>',$currentDate )->limit(4)->get();
        $skipCategory3 = Category::skip(3)->first();
        $categoriesProduct = Product::where(['status' => 1, 'category_id' => $skipCategory3 ->id ])->limit(4)->get();
        return view('frontend.index',[
            'categories' => Category::with(['subcategory.subsubcategory', 'product'])->orderBy('name', 'asc')->where('id', '!=', 1)->get(),
            'products' => $product,
            'latestproducts' => $latestproduct,
            'featureProducts' => $featuredProduct,
            'hotDealsProducts' => $hotDeals,
            'skipCategory3' => $skipCategory3,
            'categoryProduct' => $categoriesProduct,
        ]);
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $userId = Auth::user()->id;
        return view('frontend.profile.user-profile', [
            'user' => User::findOrFail($userId),
        ]);
    }

    public function userProfileStore(Request $request){
        $userProfile = User::findOrFail(Auth::user()->id);
        $userProfile->phone = $request->phone;
        $userProfile->name = $request->name;
        $userProfile->email = $request->email;
        $userProfile->save();

        // Profile Photo Updated.
        if($request->file('photo')){
            $image = $request->file('photo');
            @unlink(public_path('front-assets/images/profile_photo/'.$userProfile->profile_photo_path));
            $imgNamGen = date('dmy').'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('front-assets/images/profile_photo'), $imgNamGen);
            $userProfile->profile_photo_path = $imgNamGen;
            $userProfile->save();
        }

        $notification = array(
            'message' => 'Profile Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function userPasswordEdit(){
        $userId = Auth::user()->id;
        return view('frontend.profile.user-password-edit', [
            'user' => User::findOrFail($userId),
        ]);
    }


    public function userPasswrodStore(Request $request){
        $userId = Auth::user()->id;
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPass = User::findOrFail($userId )->password;
        if(Hash::check($request->oldpassword, $hashPass)){
            $user = User::findOrFail($userId );
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return back();
        }
    }


    public function product_details($slug){
        $last_url=collect(request()->segments())->first();
        $s_cat_list=Str::of($last_url)->replace('-',' ');
        $product = Product::where('product_slug', $slug)->first();
        $muliImage = ProductGallery::with('product')->where('product_id', $product->id)->get();
        $currentDate = Carbon::now()->format('Y/m/d');
        $hotDeals = Product::where(['status' => 1, 'hotdeal_product' => 1])->where('descount_price', '!=', NULL)->orderBy('product_name', 'asc')->where('offer_exp_date', '>',$currentDate )->limit(4)->get();
        $productAttribute = ProductAttribute::where('product_id', $product->id)->get();
        $reletedProduct = Product::where(['category_id' => $product->category_id, 'status' => 1])->where('id', '!=', $product->id )->get();
        return view('frontend.pages.product-details', [
            'productItem' => $product,
            'lastUrl' => $s_cat_list,
            'productImg' => $muliImage,
            'productAttribute' => $productAttribute,
            'hotDealsProducts' => $hotDeals,
            'relatedProduct' => $reletedProduct,
        ]);
    }

    // Product Veiw Modal Ajax Request.
    // function productViewModal($id){
    //     $product = Product::with('category')->findOrFail($id);
    //     $productAttribute = ProductAttribute::with('attributeSet')->where('product_id', $id)->first();
    //     return response()->json([
    //         'product' => $product,
    //         'productAttribute' => $productAttribute,
    //     ]);
    // }


}
