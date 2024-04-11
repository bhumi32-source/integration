<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;

use App\Http\Controllers\API\HotelfacilitiesController;
use App\Http\Controllers\API\CabBookingController;
use App\Http\Controllers\API\RoomServiceController;
use App\Http\Controllers\API\RoomCleaningController;
use App\Http\Controllers\API\SpaController;
use App\Http\Controllers\API\ExtraBedController;
use App\Http\Controllers\API\ExtendStayController;
use App\Http\Controllers\API\LaundryController;
use App\Http\Controllers\API\BookGuideController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\FeedbackController;





Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name("send-otp");
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name("resend-otp");
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name("verify-otp");

Route::get('/hotel-facilities', [HotelfacilitiesController::class, 'index'])->name("hotel-facilities");

Route::get('/room-service', [RoomServiceController::class, 'index'])->name("room-service");

Route::get('/cab-booking', [CabBookingController::class, 'index'])->name("cab-booking");
Route::post('/cab-booking', [CabBookingController::class, 'store'])->name("cab-booking.add");
Route::get('/cab-order-list', [CabBookingController::class, 'show'])->name("cab-order-list");
Route::post('/cab-cancel-order/{id}', [ CabBookingController::class, 'cancelOrder'])->name('cab-cancel-order');

Route::get('/spa', [SpaController::class, 'index'])->name('spa');
Route::post('/spa', [SpaController::class, 'store'])->name('spa.add');
Route::get('/spa-order-list', [SpaController::class, 'show'])->name("spa-order-list");
Route::post('/spa-cancel-order/{id}', [ SpaController::class, 'cancelOrder'])->name('spa-cancel-order');

Route::get('/room-cleaning', [RoomCleaningController::class, 'index'])->name("room-cleaning");
Route::post('/room-cleaning', [RoomCleaningController::class, 'store'])->name("room-cleaning-booking.add");
Route::get('/room-cleaning-order-list', [RoomCleaningController::class, 'show'])->name("room-cleaning-list");
Route::post('/room-cancel-order/{id}', [RoomCleaningController::class, 'cancelOrder'])->name('rcco');

Route::get('/extra-bed',[ExtraBedController::class, 'index'])->name("extra-bed");
Route::post('/extra-bed/add',[ExtraBedController::class, 'store'])->name("extra-bed.add");
Route::get('/extra-bed-orders', [ExtraBedController::class,'show'])->name("extra-bed-orders"); 

Route::get('/extend-stay', [ExtendStayController::class,'index'])->name('extend-stay');
Route::post('/extend-stay/add', [ExtendStayController::class,'store'])->name('extend-stay.add');
Route::get('/extend-stay/list', [ExtendStayController::class,'show'])->name('extend-stay-list'); // Corrected route definition
Route::post('/extendstay-cancel-order/{id}', [ExtendStayController::class, 'cancelOrder'])->name('extend-stay-cancel');

Route::get('/laundry', [LaundryController::class,'index'])->name('laundry');
Route::post('/laundry/add', [LaundryController::class,'store'])->name('laundry.add');
Route::get('laundry/list',[LaundryController::class,'show'])->name('laundry.list');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::middleware(['revalidate'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
});

use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\PastOrderController;

Route::post('/cart/add', [FoodController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/get-all-items', [FoodController::class, 'getAllItems']);
Route::post('/add-to-cart', [CartController::class, 'addItemToCart'])->name('cart.addItemToCart');
Route::get('/food', [FoodController::class, 'index'])->name('food.index');
Route::get('/get-items-by-category/{categoryId}', [FoodController::class, 'getItemsByCategory']);
Route::get('/get-cart-items', [CartController::class, 'getCartItems']);
Route::patch('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/remove-cart-item', [CartController::class, 'removeCartItem'])->name('cart.removeCartItem');
Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order-success');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::get('/past_order', [PastOrderController::class, 'index'])->name('past_order.index');
Route::get('/get-menu-of-the-day-items', [FoodController::class, 'getMenuOfTheDayItems']);
Route::get('/get-bar-categories', [FoodController::class, 'getBarCategories']);
Route::get('/get-bar-items', [FoodController::class, 'getBarItems'])->name('get.bar.items');
Route::get('/get-bar-items-by-category/{categoryId}', [FoodController::class, 'getBarItemsByCategory']);

// for toiletries
use App\Http\Controllers\API\ToiletriesController;
use App\Http\Controllers\API\ToiCartController;
use App\Http\Controllers\API\PastToiController;
Route::get('/toiletries', function () {
    return view('toiletries');
})->name('toiletries');
Route::get('/toiletries', [ToiletriesController::class, 'index'])->name('toiletries.index');
Route::get('/get-all-toiletries', [ToiletriesController::class, 'getAllToiletries']);
Route::post('/add-to-toiletries-cart/{toiletry}', [ToiletriesController::class, 'addToToiletriesCart']);
Route::get('/get-toiletries-cart-items', [ToiletriesController::class, 'getToiletriesCartItems']);
Route::get('/show-toiletries-cart', [ToiletriesController::class, 'showToiletriesCart']);
Route::get('/toiletries/cart/items', [ToiletriesController::class, 'getToiletriesCartItems'])->name('toiletries.cart.items');
Route::get('/past_toi', [ToiCartController::class, 'showPastToiletries'])->name('past-toi');
Route::post('/toiletries/cart/add', [ToiletriesController::class, 'addToCart'])->name('toiletries.cart.add');Route::get('/toiletries/cart', [ToiletriesController::class, 'getCartItems'])->name('toiletries.cart');
Route::get('/toiletries/cart', [ToiCartController::class, 'getCartItems'])->name('toiletries.cart');
Route::get('/past_toi', [PastToiController::class, 'index'])->name('past_toi');
// Route for removing an item from the cart
Route::delete('/removeCartItem', [ToiCartController::class, 'removeCartItem'])->name('toiletries.removeCartItem');
// Route for updating the quantity of an item in the cart
Route::patch('/updateQuantity', [ToiCartController::class, 'updateQuantity'])->name('toiletries.updateQuantity');
// Route for placing an order for toiletries
Route::post('/placeOrder', [PastToiController::class, 'placeOrder'])->name('placeOrder');
Route::post('/placeOrder', [ToiCartController::class, 'placeOrder'])->name('placeOrder');


//for Linen
use App\Http\Controllers\API\LinenController;
use App\Http\Controllers\API\LinenCartController;
use App\Http\Controllers\API\PastLinenController;

Route::get('/past-linen', [PastLinenController::class, 'index'])->name('past_linen');
Route::get('/linen', [LinenController::class, 'index'])->name('linen.index');
Route::get('/linen/cart', [LinenCartController::class, 'index'])->name('linen.cart.index');
Route::delete('/linen/removeCartItem', [LinenCartController::class, 'removeCartItem'])->name('linen.removeCartItem');
Route::patch('/linen/updateQuantity', [LinenCartController::class, 'updateQuantity'])->name('linen.updateQuantity');
Route::get('/linen/cart', [LinenCartController::class, 'index'])->name('linen.cart.index');
Route::post('/linen/cart', [LinenController::class, 'addToCart'])->name('linen.addToCart'); // Assuming LinenController handles adding items to the cart
Route::get('/linen/getQuantity', 'LinenCartController@getQuantity')->name('linen.getQuantity');
Route::post('/placeOrder', [LinenCartController::class, 'placeOrder'])->name('placeOrder');

//menu of the day
use App\Http\Controllers\API\MenuController;

// Define a route to render the menu page
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');





use App\Http\Controllers\API\DecorationController;
use App\Http\Controllers\API\BookingController;

Route::get('/hotel_facilities', [HotelFacilitiesController::class, 'index'])->name('hotel_facilities');
Route::get('/custom_decoration', [HotelFacilitiesController::class, 'customDecoration'])->name('custom_decoration');

Route::get('/orders', 'OrderController@index')->name('orders');


Route::get('/decorations/{id}/description', [DecorationController::class, 'getDescription']);
Route::post('/decoration/book/{id}', [DecorationController::class, 'book'])->name('decoration.book');
Route::get('/order/decoration', [DecorationController::class, 'showOrders'])->name('order.decoration');
Route::get('/decorations/{id}/booking-time-range', [DecorationController::class, 'getBookingTimeRange']);
Route::put('/cancel-booking/{id}', [DecorationController::class, 'cancelBooking'])->name('booking.cancel');




Route::get('/book_guide', [GuideController::class, 'showAll'])->name('book_guide');

Route::get('/book_guide', [GuideController::class, 'show'])->name('book_guide');
Route::post('/book-guide/{id}', [GuideController::class, 'book'])->name('book_guide.book');
Route::get('/book_guide_details', [GuideController::class, 'showAll'])->name('book_guide_details');
Route::post('/cancel-booking/{id}', [GuideController::class, 'cancelBooking'])->name('cancel_booking');
Route::get('/guide/booking-description/{guide_id}', [GuideController::class, 'getBookingDescription']);
// Route for cancelling a booking using PUT method
Route::put('/guide/cancel-booking/{guideId}', [GuideController::class, 'cancelBooking'])->name('guide.cancel.booking');



// Route for viewing the update booking time form
Route::get('/updateDecoration', [DecorationController::class, 'updateDecorationView'])->name('update_decoration_view');
// Inside your routes/web.php file
Route::put('/decorations/{id}/update-booking-time', [DecorationController::class, 'updateBookingTime'])->name('decorations.updateBookingTime');
Route::put('/cancel-booking/{id}', [DecorationController::class, 'cancelBooking'])->name('cancel.booking');



// Route::put('/decorations/{id}/update-description', [DecorationController::class, 'updateDescription'])->name('decorations.update-description');

// // this is updating name 
// Route::put('/decorations/{id}/update-name', [DecorationController::class, 'updateName'])->name('decorations.update-name');



Route::put('/decorations/{id}/update-name', [DecorationController::class, 'updateName'])->name('decorations.updateName');
Route::put('/decorations/{id}/update-description', [DecorationController::class, 'updateDescription'])->name('decorations.updateDescription');