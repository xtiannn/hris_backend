<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::isActive()->get();

        if($users->count() > 0){
            return $users;
        }else{
            return response()->json(['message' => 'No users found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'company_id_number' => 'required|string|max:255',
                'role_name' => 'required|string',
                'profile_image' => 'nullable|string',
                'phone_number' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);

            User::create($request->all());

            return response()->json(['message' => 'User created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating user', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {

            return response()->json(['user', $user]);

        } catch (Exception $e) {
            return response()->json(['message' => 'Error fetching user', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error editing user', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating user', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->isActive = 0;
        $user->save();
        return response()->json(['message', 'User has been successfully deleted!']);
    }
}
