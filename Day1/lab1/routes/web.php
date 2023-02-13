<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

use Laravel\Socialite\Facades\Socialite;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => ['auth']], function () {

Route::get('/',[PostController::class, 'index']);

Route::get('/posts',[PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store']);

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');



Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::get('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::get('/posts/{post}/reback', [PostController::class, 'reback'])->name('posts.reback');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
});

Auth::routes();

 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('/auth/redirect',function(){
//     return Socialite::driver('google')->redirect();

// });


// Route::get('/auth/callback',function(){
//     $userdata = Socialite::driver('google')->user();
//         $user = User::where('email', $userdata->email)->where('auth_type','google')->first();
//         if (!$user) {
//             $uuid=Str::uuid()->toString();
//             $user = new User();
//             $user->name = $userdata->name;
//             $user->email = $userdata->email;
//             $user->password = Hash::make($uuid.now());
//             $user->auth_type = 'google';
//             $user->save();
//             Auth::login($user);
//             return redirect('/home');
//             }

//         else{
//             Auth::login($user);
//             return redirect('/home');
//         }
// });
