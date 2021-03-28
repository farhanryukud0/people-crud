<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $peoples = \App\People::paginate(2);

        return $peoples->toJson();
    }

    public function buat(Request $request)
    {
        $validatedData = $request->validate([
          'name' => 'required|max:50',
            'email' => 'required|unique:peoples,email|email|max:50',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:50'
        ]);

        $input = \App\People::create([
          'name' => $validatedData['name'],
          'email' => $validatedData['email'],
          'phone' => $validatedData['phone'],
        ]);

        $msg = [
            'success' => true,
            'message' => 'People Added Successfully'
        ];

        return response()->json($msg);
    }

    public function getPeople($id) // for edit and show
    {
        $peoples = \App\People::find($id);

        return $peoples->toJson();
    }

    public function ubah(Request $request, $id)
    {
        $people = \App\People::find($id);
        $email_unique = "";
        if($people->email !== $request['email']){
            $email_unique = "|unique:peoples,email";
        }
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50'.$email_unique,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:50'
        ]);

        $people->name = $validatedData['name'];
        $people->email = $validatedData['email'];
        $people->phone = $validatedData['phone'];
        $people->save();

        $msg = [
            'success' => true,
            'message' => 'Data updated successfully'
        ];

        return response()->json($msg);
    }

    public function hapus($id)
    {
        $people = \App\People::find($id);
        if(!empty($people)){
            $people->delete();
            $msg = [
                'success' => true,
                'message' => 'Data deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Data deleted failed!'
            ];
            return response()->json($msg);
        }
    }
}
