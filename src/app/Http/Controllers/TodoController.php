<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    //
    public function index() //データベースの値を表示するだけならリクエストはいらない
    {
        $todos =Todo::all(); //変数にTodoモデルのデータをすべて代入する
        return view('index',compact('todos')); //viewにtodosを表示する
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']); //$todoにリクエストから'content'だけを取り出して代入する
        Todo::create($todo); //Todoモデルに$todoをインサートする
        return redirect('/')->with('message','Todoだよ'); //'/'にリダイレクトする
    }

    public function update(TodoRequest $request)
    {
        $todo =$request->only(['content']);
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('message','更新した');
    }
    
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message','削除した');
    }
}
