<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Database\Factories\ListingFactory;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// All Job Listings
/*Route::get('/', function () {
    return view('listings', [
        'listings' => Listing::all()
    ]);
});
*/
// Now I am passing ListingController methods instead of function
Route::get('/', [ListingController::class, 'index']);
// Single Job Listing
/*Route::get('listing/{id}', function ($id) {
    $listing = Listing::find($id);
    if ($listing) {
        return view('listing', [
            'jobDetails' => $listing,
        ]);
    } else {
        abort('404');
    }
});*/
// Right Model Binding
// Single Job Listing Optimized way with out abort function
// The Below function is passing the {id} to Listing Model and getting records and
// passing to {listing} view
/*Route::get('listing/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing
    ]);
});*/
// Now I am passing ListingController methods instead of function
Route::get('/listing/{listing}', [ListingController::class, 'show']);



/*
Route::get('/hello', function () {
    return response('<h1>Hello</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('Foo', 'bar');
});

Route::get('/posts/{id}', function ($id) {
    ddd($id);
    return response('Posts' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    dd($request->name . ' ' . $request->age);
});
*/


// Common Resource Routes

// index- showw all listings
// show - show single listing

// create - Show form to create new listing
// store - Store new listing

// edit - show form to edit listing
// update - Update listing

// destroy - delete listing    


// Store Listing The Job Listing
Route::post('/listings', [ListingController::class, 'store']);


// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
// Edit Submit to Update
Route::put('listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
// Delete Job Post
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');


// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
