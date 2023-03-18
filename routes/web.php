<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebSocketController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', [WebSocketController::class, 'showForm'])->name("echo-form");
Route::post('/send-message', [WebSocketController::class, 'showMessage'])->name("echo-message");

//Route::post('/send-message', function (Request $request) {
////    $client = new Predis\Client('tcp://127.0.0.1:6379?database=15');
//    event(new \App\Events\SendMessage());
//    $client = new Predis\Client(array(
//        'scheme'   => 'tcp',
//        'host'     => '127.0.0.1',
//        'port'     => 6379,
//        'database' => 'websocket'
//    ));
//
//    $message = $request->input('message');
//    $client->set('messages', $message);
//    $value = $client->get('messages');
//
//    echo $message; exit;
//
////    Redis::set('messages', json_encode($message));
////    return response()->json(['message' => $message]);
//});
//
//Route::get('/do', function () {
//    event(new \App\Events\SendMessage());
//    dd('Event Run Successfully.');
//});
