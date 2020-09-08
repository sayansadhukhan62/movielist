@extends('layouts.app')

@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
    {!! session('message.content') !!}
    </div>
@endif
<div class="card mx-auto" style="width:1000px;">
    <div class="card-body">
        <div id="app">
            <movie-list :user="{{ Auth::user() }}" ></movie-list>
        </div>
    </div>
</div>
@endsection
