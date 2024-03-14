<?php

use App\Http\Controllers\Accumulatorbonuscontroller;
use App\Http\Controllers\affiliateController;
use App\Http\Controllers\FreebetcondtionsController;
use App\Http\Controllers\freebetsController;
use App\Http\Controllers\PlacebetController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\SavedSelectionsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\webscrapperController;
use App\Models\Freebetconditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//route to place bets
Route::group([], function(){
    Route::get('/mybets/{userid}', [PlacebetController::class, 'getUserBethistory']);
    Route::post('/place-bet', [PlacebetController::class, 'placeBet']);
    Route::delete('/delete/{id}', [PlacebetController::class, 'deleteBetHistory']);
    Route::get('/getAllbets', [PlacebetController::class, 'getAllbetsplaced']);
});

//routes to get bets placed
Route::group([], function(){
    Route::get('/saved-selections', [SavedSelectionsController::class, 'getAllsavedSelections']);
    Route::post('/save-picks', [SavedSelectionsController::class, 'savedBetsSelections']);
    Route::delete('/delete-section/{id}', [SavedSelectionsController::class, 'deleteSavedselections']);
    Route::get('/load-savedcode/{id}', [SavedSelectionsController::class, 'getSavedSelections']);
});

//routes attributed to freebets
Route::group([], function(){
     Route::get('/my-freebets/{user_id}', [freebetsController::class, 'getMyFreeBet']);
     Route::post('/place-freebet/{user_id}/{code}', [freebetsController::class, 'placeFreebet']);
     Route::post('/create-freebet/{user_id}', [freebetsController::class, 'createFreebet']);
     Route::delete('/freebets/{id}', [freebetsController::class, 'deleteFreebet']);
     Route::get('/freebets', [freebetsController::class], 'getAllfreebetpromocode');
});

//all points routes
Route::group([], function(){
    Route::get('/mypoints/{userid}', [PointsController::class, 'getMyPoints']);
    Route::delete('/delete-points/{id}', [PointsController::class, 'deletePoints']);
    Route::get('/users-points', [PointsController::class, 'getAlluserpoints']);
});

//affiliate routes
Route::group([], function () {
    Route::get('/downlines/{id}', [affiliateController::class, 'getMydownlines']);
    Route::get('/affiliates', [affiliateController::class, 'getAllaffilaites']);
    Route::put('/update-affiliate/{id}', [affiliateController::class, 'updateAccumulatorBonus']);
    Route::delete('/delete/{id}', [affiliateController::class, 'deleteRequest']);
    Route::post('/create-affiliate', [affiliateController::class, 'applytobecomAffiliate']);
});

//accumulator bonus routes
Route::group([], function (){
   Route::get('/getbonuses', [Accumulatorbonuscontroller::class, 'getAccumulatorBonus']);
   Route::put('/update-bonus/{id}', [Accumulatorbonuscontroller::class, 'updateAccumulatorBonus']);
   Route::delete('/delete-bonus/{id}', [Accumulatorbonuscontroller::class, 'deleteBonus']);
   Route::post('/create-bonus', [Accumulatorbonuscontroller::class, 'createAccumulatorbonus']);
});

//freebets condition routes
Route::group([], function(){
    Route::get('/accumulator-condition', [FreebetcondtionsController::class, 'getCondtion']);
    Route::post('/create-condition', [FreebetcondtionsController::class, 'createCondition']);
    Route::put('/update-condition/{id}', [FreebetcondtionsController::class, 'updateCondtion']);
    Route::delete('/delete-condition/{id}', [FreebetcondtionsController::class, 'deleteCondition']);
});

//results generation

Route::group([], function(){
    //over under results
    Route::get('/over-under/results', [ResultsController::class, 'getAllresultsoverunder']);
    Route::get('/over-under/results/match/{id}', [ResultsController::class, 'getParticularResult']);
    Route::post('/create-result/over-under', [ResultsController::class, 'createOverUnderResults']);
    Route::delete('/over-under/{id}', [ResultsController::class, 'deleteResultoverunder']);
   // Route::put('/update-result/{id}', [ResultsController::class, '']);
    Route::post('/create-matchwinner', [ResultsController::class, 'createMatchwinnerresult']);
    Route::get('/getmatch-winer/result', [ResultsController::class, 'getmatchwinnerresult']);
    Route::delete('/delete/match-winner/result/{id}', [ResultsController::class, 'deletematchwinnerresult']);
    //over under results end 
    
    //home total and away total results
    Route::get('/total/home-away', [ResultsController::class, 'getHomeAwayTotalResult']);
    Route::post('/create/total-result/home-away', [ResultsController::class, 'createtotalhomeawayresult']);
    Route::delete('/delete/total-result/home-away/{id}', [ResultsController::class, 'deleteHomeAwayResult']);
});

Route::group([], function(){
    Route::get('/scrapped-data', [webscrapperController::class, 'srapeData']);
});

//user routes
Route::group([], function(){
     Route::get('/users', [userController::class, 'getUsers']);
});