<?php

use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\Api\FormationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::POST('registerUser',[UserController::class,'register']);
Route::POST('loginUser',[UserController::class,'login']);
Route::group(['middleware' => [ 'jwt.auth','role:user'],'prefix'=>'user'], function () {



Route::POST('logoutUser',[UserController::class,'logoutUser']);



Route::get('allformation',[FormationController::class,'formationdiff']);
Route::post('ajoutcandidature',[CandidatureController::class,'store']);

});

//admin

Route::get('indexAdmin',[UserController::class,'index']);

Route::POST('registerAdmin',[AdminController::class,'registerAdmin']);

Route::POST('loginAdmin',[AdminController::class,'loginAdmin']);
Route::POST('logoutAdmin',[AdminController::class,'logoutAdmin']);



Route::group(['middleware' => [ 'jwt.auth','role:admin'],'prefix'=>'admin'], function () {
    Route::get('listeformation',[FormationController::class,'index']);

    
Route::patch('candidatureAccepte/{candidature}',[CandidatureController::class,'acceptCandidature']);
Route::patch('candidaturedecline/{candidature}',[CandidatureController::class,'refuseCandidature']);

Route::post('ajoutformation',[FormationController::class,'store']);
Route::post('modifierformation/{formations}',[FormationController::class,'update']);

Route::delete('supprimerformation/{formations}',[FormationController::class,'destroy']);
Route::get('listecandidatureAccepte',[CandidatureController::class,'listecandidatureAccept']);
Route::get('listecandidaturedecline',[CandidatureController::class,'listecandidatureDecline']);
Route::get('indexUser',[UserController::class,'index']);

});




//Formation


//candidature






Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});
