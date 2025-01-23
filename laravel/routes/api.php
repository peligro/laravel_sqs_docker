<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3Controller;
 

Route::post('/s3-upload-storage', [S3Controller::class, 's3_upload_storage']);
Route::delete('/s3-upload-storage-borrar', [S3Controller::class, 's3_upload_storage_borrar']);

Route::post('/s3-upload-s3', [S3Controller::class, 's3_upload_s3']);
Route::delete('/s3-upload-s3-borrar', [S3Controller::class, 's3_upload_s3_borrar']);

