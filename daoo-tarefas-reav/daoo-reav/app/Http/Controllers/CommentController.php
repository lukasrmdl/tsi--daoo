<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function index()
    {
        $commentList = $this->comment->all();
        return view('comments.index',[
            "comments"=>$commentList
        ]);
    }


    public function show($id)
    {
        return view('comments.show',[
            "comment"=>$this->comment->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $newComment = $request->all();
        $newComment['edited'] = $request->has('edited');
        if (!Comment::create($newComment)) {
            dd("Error ao criar Comentário!!");
        }
        return redirect('/comments');
    }

    public function create()
    {
        return view('comments.create');
    }

    public function edit($id)
    {
        return view('comments.edit',[
            'comment'=>Comment::find($id)
        ]);
    }

    public function update(Request $request,$id)
    {
        $newComment = $request->all();
        $newComment['edited'] = $request->has('edited');
        if (!Comment::find($id)->update($newComment)) {
            dd("Error ao criar Comentário!!");
        }
        return redirect('/comments');
    }

    public function delete($id)
    {
        return view('comments.delete',[
            'comment'=>Comment::find($id)
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->has('confirmar'))
            if (!Comment::destroy($id))
                dd("Error ao deletar comentário!!");

        return redirect('/comments');
    }

}