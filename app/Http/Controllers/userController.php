<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Demo;

class userController extends Controller
{
    public function admin(){
        $data=User::all();   
        return view('index',compact('data'));
    }

    public function addusers(Request $res){

        User::create($res->all());

        // $user->update([
            //     'name' => $request->name,
            //     'dept' => $request->dept
            // ]);

        return response()->json([
            'status' => 200,
            "message" => "added sucessfully"
        ]);
    }

    public function deleteusers($userid){

        $user = User::findOrFail($userid);
        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully!'
        ]);
    }

    public function editusers($userid){
        $user = User::findOrFail($userid);
        
        return response()->json([
            'status'=>200,
            'data' =>[
                'id' => $user->id,
                'name' => $user->name,
                'dept' => $user->dept,	
            ]
        ]);
    }

    public function updateusers(Request $req, $userid){
        $user = User::findOrFail($userid);


            // $user->update([
            //     'name' => $request->name,
            //     'dept' => $request->dept
            // ]);
            $user->update($req->all());

            return response()->json([
                'status' => 200,
                'message' => 'User Updated successfully!'
            ]);
    }
}