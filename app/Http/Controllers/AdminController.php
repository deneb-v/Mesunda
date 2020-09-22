<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminView(){
        $data = Item::all();
        return view('adminView.manageItem',['data' => $data]);
    }

    public function addItemView(){
        return view('adminView.addItem');
    }

    public function updateItemView($id){
        $data = Item::findItem($id);
        return view('adminView.updateItem', ['data' => $data]);
    }

    public function addItem(Request $req){
        // dd($req->category);
        $rules = [];
        if ($req->category == 'other') {
            $rules =[
                'txt_name' => 'required | string | min:5 | max:80 ',
                'txt_category' => 'required | string ',
                'txt_price' => 'required | integer',
                'txt_stock' => 'required | integer',
                'img_product' => 'image|mimes:jpeg,png',
            ];
        }
        else{
            $rules =[
                'txt_name' => 'required | string | min:5 | max:80 ',
                'category' => 'notin:zero',
                'txt_price' => 'required | integer',
                'txt_stock' => 'required | integer',
                'img_product' => 'image|mimes:jpeg,png',
            ];
        }
        $attributes=[
            'txt_name' => 'Product name',
            'txt_category' => 'Category',
            'category' => 'Category',
            'txt_price' => 'Price',
            'txt_stock' => 'Stock',
            'img_product' => 'Product image',
        ];
        $messages=[
            'required' => ':attribute is required.',
            'image' => ':attribute must be a image.',
            'mimes' => ':attribute format must be :values.',
            'min' => ':attribute must be at least :min characters long.',
            'max' => ':attribute must be less than :max characters.',
            'string' => ':attribute must be string.',
            'integer' => ':attribute must be integer.',
            'notin' => ':attribute is required.',
        ];
        // dd($rules);
        $this->validate($req,$rules,$messages,$attributes);

        // 'name',
        // 'category',
        // 'price',
        // 'stock',
        // 'photo'
        $name = $req->txt_name;
        $category = '';
        if($req->category!='other'){
            $category = $req->category;
        }
        else{
            $category = $req->txt_category;
        }
        $price = $req->txt_price;
        $stock = $req->txt_stock;

        $photo="";
        if(empty($req->img_product)){
            $photo = null;
        }
        else{
            $photo = $req->file('img_product')->store('img');
        }

        Item::addItem($name,$category,$price,$stock,$photo);
        return back()->with("success", 'Product added successfully!');
    }

    public function updateItem($id, Request $req){
        $rules =[
            'txt_name' => 'required | string | min:5 | max:80 ',
            'txt_category' => 'required | string ',
            'txt_price' => 'required | integer',
            'txt_stock' => 'required | integer',
            'img_product' => 'image|mimes:jpeg,png',
        ];
        $attributes=[
            'txt_name' => 'Product name',
            'txt_category' => 'Category',
            'txt_price' => 'Price',
            'txt_stock' => 'Stock',
            'img_product' => 'Product image',
        ];
        $messages=[
            'required' => ':attribute is required.',
            'image' => ':attribute must be a image.',
            'mimes' => ':attribute format must be :values.',
            'min' => ':attribute must be at least :min characters long.',
            'max' => ':attribute must be less than :max characters.',
            'string' => ':attribute must be string.',
            'integer' => ':attribute must be integer.'
        ];

        $this->validate($req,$rules,$messages,$attributes);

        // 'name',
        // 'category',
        // 'price',
        // 'stock',
        // 'photo'
        $name = $req->txt_name;
        $category = $req->txt_category;
        $price = $req->txt_price;
        $stock = $req->txt_stock;

        $photo = "";
        if (empty($req->img_product)) {
            $data = Item::findItem($id);
            $photo = $data->photo;
        }
        else{
            $data = Item::findItem($id);
            $photo = $data->photo;
            Storage::delete($photo);
            $photo = $req->file('img_product')->store('img');
        }

        Item::updateItem($id,$name,$category,$price,$stock,$photo);
        return redirect(route('admin'))->with("success", 'Product updated successfully!');
    }

    public function deleteData($id){
        $data = Item::findItem($id);
        $photo = $data->photo;
        Storage::delete($photo);
        Item::deleteItem($id);
        return back()->with('success', 'Product deleted!');
    }
}
