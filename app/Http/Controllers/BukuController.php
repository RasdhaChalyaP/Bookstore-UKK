<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_buku = Buku::all();
        return view('index')
        ->with("data_buku",$data_buku);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bukucreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save(Request $request){
        $imgName = $request->gambar->getClientOriginalName() ;
        $request->gambar->move(public_path('images'), $imgName);

        $data_buku = Buku::create([
            "judul"=>$request->input("judul"),
            "gambar"=>$imgName,
            "pengarang"=>$request->input("pengarang"),
            "genre"=>$request->input("genre"),
            "sinopsis"=>$request->input("sinopsis"),
        ]);
        return redirect('/')
        ->with("data_buku",$data_buku);
        }

    public function edit($id){
        $data_buku = Buku::find($id);
        return view('bukuedit')
        ->with("data_buku",$data_buku);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data_buku = Buku::find($id);
        $data_buku->judul = $request->input("judul");
        $data_buku->pengarang = $request->input("pengarang");
        $data_buku->genre = $request->input("genre");
        $data_buku->sinopsis = $request->input("sinopsis");

        if($request->file('gambar')== ""){
            $data_buku->gambar = $data_buku->gambar;
        }else{
            $imgName = $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('images'), $imgName);
            $data_buku->gambar = $imgName;
        }

        $data_buku->save();
        return redirect('/')
            ->with("data_buku",$data_buku);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_buku = Buku::find($id);
        $data_buku->delete();
        return redirect('/')
        ->with("data_buku",$data_buku);
    }
}
