<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            "product" => "required|min:3|max:15|alpha:ascii|unique:products,product",
            "brand" => "required|numeric",
            "category" => "required|numeric",
            "package" => "required|numeric",
            "price" => "required|numeric"
        ];
    }

    public function messages() {

        return [
            "product.required" => "Termék név elvárt!",
            "product.max" => "Túl hosszú név",
            "product.min" => "Túl rövid név",
            "product.unique" => "Az adat már létezik",
            "product.alpha" => "Csak betűk lehetnek.",

        ];
    }

    public function failedValidation( Validator $validator ) {

        throw new HttpResponseException( response()->json([

            "success" => false,
            "message" => "Beviteli hiba",
            "data" => $validator->errors()
        ]));
    }
}
