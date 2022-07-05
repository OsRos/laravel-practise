<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client; 

$response = Http::get('http://example.com');

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('command', function (Request $request) {
    callAPI(createAPIUrl($request->path()));
});

Route::get('command-async', function (Request $request) {
    callAPI(createAPIUrl($request->path()));
});

Route::get('command-async-annotation', function (Request $request) {
    callAPI(createAPIUrl($request->path()));
});


function createAPIUrl(string $path): string
{
    return str_replace("api/", "/", $path);
}

function callAPI(string $path, string $base = "http://localhost:8080"): void
{
    $api = $base . $path;
    $client = new Client();
    $client->getAsync($api)->then(function($response){
        echo $response;
    });
}
