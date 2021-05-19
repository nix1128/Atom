<?php

use App\Models\inquiries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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

Route::group(['middleware' => 'api'], function(){



    // Add Contact


    Route::post('/store', function(Request $request){
      return inquiries::create(['name' => $request->input(['name']), 'email' => $request->input(['email']), 'phone' => $request->input(['phone']), 'message' => $request->input(['message'])]);
    });




  });



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
