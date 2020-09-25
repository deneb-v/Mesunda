<?php

namespace App\Http\Controllers;

use App\InvoiceDetail;
use App\InvoiceHeader;
use App\Item;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function homeView(){
        $data = Item::getAllItem();
        return view('userView.home', ['data' => $data]);
    }

    static public function generateID($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, $charactersLength - 1)];
        }
        return $id;
    }

    public function checkOut(Request $req){
        $data = $req->data;
        $invoiceID = UserController::generateID();
        $arr = array();
        foreach ($data as $value) {
            $item = Item::findItem($value);
            array_push($arr,$item);
        }
        // dd($arr);
        return redirect(route('invoiceView'))->with(['data' => $arr,'invoiceID' => $invoiceID]);
    }

    public function invoiceView(){
        return view('userView.invoice');
    }

    public function invoice(Request $req, $userID){
        // dd($req);
        $rules=[
            'txt_address' => 'required | string',
            'txt_postalcode' => 'required | integer'
        ];
        $attribute=[
            'txt_address' => 'Address',
            'txt_postalcode' => 'Postal code'
        ];
        $messages=[
            'required' => ':attribute is required.',
            'string' => ':attribute must be string.',
            'integer' => ':attribute must be integer.'
        ];

        $validator = Validator::make($req->all(),$rules,$messages,$attribute);

        if ($validator->fails()) {
            // dd($validator);
            $data = $req->item;
            $arr = array();
            foreach ($data as $value) {
                $item = Item::findItem($value);
                array_push($arr,$item);
            }
            return redirect()->back()->withErrors($validator)->withInput()->with('data',$arr);
        }

        $address = $req->txt_address;
        $postal_code = $req->txt_postalcode;
        InvoiceHeader::addInvoiceHeader($req->invoiceID, $userID, $address, $postal_code);
        for ($x=0; $x < count($req->item); $x++) {
            InvoiceDetail::addInvoiceDetail($req->invoiceID, $req->item[$x], $req->quantity[$x]);
            Item::reduceStock($req->item[$x], $req->quantity[$x]);
        }
        return redirect(route('user'))->with('success','Invoice saved!');
    }

    public function invoiceListView(){
        $data = InvoiceHeader::getAllData();
        return view('userView.invoiceList', ['data' => $data]);
    }

    public function invoicePrint($id){
        $data = InvoiceHeader::getInvoice($id);
        // dd($data);
        $pdf = PDF::loadview('userView.invoicepdf',['data' => $data]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($id.'pdf');
    }

    public function invoiceDetailView($id){
        $data = InvoiceHeader::getInvoice($id);
        return view('userView.invoiceDetail',['data' => $data]);
    }
}
