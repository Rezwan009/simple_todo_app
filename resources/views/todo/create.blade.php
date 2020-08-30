@extends('layouts.app')
@section('content')
<div class="w-100 h-100 d-flex justify-content-center align-items-center">

  <div class="text-center" style="width: 40%;">
    @include('response.response')
    <h1 class="display-3 text-white">Todo App</h1>
    {{ Form::open(['url' => '/todos','method' => 'post','name'=>'form-todo-create','id'=>'form-todo-create']) }}
    <div class="input-group mb-3 w-100">
      {{Form::text('title',old('title'),['class'=>'form-control form-control-lg','id'=>'title','required'=>'required','min'=>2,'max'=>100,'placeholder'=>'Type here...','aria-label'=>'Receipent username','aria-describedby'=>'button-addon2'])}}
      <div class="input-group-append">
        {{Form::submit('Add to list',['class'=>'btn btn-success','id'=>'button-addon2'])}}
      </div>
    </div>
    {{ Form::close() }}
    <h2 class="text-white pt-3">My Todo List:</h2>
    <div class="bg-white w-100">
      @foreach($todos as $todo)
      @if($todo->deleted_at == null)
      <div class="w-100 d-flex justify-content-between align-items-center">
        <div class="py-3 ml-2">{{$todo->title }}</div>
        <div class="mr-4 d-flex align-items-center ml-2">
          <a class="inline-block mr-3 mt-2" href="{{route('todos.edit',$todo->id)}}"><i class="fa fa-edit fa-2x"></i></a>
          {{ Form::open(['route' => ['todos.destroy', $todo->id],'method' => 'post','name'=>'form-todo-delete','id'=>'form-todo-delete']) }}
          @method('DELETE')
          <button type="submit" class=" border-0 bg-transparent "><i class="fa fa-trash fa-2x"></i></button>
          {{ Form::close() }}
        </div>
      </div>
      @else
      <div class="w-100 d-flex justify-content-between align-items-center">
        <div class="py-3 ml-2"><del>{{$todo->title }}</del></div>
        <!-- <div class="mr-4 d-flex align-items-center">
          {{ Form::open(['route' => ['todos.destroy', $todo->id],'method' => 'post','name'=>'form-todo-delete','id'=>'form-todo-delete']) }}
          @method('DELETE')
          <button type="submit" class=" border-0 bg-transparent "><i class="fa fa-trash fa-2x"></i></button>
          {{ Form::close() }}
        </div> -->
      </div>
      @endif

      @endforeach

    </div>
  </div>
</div>
@endsection