<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vote', [VoteController::class, 'create'])->name('vote.create');
Route::post('/vote/step1', [VoteController::class, 'storeStep1'])->name('vote.step1');
Route::get('/vote/step2/{vote}', [VoteController::class, 'step2'])->name('vote.step2');
Route::post('/vote/step2/{vote}', [VoteController::class, 'storeStep2'])->name('vote.storeStep2');
Route::get('/vote/success', function () {
    return 'Votação completa!';
})->name('vote.success');

Route::get('/vote/results', [VoteController::class, 'results'])->name('vote.results');
Route::get('/vote/voters', [VoteController::class, 'votersList'])->name('vote.voters');
