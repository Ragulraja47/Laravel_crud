<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('index', compact('user'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'dept' => 'required'
            ]);

            // User::create([
            //     'name' => $request->name,
            //     'dept' => $request->dept
            // ]);

            User::create($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'User added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ]);
        }
    }


    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'dept' => $user->dept
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found!'
            ]);
        }
    }



    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);


            // $user->update([
            //     'name' => $request->name,
            //     'dept' => $request->dept
            // ]);
            $user->update($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'User Updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ]);
        }
    }




}
