<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BulkController;
use App\Http\Controllers\Admin\CarouselImagesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CredentialController;
use App\Http\Controllers\Admin\FacebookPixcelController;
use App\Http\Controllers\Admin\InstagramController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImagesController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductSizeChartController;
use App\Http\Controllers\Admin\SocialLinksController;
use App\Http\Controllers\Admin\SpottedController;
use App\Http\Controllers\Admin\BulkSurvingController;
use App\Http\Controllers\Admin\CurrencyExchangeController;
use App\Http\Controllers\Admin\MetaKeywordController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\ApplyCouponController;
use App\Http\Controllers\BulkOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderCompleteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Artisan;


Route::get('/optimize', function () {
    try {
        Artisan::call('optimize:clear');
        $output = Artisan::output();
        return response()->json(['message' => 'Optimize Successful', 'output' => $output]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
    }
});

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        $output = Artisan::output();
        return response()->json(['message' => 'storage link and seeding successful', 'output' => $output]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
    }
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**************************  Back End *****************************/

Route::group(['prefix' => 'admin'], function() 
{
    Route::group(['middleware' => 'admin.guest'], function()
    {
        Route::view('/admin-login','admin.adminlogin')->name('admin.adminlogin');
        Route::post('/admin-login',[AdminController::class, 'authenticate'])->name('adminlogin');
    });
    
    Route::group(['middleware' => 'admin.auth'], function()
    {
        Route::get('/',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/adminlogout', [AdminController::class, 'adminlogout'])->name('adminlogout');

        //////////////////////////////////////////////////////////////
        /////////////////////    Bank Detail   //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/bank-details', [BankController::class, 'bankDetail'])->name('bankDetail');
        Route::get('/add-bank-detail', [BankController::class, 'addBankDetail'])->name('addBankDetail');
        Route::post('/add-bank-detail', [BankController::class, 'uploadBankDetail'])->name('uploadBankDetail');
        Route::get('/edit-bank-detail/{id}', [BankController::class, 'editBankDetail'])->name('editBankDetail');
        Route::put('/update-bank-detail/{id}', [BankController::class, 'updateBankDetail'])->name('updateBankDetail');
        Route::get('/delete-bank-detail/{id}', [BankController::class, 'deleteBankDetail'])->name('deleteBankDetail');
        Route::post('/update-bank-detail-status/{id}', [BankController::class, 'updateBankDetailStatus'])->name('updateBankDetailStatus');

        //////////////////////////////////////////////////////////////
        /////////////////////    Slider Img    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/carousel-images',[CarouselImagesController::class, 'carouselImages'])->name('carouselImages');
        Route::get('/new-carousel-image',[CarouselImagesController::class, 'addNewImage'])->name('addNewImage');
        
        Route::post('/carousel-image-upload', [CarouselImagesController::class, 'carouselImage'])->name('carouselimage');
        Route::get('/carousel-image-delete/{id}', [CarouselImagesController::class, 'deleteCarouselImage'])->name('deletecarouselImage');
        Route::post('/carousel-image-order-update', [CarouselImagesController::class, 'updateCarouselImageOrder'])->name('updateCarouselImageOrder');
        Route::post('/update-carousel-status/{id}', [CarouselImagesController::class, 'updateCarouselStatus'])->name('updateCarouselStatus');
        
        //////////////////////////////////////////////////////////////
        /////////////////////    Categories    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/categories',[CategoryController::class, 'category'])->name('category');

        Route::get('/add-category',[CategoryController::class, 'addcategory'])->name('addCategory');
        Route::post('/add-category',[CategoryController::class, 'uploadCategory'])->name('postCategory');

        Route::get('/edit-category/{id}',[CategoryController::class, 'editcategory'])->name('editCategory');
        Route::put('/edit-category/{id}',[CategoryController::class, 'updateCategory'])->name('updateCategory');

        Route::get('/delete-category/{id}',[CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::post('/update-category',[CategoryController::class, 'updateCategoryOrder'])->name('updateCategoryOrder');

        //////////////////////////////////////////////////////////////
        ///////////////////////    Products    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::post('/product-image', [ProductImagesController::class, 'productImage'])->name('productimage');
        Route::get('/delete-product-image/{id?}',  [ProductImagesController::class, 'deleteProductImage'])->name('deleteProductImage');
        Route::post('/update-carousel-order', [ProductImagesController::class, 'updateCarouselOrder'])->name('updateCarouselOrder');

        Route::get('/all-products', [ProductController::class, 'allProducts'])->name('allProducts');
        Route::get('/add-product',[ProductController::class, 'addProduct'])->name('addProducts');
        Route::post('/add-product',[ProductController::class, 'uploadProduct'])->name('postProducts');
        Route::get('/edit-product/{id}',[ProductController::class, 'editproduct'])->name('editProduct');
        Route::put('/edit-product/{id}',[ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::get('/delete-product/{id}',[ProductController::class, 'deleteProduct'])->name('deleteProduct');
        
        //////////////////////////////////////////////////////////////
        ///////////////////////    Size    //////////////////////
        ////////////////////////////////////////////////////////////
        
        Route::get('/product-size-charts',[ProductSizeChartController::class, 'productSizeChart'])->name('productSizeChart');
        Route::get('/add-product-size-chart',[ProductSizeChartController::class, 'addProductSizeChart'])->name('addProductSizeChart');
        Route::post('/add-product-size-chart',[ProductSizeChartController::class, 'uploadProductSizeChart'])->name('uploadProductSizeChart');
        Route::post('/product-size-chart-image',[ProductSizeChartController::class, 'productSizeChartImage'])->name('productSizeChartImage');
        Route::get('/size-chart-image-delete/{id}', [ProductSizeChartController::class, 'deleteSizeChartImage'])->name('deleteSizeChartImage');
        Route::get('/size-chart-delete/{id}', [ProductSizeChartController::class, 'deleteSizeChart'])->name('deleteSizeChart');
        
        //////////////////////////////////////////////////////////////
        ///////////////////////    Size    //////////////////////
        ////////////////////////////////////////////////////////////
        
        Route::get('/add-size',[ProductController::class, 'addSize'])->name('addSize');
        Route::post('/add-size',[ProductController::class, 'postSize'])->name('postSize');
        Route::post('/size-order-update', [ProductController::class, 'updateSizeOrder'])->name('updateSizeOrder');

        //////////////////////////////////////////////////////////////
        ///////////////////////    Shipping    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/shipping-costs',[ShippingController::class, 'shipping'])->name('shipping');
        Route::get('/add-shipping-cost',[ShippingController::class, 'addShipping'])->name('addShipping');
        Route::post('/new-shipping-cost',[ShippingController::class, 'postShipping'])->name('postShipping');
        Route::get('/edit-shipping-cost/{id}',[ShippingController::class, 'editShipping'])->name('editShipping');
        Route::put('/edit-shipping-cost/{id}',[ShippingController::class, 'updateShipping'])->name('updateShipping');
        Route::get('/delete-shipping-cost/{id}',[ShippingController::class, 'deleteShipping'])->name('deleteShipping');

        //////////////////////////////////////////////////////////////
        ////////////////////////    Order    ////////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/orders',[OrderController::class, 'orders'])->name('orders');
        Route::get('/view-order/{id}',[OrderController::class, 'viewOrder'])->name('viewOrder');
        Route::post('/order-update/{id}',[OrderController::class, 'orderUpdate'])->name('orderUpdate');

        //////////////////////////////////////////////////////////////
        /////////////////////    Slider Img    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/ghazi-spotted',[SpottedController::class, 'spottedGhazi'])->name('spottedGhazi');
        Route::get('/new-ghazi-spotted',[SpottedController::class, 'addNewSpotted'])->name('addNewSpotted');
        Route::post('/new-ghazi-spotted',[SpottedController::class, 'uploadSpotted'])->name('uploadSpotted');
        Route::get('/edit-ghazi-spotted/{id}',[SpottedController::class, 'editSpotted'])->name('editSpotted');
        Route::put('/update-ghazi-spotted/{id}',[SpottedController::class, 'updateSpotted'])->name('updateSpotted');
        Route::get('/delete-ghazi-spotted/{id}',[SpottedController::class, 'deleteSpotted'])->name('deleteSpotted');

        Route::post('/spotted-image-upload', [SpottedController::class, 'spottedImage'])->name('spottedImage');
        Route::get('/spotted-image-delete/{id}', [SpottedController::class, 'deleteSpottedImage'])->name('deleteSpottedImage');
        Route::post('/spotted-image-order-update', [SpottedController::class, 'updateSpottedImageOrder'])->name('updateSpottedImageOrder');
        Route::post('/update-Spotted-status/{id}', [SpottedController::class, 'updateSpottedStatus'])->name('updateSpottedStatus');
        
        //////////////////////////////////////////////////////////////
        ///////////////////////    Blog    //////////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/blogs',[BlogController::class, 'blogs'])->name('blogs');
        Route::get('/new-blog',[BlogController::class, 'addNewBlog'])->name('addNewBlog');
        Route::post('/new-blog',[BlogController::class, 'uploadBlog'])->name('uploadBlog');
        Route::get('/edit-blog/{id}',[BlogController::class, 'editBlog'])->name('editBlog');
        Route::put('/update-blog/{id}',[BlogController::class, 'updateBlog'])->name('updateBlog');
        Route::get('/delete-blog/{id}',[BlogController::class, 'deleteBlog'])->name('deleteBlog');
        Route::get('/blog-comment/{id}',[BlogController::class, 'blogComment'])->name('blogComments');

        Route::post('/blog-image-upload', [BlogController::class, 'blogImage'])->name('blogImage');
        Route::get('/blog-image-delete/{id}', [BlogController::class, 'deleteBlogImage'])->name('deleteBlogImage');
        Route::post('/blog-image-order-update', [BlogController::class, 'updateBlogImageOrder'])->name('updateBlogImageOrder');
        Route::post('/update-status/{id}', [BlogController::class, 'updateBlogStatus'])->name('updateBlogStatus');
        
        
        Route::get('/comment',[CommentController::class, 'comment'])->name('comment');
        Route::get('/view-comment/{id}',[CommentController::class, 'viewComment'])->name('viewComment');
        Route::get('/delete-comment/{id}',[CommentController::class, 'deleteComment'])->name('deleteComment');
        //////////////////////////////////////////////////////////////
        ///////////////////    Facebook Pixcel    ///////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/facebook-pixcel/{id}', [FacebookPixcelController::class, 'facebookPixcel'])->name('facebookPixcel');
        Route::put('/facebook-pixcel/{id}', [FacebookPixcelController::class, 'facebookPixcelUpload'])->name('facebookPixcelUpload');

        //////////////////////////////////////////////////////////////
        /////////////////////      Coupon      //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/coupons',[CouponController::class, 'coupon'])->name('admincoupon');
        Route::get('/couponform',[CouponController::class, 'couponform'])->name('admincouponform');
        Route::post('/addcoupon',[CouponController::class, 'addcoupon'])->name('adminaddcoupon');

        //////////////////////////////////////////////////////////////
        ////////////////////    Social Links    /////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/social-links',[SocialLinksController::class, 'socialLinks'])->name('socialLinks');
        Route::get('/add-social-link',[SocialLinksController::class, 'addNewLink'])->name('addNewLink');
        Route::post('/add-social-link',[SocialLinksController::class, 'uploadNewLink'])->name('uploadNewLink');
        Route::get('/edit-social-link/{id}',[SocialLinksController::class, 'editLink'])->name('editLink');
        Route::put('/update-social-link/{id}',[SocialLinksController::class, 'updateLink'])->name('updateLink');
        Route::get('/delete-social-link/{id}',[SocialLinksController::class, 'deleteLink'])->name('deleteLink');

        //////////////////////////////////////////////////////////////
        /////////////////////    Instagram     //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/instagram',[InstagramController::class, 'index'])->name('instagram');
        Route::get('/instagram-feed',  [InstagramController::class,'instafetchpost'])->name('instafetchpost');
        Route::post('/update-instagram-order',  [InstagramController::class, 'instagramUpdateOrder'])->name('updateInstagramOrder');
        
        //////////////////////////////////////////////////////////////
        /////////////////////    Credential    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/credentials',  [CredentialController::class, 'credential'])->name('credentialpage');
        Route::get('/edit-credential/{id}',  [CredentialController::class, 'editcredential'])->name('editcredential');
        Route::put('/edit-credential/{id}',  [CredentialController::class, 'updatecredential'])->name('updatecredential');
    
        //////////////////////////////////////////////////////////////
        /////////////////////       Bulk       //////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/bulk-orders',[BulkController::class, 'indexbulkOrder'])->name('indexbulkOrder');
        Route::get('/view-bulk-order/{id}',[BulkController::class, 'viewBulkOrder'])->name('viewBulkOrder');
        Route::get('/delete-bulk-order/{id}',[BulkController::class, 'deletebulkOrder'])->name('deletebulkOrder');

        //////////////////////////////////////////////////////////////
        ///////////////////    Bulk Surving    //////////////////////
        ////////////////////////////////////////////////////////////

        Route::post('/bulk-serving-image', [BulkSurvingController::class, 'bulkServingImage'])->name('bulkServingImage');
        Route::get('/delete-bulk-serving-image/{id?}',  [BulkSurvingController::class, 'deletebulkServingImage'])->name('deletebulkServingImage');

        Route::get('/bulk-serving-record',[BulkSurvingController::class, 'indexbulkSurvingOrder'])->name('indexbulkSurvingOrder');
        Route::get('/add-bulk-serving-record',[BulkSurvingController::class, 'addbulkSurvingOrder'])->name('addbulkSurvingOrder');
        Route::post('/add-bulk-serving-record',[BulkSurvingController::class, 'postBulkSurvingOrder'])->name('postBulkSurvingOrder');
        Route::get('/delete-bulk-serving-order/{id}',[BulkSurvingController::class, 'deletebulkSurvingOrder'])->name('deletebulkSurvingOrder');
        
        
        //////////////////////////////////////////////////////////////
        ////////////////////    Currency Exchange    /////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/currency',[CurrencyExchangeController::class, 'currency'])->name('currency');
        Route::get('/add-currency',[CurrencyExchangeController::class, 'addCurrency'])->name('addCurrency');
        Route::post('/upload/currency',[CurrencyExchangeController::class, 'uploadCurrency'])->name('uploadCurrency');
        Route::get('/delete/currency/{id}',[CurrencyExchangeController::class, 'deleteCurrency'])->name('deleteCurrency');
        Route::get('/edit-currency/{id}',[CurrencyExchangeController::class, 'editCurrency'])->name('editCurrency');
        Route::post('/update/currency/{id}',[CurrencyExchangeController::class, 'updateCurrency'])->name('updateCurrency');
        
        //////////////////////////////////////////////////////////////
        ////////////////////    Meta Keywords    /////////////////////
        ////////////////////////////////////////////////////////////

        Route::get('/metakeywords',[MetaKeywordController::class, 'metakeywords'])->name('metakeywords');
        Route::get('/add-metakeywords',[MetaKeywordController::class, 'addMetakeywords'])->name('addMetakeywords');
        Route::post('/upload/metakeywords',[MetaKeywordController::class, 'uploadMetakeywords'])->name('uploadMetakeywords');
        Route::get('/delete/metakeywords/{id}',[MetaKeywordController::class, 'deleteMetakeywords'])->name('deleteMetakeywords');
        Route::get('/edit-metakeywords/{id}',[MetaKeywordController::class, 'editMetakeywords'])->name('editMetakeywords');
        Route::post('/update/metakeywords/{id}',[MetaKeywordController::class, 'updateMetakeywords'])->name('updateMetakeywords');
    });
});

/**************************  Front End ***************************/
Route::get('/switch-currency/{currency}', [CurrencyController::class, 'switchCurrency'])->name('switch.currency');
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contactUs');
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist');
Route::get('/lost-password', [FrontendController::class, 'lostPassword'])->name('lostPassword');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blogDetail');
Route::post('/upload/comment', [FrontendController::class, 'upload'])->name('uploadcomment');
Route::get('/account', [FrontendController::class, 'account'])->name('account');

Route::get('/search', [FrontendController::class, 'search'])->name('search');

Route::get('/bulk-order', [BulkOrderController::class, 'bulkOrder'])->name('bulkOrder');
Route::post('/bulk-order', [BulkOrderController::class, 'bulkOrderPost'])->name('bulkOrderPost');
Route::post('/sample-image', [BulkOrderController::class, 'sampleImage'])->name('sampleImage');
Route::get('/delete-sample-image/{id?}',  [BulkOrderController::class, 'deleteSampleImage'])->name('deleteSampleImage');


Route::get('/categories/{id}', [FrontendController::class, 'categories'])->name('categories');
Route::get('/products/{id}', [FrontendController::class, 'products'])->name('products');
Route::get('/products-filter', [FrontendController::class, 'filterByPrice'])->name('productsFilter');

Route::get('/product-detail/{id}', [FrontendController::class, 'productDetail'])->name('productDetail');
Route::post('/remove-from-cart', [FrontendController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/review', [ReviewController::class, 'storeReview'])->name('storeReview');

Route::post('/buy-now', [CartController::class, 'buyNow'])->name('buyNow');
Route::post('/product-remove/{id}', [CartController::class, 'removeProduct'])->name('removeProduct');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');


Route::post('/apply-coupon', [ApplyCouponController::class, 'applyCoupon'])->name('applyCoupon');

Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('processCheckout');

Route::get('/order-complete', [OrderCompleteController::class, 'orderComplete'])->name('orderComplete');