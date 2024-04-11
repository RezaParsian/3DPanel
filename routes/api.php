<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;

AuthController::routes();
ProjectController::routes();
FileController::routes();