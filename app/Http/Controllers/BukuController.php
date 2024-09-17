<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Buku;

class BukuController extends Controller
{
    public function index (){
        $data_buku = Buku::all()->sortByDesc('id');

        $jumlah_buku = $data_buku->count(); 
        $total_harga = $data_buku->sum('harga'); 
        
        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }
}
