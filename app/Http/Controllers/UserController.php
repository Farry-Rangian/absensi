<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_assisten' => 'required',
            'join_date' => 'required',
            'role' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_assisten' => $request->id_assisten,
            'join_date' => $request->join_date,
            'role' => $request->role
        ]);

        // dd($user);

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, User $user)
{
    $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'id_assisten' => 'required',
        'join_date' => 'required',
        'role' => 'required',
    ]);

    // Get user data by ID
    $user = User::findOrFail($user->id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'id_assisten' => $request->id_assisten,
        'join_date' => $request->join_date,
        'role' => $request->role
    ]);

    if ($user) {
        // Redirect with success message
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diupdate!']);
    } else {
        // Redirect with error message
        return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus!');
    }

}
