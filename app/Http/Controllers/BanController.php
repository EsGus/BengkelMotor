<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ban;

class BanController extends Controller
{
    public function index() {
        $bans = Ban::all();
        return view('ban', compact('bans'));
    }

    public function store(Request $request) {
        $request->validate([
            'namaBan' => 'required|string|max:100',
            'stok' => 'required|integer', 
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->only(['namaBan', 'stok', 'harga']);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['gambar'] = $filename;
        }

        Ban::create($data);
        return redirect()->route('ban')->with('success', 'Ban berhasil ditambahkan!');
    }
}