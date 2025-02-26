<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\BrandRequests;
use App\Http\Resources\Brand as BrandResource;

class BrandController extends Controller {

    public function getBrands() {

        $brands = Brand::all();

        return $this->sendResponse( BrandResource::collection( $brands ), "Márkák betöltve");
    }

    public function getBrand( $brandName ) {

        $brand = Brand::where( "brand", $brandName )->first();

        return $brand;
    }

    public function newBrand( BrandRequest $request ) {

        $request->validated();

        $isBrand = $this->getBrand( $request );
        if( is_null( $isBrand )) {

            $brand = new Brand();
            $brand->brand = $request[ "brand" ];
            $brand->save();

            return $this->sendResponse( new BrandResource( $brand ), "Márka kiírva");

        }else {

            return $this->sendError( "Adathiba", [ "A márka létezik" ], 406 );
        }



    }

    public function modifyBrand( BrandRequest $request, $id ) {

        $request->validated();

        $brand = Brand::find( $id );
        if( !is_null( $brand )) {

            $brand->brand = $request[ "brand" ];

            $brand->update();

            return $this->sendResponse( new BrandResource( $brand ), "Márka módosítva");

        }else {

            return $this->sendError( "Adathiba", [ "A Nincs ilyen kategória" ], 406 );
        }

    }

    public function destroyBrand( Request $request ) {

        $brand = Brand::where( "brand", $request[ "brand" ]);

        if( !is_null( $brand )) {

            $brand->delete();

            return $this->sendResponse( new BrandResource( $brand ), "Márka törölve" );

        }else {

            return $this->sendError( "Adathiba", [ "Márka nem létezik" ], 405 );
        }


        return response()->json([ "Sikeres törlés", "Márka" => $brand ]);
    }

    public function getBrandId( $brandName ) {

        $brand = Brand::where( "brand", $brandName )->first();

        $id = $brand->id;

        return $id;
    }
}
