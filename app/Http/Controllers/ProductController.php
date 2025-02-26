<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;

class ProductController extends ResponseController {

    public function getProducts() {

        $products = Product::with( "package", "category", "brand" )->get();

        return $this->sendResponse( ProductResource::collection( $products ), "Sikeres olvasás");
    }

    public function getProduct( Request $request ) {


        $product = Product::where( "name", $request["name"] )->get();

        return $this->sendResponse( new ProductResource( $product ), "Sikeres olvasás");
    }


    public function addProduct( ProductRequest $request ) {

        $product = new Product;
        $product->product = $request["name"];
        $product->category_id = ( new CategoryController )->getTypeId( $request[ "category" ]);
        $product->package_id = ( new PackageController )->getPackageId( $request[ "package" ]);
        $product->brand_id = ( new BrandController )->getBrandId( $request[ "brand" ]);
        $product->price =  $request[ "price" ];

        $products->save();

        return $this->sendResponse( $product, "Sikeres felírás" );
    }

    public function modifyProduct( Request $request  ) {

        $request->validated();
        $product = Product::find( $request[ "name" ]);
        return $product->product;
        if( is_null( $product )) {

            $this->sendError( "Adathiba", [ "Nincs ilyen termék" ] );

        }else {

            $product->product = $request["name"];
            $product->brand_id = $request["brand_id"];
            $product->category_id = $request["category_id"];
            $product->package_id = $request["package_id"];
            $product->price = $request["price"];

            $product->update();

            return $this->sendResponse( $product, "Sikeres módosítás" );
        }



    }

    public function destroy( $id ) {

        $product = Product::find( $id );
        $product->delete();

        return $this->sendResponse( $product, "Sikeres törlés" );
    }
}
