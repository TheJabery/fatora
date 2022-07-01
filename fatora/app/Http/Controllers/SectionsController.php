<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Sections:: all();
        return view('Sections.Section', compact('sections'));
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
            'Section_name' => 'required|unique:sections|max:255',
            'Description' => 'required',
        ]
        ,[
            // 'Section_name.required' =>'يجب إدخال الأسم',
            // 'Section_name.unique' =>' الأسم موجود مسبقا',
            // 'Section_name.max' =>'  يجب أن يكون الاسم اقل من 255 حرفا',
            // 'Description.required' =>'يجب إدخال الوصف',
        ]);

            Sections::create([
                    'Section_name'=>$request->Section_name,
                    'Description'=>$request->Description,
                    'creator'=>(Auth::user()->name),
                            ]);
        session()->flash('Add','Done Successfully');
        return redirect('/Sections');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'Section_name' => 'required|max:255|unique:sections,Section_name,'.$id,
            'Description' => 'required',
        ],[

            // 'section_name.required' =>'يرجي ادخال اسم القسم',
            // 'section_name.unique' =>'اسم القسم مسجل مسبقا',
            // 'description.required' =>'يرجي ادخال البيان',

        ]);
        $Sections = Sections::find($id);
        $Sections->update([
            'Section_name' => $request->Section_name,
            'Description' => $request->Description,
        ]);

        session()->flash('edit','Updated successfully');
        return redirect('/Sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('delete','Done Successfully');
        return redirect('Sections');
    }
}
