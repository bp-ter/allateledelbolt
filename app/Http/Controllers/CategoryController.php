<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequests;
use App\Http\Resources\Category as CategoryResource;


class CategoryController extends Controller {

    public function getCategories() {

        $category = Category::all();

        return $this->sendResponse( CategoryResource::collection( $categories ), "Kategóriák betöltve");
    }

    public function getCategory( $categoryName ) {

        $category = Category::where( "category", $categoryName )->first();

        return $category;
    }

    public function newCategory( CategoryRequest $request ) {

        $request->validated();

        $isCategory = $this->getCategory( $request );
        if( is_null( $isCategory )) {

            $category = new Category();
            $category->category = $request[ "category" ];
            $category->save();

            return $this->sendResponse( new CategoryResource( $category ), "Kategória kiírva");

        }else {

            return $this->sendError( "Adathiba", [ "A kategória létezik" ], 406 );
        }



    }

    public function modifyCategory( CategoryRequest $request, $id ) {

        $request->validated();

        $category = Category::find( $id );
        if( !is_null( $category )) {

            $category->category = $request[ "category" ];

            $category->update();

            return $this->sendResponse( new CategoryResource( $category ), "Kategória módosítva");

        }else {

            return $this->sendError( "Adathiba", [ "A Nincs ilyen kategória" ], 406 );
        }

    }

    public function destroyCategory( Request $request ) {

        $category = Category::where( "category", $request[ "category" ]);

        if( !is_null( $category )) {

            $category->delete();

            return $this->sendResponse( new CategoryResource( $category ), "Kategória törölve" );

        }else {

            return $this->sendError( "Adathiba", [ "Kategória nem létezik" ], 405 );
        }


        return response()->json([ "Sikeres törlés", "Kategória" => $category ]);
    }

    public function getCategoryId( $categoryName ) {

        $category = Category::where( "category", $categoryName )->first();

        $id = $category->id;

        return $id;
    }
}
