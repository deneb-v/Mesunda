<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    protected $table = 'invoice_header';
    protected $primarykey = 'id';
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

}
