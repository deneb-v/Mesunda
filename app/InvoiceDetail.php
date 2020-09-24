<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';
    protected $primarykey = 'id';
    protected $fillable = [
        'invoice_id',
        'item_id',
        'quantity'
    ];
    public $timestamps = false;

    public static function addInvoiceDetail($invoice_id, $item_id, $quantity){
        InvoiceDetail::create([
            'invoice_id' => $invoice_id,
            'item_id' => $item_id,
            'quantity' => $quantity
        ]);
    }
}
