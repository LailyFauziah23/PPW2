<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        // Mengambil semua data kategori dari database menggunakan query builder
        $categories = DB::table('categories')->get();
        return view('categories.index', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Menyimpan data kategori ke database menggunakan query builder
        DB::table('categories')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
}
