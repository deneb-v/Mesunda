<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceHeader extends Model
{
    protected $table = 'invoice_header';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'postal_code',
    ];

    public static function addInvoiceHeader($invoice_id, $user_id, $address, $postal_code){
        InvoiceHeader::create([
            'id' => $invoice_id,
            'user_id' => $user_id,
            'address' => $address,
            'postal_code' => $postal_code
        ]);
    }

    public static function getAllData(){
        return InvoiceHeader::all();
    }
    // <th>ID</th>
    //                 <th>Product Image</th>
    //                 <th>Product Name</th>
    //                 <th>Category</th>
    //                 <th>Quantity</th>
    //                 <th>Price</th>
    //                 <th>Sub Total</th>

    public static function getInvoice($id){
        $data = DB::table('invoice_header as ih')
            ->join('invoice_detail as invd','ih.id','=','invd.invoice_id')
            ->join('item as i','invd.item_id','=','i.id')
            ->where('ih.id','=',$id)
            ->get(['ih.id as id',
                'i.photo as photo',
                'i.name as name',
                'i.category as category',
                'invd.quantity as quantity',
                'i.price',
                'ih.address',
                'ih.postal_code'
                ]);
        // dd($data);
        return $data;
    }
}
