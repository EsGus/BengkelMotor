<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Oli;

class OliController extends Controller
{
    public function index() {
        $olis = Oli::all();
        return view('oli', compact('olis'));
    }

    public function store(Request $request) {
        $request->validate([
            'namaOli' => 'required|string|max:100',
            'stok' => 'required|integer', 
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->only(['namaOli', 'stok', 'harga']);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['gambar'] = $filename;
        }

        Oli::create($data);
        return redirect()->route('oli')->with('success', 'Oli berhasil ditambahkan!');
    }
}