<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Accept, Content-Type, X-CSRF-TOKEN, Authorization');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\UsersController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

//SIGNUP
Route::post('auth/register', 'App\Http\Controllers\v1\UsersController@store');
//LOGIN
Route::post('auth/token',
        function(Request $request) {
            $token = $request->session()->token(); 
            $token = csrf_token();

            $credentials = [        
                'email'=>$request->email,
                'password'=>$request->password
            ];
            if(Auth::attempt($credentials)) {
                $user = Auth::user();
                $userToken = $user->createToken('user-token', ['create', 'update', 'delete']);
                
                return [
                    'user'=>$userToken->plainTextToken,
                    'userId' => $user->id        
                ];
            }
            else return "Invalid credentials";
          
});