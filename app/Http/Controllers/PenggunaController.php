<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['role'])->orderBy('created_at', 'desc')->paginate(5);
        // $data = json_decode($users);
        // dd($users);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required'
        ]);


        if ($user = User::create($request->input())) {
            $role = Role::find($request->role);
            $user->attachRole($role);
            return redirect()->route('user.index')->with([
                'type' => 'success',
                'msg' => 'Pengguna ditambahkan'
            ]);
        } else {
            return redirect()->route('user.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'role' => 'required'
        ]);

        // Hash the password if it is not null
        if ($request->password != null) {
            $request->merge(['password' => Hash::make($request->password)]);
        } else {
            // Remove password field from request if it is null
            $request->request->remove('password');
            $request->request->remove('password_confirmation');
        }

        // Detach existing roles
        $user->roles()->detach();

        // Attach the new role
        $role = Role::find($request->role);
        $user->roles()->attach($role);

        // Update the user details
        $user->fill($request->except(['password_confirmation', 'role']));

        if ($user->save()) {
            return redirect()->route('user.index')->with([
                'type' => 'success',
                'msg' => 'Pengguna diubah'
            ]);
        } else {
            return redirect()->route('user.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('user.index')->with([
                'type' => 'success',
                'msg' => 'Pengguna dihapus'
            ]);
        } else {
            return redirect()->route('user.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }
}
