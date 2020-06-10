<?php

namespace App\Http\Controllers;

use App\Category;
use App\Posts;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('posts.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //membuat validasi
        $this->validate($request, [ 
            'judul' => 'required|min:5',
            'category_id' => 'required',
            'content' => 'required',
            'gambar'  => 'required'
        ]);

        //inisialisasi gambar
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        //memasukan data ke database
        $posts = Posts::Create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'public/uploads/posts/' .$new_gambar,
            'slug'  => Str::slug($request->judul)
        ]);

        $posts->tags()->attach($request->tags);

        //mempindahkan gambar
        $gambar->move('public/uploads/posts/', $new_gambar);
        return redirect()->back()->with('success', 'Postingan anda berhasil di simpan');
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
        $category = Category::all();
        $tags = Tags::all();
        $posts = Posts::findorfail($id);
        return view('posts.update', compact('posts','tags','category'));
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
            'judul' => 'required|min:5',
            'category_id' => 'required',
            'content' => 'required',

        ],
        [
            'judul.required' => 'tidak boleh kosong'
        ]
    );

        $posts = Posts::findorfail($id);

        if($request->has('gambar')){
           $gambar = $request->gambar;
           $new_gambar = time().$gambar->getClientOriginalName();
           $gambar->move('public/uploads/posts/', $new_gambar);

           $posts_data = [
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content'   => $request->content,
            'gambar'    => 'public/uploads/posts/'.$new_gambar,
            'slug'      => Str::slug($request->judul)
           ];
        }else{
           $posts_data = [
            'judul'     => $request->judul,
            'category_id' => $request->category_id,
            'content'   => $request->content,
            'slug'      => Str::slug($request->judul)
           ];
        }

        $posts->tags()->sync($request->tags);
        $posts->update($posts_data);

        //mempindahkan gambar
        return redirect()->route('posts.index')->with('success', 'Postingan anda berhasil di simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
