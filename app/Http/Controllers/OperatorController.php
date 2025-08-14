<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function dashboard()
    {
        return view('operator.dashboard');
    }

    public function createGuru()
    {
        return view('operator.create-guru'); // file resources/views/operator/create-guru.blade.php
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('operator.dashboard')->with('success', 'Guru berhasil ditambahkan.');
    }
}
