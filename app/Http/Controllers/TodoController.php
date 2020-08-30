<?php

namespace App\Http\Controllers;

use App\Model\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $todos = Todo::withTrashed()->get();
    return view('todo.create', compact('todos'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //dd($request->all());
    $data = $request->input();
    $res = array(
      'success' => false,
      'message' => 'Please fix the error below.',
      'rs_class' => 'danger',
      'data' => []
    );
    $rules = [
      'title' => 'required|min:2|max:100|unique:todos,title',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      $res['success'] = false;
      $res['rs_class'] = 'danger';
      $res['message'] = 'Something went wrong. Please check the error(s):';
      $res['data'] = $validator->errors()->all();
      return back()->with('response', $res)->withInput($data);
    } else {
      $todo = new Todo();
      $todo->title       = $data['title'];
      $createNewTodo = $todo->save();
      if ($createNewTodo) {
        $res['success'] = true;
        $res['rs_class'] = 'success';
        $res['message'] = 'Todo added to the todo list successfuly';
      }

      return redirect('/todos')->with('response', $res);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Model\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function show(Todo $todo)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Model\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function edit(Todo $todo)
  {
    return view('todo.edit')->with('todo', $todo);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Model\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Todo $todo)
  {

    $data = $request->input();
    $res = array(
      'success' => false,
      'message' => 'Please fix the error below.',
      'rs_class' => 'danger',
      'data' => []
    );
    $rules = [
      'title' => 'required|min:2|max:100|unique:todos,title,' . $todo->id
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      $res['success'] = false;
      $res['rs_class'] = 'danger';
      $res['message'] = 'Something went wrong. Please check the error(s):';
      $res['data'] = $validator->errors()->all();
      return back()->with('response', $res)->withInput($data);
    } else {
      $todo->title       = $data['title'];
      $UpdateTodo = $todo->update();
      if ($UpdateTodo) {
        $res['success'] = true;
        $res['rs_class'] = 'success';
        $res['message'] = 'Todo Updated  successfuly';
      }

      return redirect('/todos')->with('response', $res);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Model\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function destroy(Todo $todo)
  {
    $res = array(
      'success' => false,
      'message' => 'Please fix the error below.',
      'rs_class' => 'danger',
      'data' => []
    );
    $success = $todo->delete();
    if ($success) {

      $res['success'] = true;
      $res['rs_class'] = 'success';
      $res['message'] = 'Todo Deleted  successfuly';

      return redirect('/todos')->with('response', $res);
    } else {
      $res['success'] = false;
      $res['rs_class'] = 'danger';
      $res['message'] = 'Something went wrong. Please check the error(s):';
    }
  }
}
