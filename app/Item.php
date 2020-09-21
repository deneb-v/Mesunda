<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table ='Item';
    protected $primarykey='id';
    protected $fillable =[
        'name',
        'category',
        'price',
        'stock',
        'photo'
    ];

    static public function findItem($id){
        return Item::where('id',$id)->first();
    }

    static public function addItem($name, $category, $price, $stock, $photo){
        Item::create([
            'name' => $name,
            'category' => $category,
            'price' => $price,
            'stock' => $stock,
            'photo' => $photo
        ]);
    }

    static public function updateItem($id ,$name, $category, $price, $stock, $photo){
        $data = Item::findItem($id);
        $data->name = $name;
        $data->category = $category;
        $data->price = $price;
        $data->stock = $stock;
        $data->photo = $photo;
        $data->save();
    }

    static public function deleteItem($id){
        $data = Item::where('id',$id)->first();
        $data->delete();
    }

}
