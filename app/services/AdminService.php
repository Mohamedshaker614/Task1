<?php

namespace App\services;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminService
{
    public function getAllUsers()
    {
        return Admin::paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        return Admin::create($validated);
    }

    public function getById($id)
    {
        return Admin::findorFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->getById($id);
        $validated = $request->validate([
            'name' => 'required|max:225',
            'email' => 'email|required|unique:users,email,' . $id,
            'password' => 'min:8|confirmed|nullable|sometimes',
        ]);
        if (($validated['password']) === null) {
            unset($validated['password']);
        }
        $user = Admin::findorFail($id);
        return $user->update($validated);
    }
}
