@extends('layouts.app')

@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
    {!! session('message.content') !!}
    </div>
@endif
<div class="card mx-auto" style="width:1000px;">
    <div class="card-header">
        <span style="font-size:24px;color:white">Movie List</span>
        @if(auth()->user()->role_id==1)
        <a class="btn btn-success float-right" href="{{ route('movie.create') }}">
            Add Movie
        </a>
        @endif
    </div>
    <div class="card-body">
        @if($movies->count()==0)
        <table>
            <tbody>
                <tr>
                    <td style="color: red; text-align: center;">
                        No Movie has been Created!
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>  
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Plot
                    </th>
                     @if(auth()->user()->role_id==1)
                    <th>
                    </th>
                    <th>
                    </th>
                    @endif
                </tr>
            </thead>
            <?php $count=1 ?>
            @foreach($movies as $movie)
            <tr>
                <td>
                    @if($movie->method=="imdb")
                    <img height="80px" src="{{$movie->image}}" width="70px"></img>
                    @else
                    <img height="80px" src="{{asset('storage/'.$movie->image)}}" width="70px"></img>
                    @endif
                </td>
                <td>
                    <b>{{$count}}. {{$movie->name}}</b>
                </td>
                <td>
                    {{$movie->description}}
                </td>
                @if(auth()->user()->role_id==1)
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('movie.edit',$movie->id )}}" style="margin-bottom: 10px;">
                        Edit
                    </a>
                    
                    <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                    document.getElementById('delete_post{{$movie->id}}').submit();" style="color: #FFF">
                        Remove
                    </a>
                    <form action="{{route('movie.destroy',$movie->id)}}" id="delete_post{{$movie->id}}" method="POST">
                        @csrf
                    {{ method_field('delete')}}
                    </form>
                </td>
                @endif
            </tr>
            <?php $count++ ?>
            @endforeach
        </table>
        @endif
    </div>
</div>
@endsection
