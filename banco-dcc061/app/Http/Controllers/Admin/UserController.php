<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'cpf' => $request->cpf,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            Account::create([
                'user_id' => $user->id,
                'account_number' => 'ACC' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'balance' => 0,
            ]);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'role' => $request->role,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Você não pode remover seu próprio usuário!');
        }

        $user->delete();
        return back()->with('success', 'Usuário removido com sucesso!');
    }
}
