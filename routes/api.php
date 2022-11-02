<?php
// use App\Http\Controllers\TestController;
// use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PictureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\models\Picture;

 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/users', [TestController::class, 'getMethode']);

// Route::post('/users', [TestController::class, 'postMethode']);


// Route::get('/env',function(){

//         return response()->json([
//         'connection'=>env('DB_CONNECTION'),
//         'host'=>env('DB_HOST'),
//         'port'=>env('DB_PORT'),
//         'database'=>env('DB_DATABASE'),
//         'username'=>env('DB_USERNAME'),
//         'password'=>env('DB_PASSWORD')
//         ]);

// });

// Route::get('/photos', [PhotoController::class, 'index']);

// Route::post('/photos', [PhotoController::class, 'store'])->middleware('App\Http\Middleware\PhotoMiddleware');

Route::post('/pictures', [PictureController::class, 'store'])->middleware('App\Http\Middleware\React');
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/pictures',function (){
$pictures=Picture::all();
return response()->json($pictures);
});