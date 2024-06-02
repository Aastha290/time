<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        $admin = Admin::create($validatedData);
        return response()->json($admin, 201);
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json($admin);
        } else {
            return response()->json(['message' => 'Admin not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->update($request->all());
            return response()->json($admin);
        } else {
            return response()->json(['message' => 'Admin not found'], 404);
        }
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json(['message' => 'Admin deleted successfully']);
        } else {
            return response()->json(['message' => 'Admin not found'], 404);
        }
    }
}
