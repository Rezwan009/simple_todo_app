@if (session('status'))
<div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
@endif
@if(Session::has('response'))
@php
$res =Session::get('response');
@endphp
<div class="alert alert-{{$res['rs_class']}} alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  {{$res['message']}}
  @if ($res['success'] == false)
  <ul class="uo-list">
    @foreach ($res['data'] as $data)
    <li>{{$data}}</li>
    @endforeach
  </ul>
  @endif

</div>
@endif