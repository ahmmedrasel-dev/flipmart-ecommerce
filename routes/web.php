<?php

Use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AttributeSetController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\SubsubcategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
    All Admin Releted Route
*/
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['auth:sanctum,admin', 'verified']], function(){
    Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('profile/store', [AdminProfileController::class, 'adminProfileUpdate'])->name('profile.update');
    Route::get('password/edit', [AdminProfileController::class, 'adminPasswordEdit'])->name('admin.password.edit');
    Route::post('password/update', [AdminProfileController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});




// User All Routes Start from here.
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('proudct/{slug}', [IndexController::class, 'product_details'])->name('product.details');
// Ajax Request For Product Model View
// Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewModal']);

Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/password/edit', [IndexController::class, 'userPasswordEdit'])->name('user.password.edit');
Route::post('user/password/store', [IndexController::class, 'userPasswrodStore'])->name('user.password.store');

//  Brand All Route Here.

Route::middleware('auth:admin')->prefix('admin')->group( function(){

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/dashboard', function () {
        return view('backend.admin-dashboard');
    })->name('adminDashboard');

    // All Brand Route
    Route::resource('brand', BrandController::class);
    Route::get('/brand-trash', [BrandController::class, 'brand_trash'])->name('brand.trash');
    Route::get('/brand/restore/{id}', [BrandController::class, 'brand_restore'])->name('brand.restore');
    Route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');

    // All Category Routes
    Route::resource('category', CategoryController::class);
    Route::get('/category-trash', [CategoryController::class, 'catagory_trash'])->name('category.trash');
    Route::get('category/restore/{id}', [CategoryController::class, 'category_restore'])->name('category.restore');
    Route::get('category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');

    // All Subcategory Routes
    Route::resource('subcategory', SubcategoryController::class);
    Route::get('subcetegory-trash', [SubcategoryController::class, 'subcategory_trash'])->name('subcategory.trash');
    Route::get('subcategory/restore/{id}', [SubcategoryController::class, 'subcategory_restore'])->name('subcategory.restore');
    Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'subcategory_delete'])->name('subcategory.delete');

    // All Subsubcategory Routes
    Route::resource('subsubcategory', SubsubcategoryController::class);
     // Ajax Request Route For Subateory.
    Route::get('subcat/ajax/{id}', [SubsubcategoryController::class,  'ajax_subcategory_request']);

    //  Attribute Routes
    Route::get('attribute', [AttributeSetController::class, 'index'])->name('attribute.index');
    Route::post('attribute-store', [AttributeSetController::class, 'store'])->name('attribute.store');
    Route::get('attribute-delete/{id}', [AttributeSetController::class, 'delete'])->name('attribute.delete');
    Route::get('attribute-value', [AttributeSetController::class, 'attributeValueView'])->name('attributevalue.view');
    Route::post('attribute-value-store', [AttributeSetController::class, 'attributeValueStore'])->name('attributeValue.store');
    // Route::resource('productAtribute', );

    // All Product Routes
    Route::resource('product', ProductController::class);
    Route::post('product-multiimg-update', [ProductController::class, 'storeProductImg'])->name('productimage.Store');
    Route::get('product-multiimg-delete/{id}', [ProductController::class, 'multiimgDelete'])->name('productimage.delete');
    Route::get('product-trash', [ProductController::class, 'productTrash'])->name('product.trash');
    Route::get('product-restore/{id}', [ProductController::class, 'productRestore'])->name('product.restore');
    Route::get('product-delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    // Ajax Request Route.
    Route::get('subcategory/ajax/{subcatid}',[ProductController::class, 'ajax_subsubcat_request']);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware'=>['auth:sanctum,admin', 'verified']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// Route::prefix('admin')->group(function(){

// });

