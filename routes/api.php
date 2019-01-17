<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tickets/kitchen', 'api\v1\TicketController@getKitchenTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');

Route::get('/tickets/bar', 'api\v1\TicketController@getBarTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');

Route::get('/tickets/all', 'api\v1\TicketController@getTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');
