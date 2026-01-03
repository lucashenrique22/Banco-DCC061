<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'cpf' => 'required|string|unique:users,cpf,' . $user->id,
            'role' => 'required|in:administrador,usuario',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only('name', 'cpf', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:administrador,usuario',
        ]);

        User::create([
            'name' => $request->name,
            'cpf' => preg_replace('/\D/', '', $request->cpf),
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Usuário removido com sucesso!');
    }
}
