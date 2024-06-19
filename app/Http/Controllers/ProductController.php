<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(){

    }

    public function create(){
        return view('product.create');
    }

   public function store(Request $request){

        $rules = array(
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric|min:1',

        );

        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect()->route('product.create')->withInput()->withErrors($validator);
        }


   }


}
