<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // Menampilkan daftar motor
    public function index()
    {
        $motors = Motor::all();
        // Mengarah ke file resources/views/motor.blade.php
        return view('motor', compact('motors')); 
    }

    // Form tambah motor
    public function create()
    {
        // Mengarah ke file resources/views/motor_tambah.blade.php
        return view('motor_tambah'); 
    }

    // Simpan data motor
    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'tipe_motor' => 'required|string|max:50',
        ]);

        Motor::create($request->all());

        return redirect()->route('motor.index')->with('success', 'Data Motor Berhasil Ditambah');
    }

    // Form edit motor
    public function edit($id)
    {
        $motor = Motor::findOrFail($id);
        // Mengarah ke file resources/views/motor_edit.blade.php
        return view('motor_edit', compact('motor')); 
    }

    // Update data motor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'tipe_motor' => 'required|string|max:50',
        ]);

        $motor = Motor::findOrFail($id);
        $motor->update($request->all());

        return redirect()->route('motor.index')->with('success', 'Data Motor Diupdate');
    }

    // Hapus data motor
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();
        return redirect()->route('motor.index')->with('success', 'Data Motor Dihapus');
    }
}