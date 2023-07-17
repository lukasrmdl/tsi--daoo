<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $userList = $this->user->all();
        return view('users.index',[
            "users"=>$userList
        ]);
    }


    public function show($id)
    {
        return view('users.show',[
            "user"=>$this->user->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $newUser = $request->all();
        if (!User::create($newUser)) {
            dd("Error ao criar Usuário!!");
        }
        return redirect('/users');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        return view('users.edit',[
            'user'=>User::find($id)
        ]);
    }

    public function update(Request $request,$id)
    {
        $newUser = $request->all();
        if (!User::find($id)->update($newUser)) {
            dd("Error ao atualizar Usuário!!");
        }
        return redirect('/users');
    }

    public function delete($id)
    {
        return view('users.delete',[
            'user'=>User::find($id)
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->has('confirmar'))
            if (!User::destroy($id))
                dd("Error ao deletar usuário!!");

        return redirect('/users');
    }

}