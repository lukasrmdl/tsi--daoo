<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $topic;

    public function __construct()
    {
        $this->topic = new Topic();
    }

    public function index()
    {
        $topicList = $this->topic->all();
        return view('topics.index',[
            "topics"=>$topicList
        ]);
    }


    public function show($id)
    {
        return view('topics.show',[
            "topic"=>$this->topic->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $newTopic = $request->all();
        $newTopic['edited'] = $request->has('edited');
        if (!Topic::create($newTopic)) {
            dd("Error ao criar Topico!!");
        }
        return redirect('/topics');
    }

    public function create()
    {
        return view('topics.create');
    }

    public function edit($id)
    {
        return view('topics.edit',[
            'topic'=>Topic::find($id)
        ]);
    }

    public function update(Request $request,$id)
    {
        $newTopic = $request->all();
        $newTopic['edited'] = $request->has('edited');
        if (!Topic::find($id)->update($newTopic)) {
            dd("Error ao atualizar Topico!!");
        }
        return redirect('/topics');
    }

    public function delete($id)
    {
        return view('topics.delete',[
            'topic'=>Topic::find($id)
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->has('confirmar'))
            if (!Topic::destroy($id))
                dd("Error ao deletar Topico!!");

        return redirect('/topics');
    }

}