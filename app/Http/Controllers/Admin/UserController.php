<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders', 'reviews');
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_admin' => 'boolean',
        ]);

        $validated['is_admin'] = $request->has('is_admin');
        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
