<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\Controller;

Route::get('/agents', [AgentController::class, 'getAllAgents']);
Route::get('/agents/whereActive', [AgentController::class, 'getActiveAgents']);
Route::get('/agents/fresh/{name?}', [AgentController::class, 'tryFresh']);
Route::get('/agents/refresh/{name?}', [AgentController::class, 'tryRefresh']);
Route::get('/agents/rejectActive', [AgentController::class, 'getRejectActiveAgents']);
Route::get('/agents/chunkActive', [AgentController::class, 'chunkUpdateActive']);
Route::get('/agents/lazyActive', [AgentController::class, 'lazyUpdateActive']);


Route::get('/interactions/last_per_agent', [InteractionController::class, 'lastPerAgent']);
Route::post('/interactions/update_or_create', [InteractionController::class, 'updateOrCreateInteraction']);
