<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAchive;
use App\Models\fatora;
use Illuminate\Http\Request;

class InvoiceAchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = fatora::onlyTrashed()->get();
        return view('fatora.Archive_Invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceAchive  $invoiceAchive
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceAchive $invoiceAchive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceAchive  $invoiceAchive
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceAchive $invoiceAchive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceAchive  $invoiceAchive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = fatora::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceAchive  $invoiceAchive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = fatora::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');
    }
}
