@extends('layouts.app')
@section('content')
<div class="w-100 h-100 d-flex justify-content-center align-items-center">

  <div class="text-center" style="width: 40%;">
    @include('response.response')
    <h1 class="display-3 text-white mb-3">Edit Todo App</h1>
    {{ Form::open(['route' => ['todos.update', $todo->id],'method' => 'post',
      'name'=>'form-todo-update','id'=>'form-todo-update']) }}
    @method('PATCH')
    <div class="input-group mb-3 w-100">
      {{Form::text('title',$todo->title,
        ['class'=>'form-control form-control-lg','id'=>'title',
        'required'=>'required','min'=>2,'max'=>100,
        'aria-label'=>'Receipent username',
        'aria-describedby'=>'button-addon2'])}}
      <div class="input-group-append">
        {{Form::submit('Save',['class'=>'btn btn-success','id'=>'button-addon2'])}}
      </div>
    </div>
    {{ Form::close() }}


  </div>
</div>
@endsection