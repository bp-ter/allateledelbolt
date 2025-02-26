<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\PackageController;
use App\Http\Controllers\api\BrandController;


Route::get('/user', function (Request $request) {
     return $request->user();
})->middleware('auth:sanctum');


Route::get( "/products", [ ProductController::class, "getProducts" ]);
Route::get( "/product", [ ProductController::class, "getProduct" ]);
Route::post( "/newproduct", [ ProductController::class, "addProduct" ]);
Route::put( "/modproduct/{id}", [ ProductController::class, "modifyProduct" ]);
Route::delete( "/delproduct/{id}", [ ProductController::class, "destroy" ]);

Route::get( "/categories", [ CategoryController::class, "getCategories" ]);
Route::post( "/newcategory", [ CategoryController::class, "newCategory" ]);
Route::put( "/modcategory/{id}", [ CategoryController::class, "modifyCategory" ]);
Route::delete( "/delcategory/{id}", [ CategoryController::class, "destroyCategory" ]);

Route::get( "/brands", [ BrandController::class, "getBrands" ]);
Route::post( "/newbrand", [ BrandController::class, "newBrand" ]);
Route::put( "/modbrand/{id}", [ BrandController::class, "modifyBrand" ]);
Route::delete( "/delbrand/{id}", [ BrandController::class, "destroyBrand" ]);

Route::get( "/packages", [ PackageController::class, "getPackages" ]);
Route::post( "/newpackage", [ PackageController::class, "newPackage" ]);
Route::put( "/modpackage/{id}", [ PackageController::class, "modifyPackage" ]);
Route::delete( "/delpackage", [ PackageController::class, "destroyPackage" ]);

