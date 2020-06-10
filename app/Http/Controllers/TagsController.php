<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::paginate(10);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3'],
            [
                'name.required' => 'wajib di isi guyss'
            ]
        );

        $messages = [
            'required' => 'The :wajib di isi.',
        ];
        
        $validator = Validator::make($input, $rules, $messages);

        $tags = Tags::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        
        return redirect()->route('tags.index')->with('success', 'Tags berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tags::findorfail($id);
        return view('tags.update', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $tags_category = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Tags::whereId($id)->update($tags_category);
        return redirect()->route('tags.index')->with('success', 'Berhasil update tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tags::findorfail($id);
        $tags->delete();

        return redirect()->back()->with('success', 'berhasil di hapus');
    }
}
