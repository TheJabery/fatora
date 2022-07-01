<?php

namespace App\Http\Controllers;

use App\Models\inovices;
use Illuminate\Http\Request;
use App\Models\Sections;
use PhpParser\Node\Stmt\Return_;

class InovicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Sections:: all();
        $inovices=inovices::all();
        return view('invoices.invoices',compact('sections','inovices'));
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
        $input = $request->all();
        $validated = $request->validate([
            'Invoice_Name' => 'required|unique:inovices|max:255',
            'Description' => 'required',
        ]
        ,[
            // 'Section_name.required' =>'يجب إدخال الأسم',
            // 'Section_name.unique' =>' الأسم موجود مسبقا',
            // 'Section_name.max' =>'  يجب أن يكون الاسم اقل من 255 حرفا',
            // 'Description.required' =>'يجب إدخال الوصف',
        ]);

        inovices::create([
            'Invoice_Name' => $request->Invoice_Name,
            'Section_id' => $request->Section_id,
            'Description' => $request->Description,
        ]);
        session()->flash('Add', 'Done Successfully ');
        return redirect('/invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inovices  $inovices
     * @return \Illuminate\Http\Response
     */
    public function show(inovices $inovices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inovices  $inovices
     * @return \Illuminate\Http\Response
     */
    public function edit(inovices $inovices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inovices  $inovices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inovices $inovices)
    {
        $id = Sections::where('Section_name', $request->Section_name)->first()->id;

        $inovices = inovices::findOrFail($request->pro_id);

        $inovices->update([
        'Invoice_Name' => $request->Invoice_Name,
        'Description' => $request->escription,
        'section_id' => $id,
        ]);

        session()->flash('Edit','Updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inovices  $inovices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Products = inovices::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'Deleted Successfully');
        return back();
    }
}
