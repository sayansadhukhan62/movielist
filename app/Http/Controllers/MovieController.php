<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::all();
        // return view('movie.index')->with([
        //     'movies'=>$movie,
        // ]);
        return view('movie.index-vue')->with([
            'movies'=>$movie,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|unique:movies',
        'description' => 'required',
        ]);

        if($request->method=='imdb'){
            $image=$request->imagelink;
        }else{
            $image= $request->image->store('movies','public');   
        }
        
        $post=Movie::Create([
        'name' => $request->name,
        'description' => $request->description,
        'image'=> $image,
        'method'=>$request->method,
       ]);

        session()->flash('message.level', 'success');
        session()->flash('message.content', 'Movie Added Succesfully!');
        return redirect(route ('movie.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie=Movie::findOrFail($id);
        return view('movie.create')->with([
            'movie'=>$movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        ]);

        $movie=Movie::findOrFail($id);

        if($request->has('image')){
            $image=$request->image->store('movies','public');
            storage::delete($movie->image);
        }
        $movie=Movie::findOrFail($id);
        $movie->name=$request->name;
        $movie->description=$request->description;
        if($request->has('image')){
        $movie->image=$image;
        $movie->method="local";
        }

        $movie->update();

        session()->flash('message.level', 'success');
        session()->flash('message.content', 'Movie updated Succesfully!');
        return redirect(route ('movie.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie -> delete();
    
        session()->flash('message.level', 'success');
        session()->flash('message.content', 'Movie Deleted Succesfully!');
        return redirect(route ('movie.index'));
    }

}
