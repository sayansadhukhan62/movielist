@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="width:500px;">
<div class="card-header">
	{{ isset($movie) ? 'Edit Movie' : 'Create Movie'}}	
</div>
<div class="card-body">

	@if($errors->any())

			<div class="alert alert-danger">
			<ul class="list-group">
				@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">
					{{$error}}
				</li>
				@endforeach
			</ul>
			
		</div>

		@endif
@if(!isset($movie))
	<label for="title">Search By IMDB ID.</label>
	<div class="input-group mb-3">
		<input type="text" class="form-control" id="searchid" name="search" required>&nbsp;
  	<div class="input-group-prepend">
    	<button class="btn btn-success" id="search" style="border-radius: 4px;">Search</button>
  	</div>
	</div>
@endif
<form action="{{ isset($movie)?route('movie.update',$movie->id) : route('movie.store') }}" method="POST" enctype="multipart/form-data">
@csrf
@if(isset($movie))

	@method('PUT')

@endif

<div class="form-group">
<label for="title">Title</label>	
<input type="text" class="form-control" id="title" name="name" value="{{isset($movie) ? $movie->name : ''}}">	
</div>
<div class="form-group">
<label for="description">Plot</label>	
<textarea type="text" cols="3" rows="3" class="form-control" id="description" name="description" id="description">{{isset($movie) ? $movie->description : ''}}</textarea>	
</div>

@if(isset($movie))
<div class="form-group">
@if($movie->method=="imdb")
<img src="{{$movie->image}}" style="width: 200px; height: 200px;">
@else
<img src="{{asset('storage/'.$movie->image)}}" style="width: 200px; height: 200px;">
@endif
</div>
@endif
<input type="hidden" name="method" id="method" value="local">

<div class="form-group">
@if(isset($movie))
<label for="image">Update Image</label>
@else
<label for="image">Image</label>
@endif
<input type="file" class="form-control" id="image" name="image" style="height:max-content" required>
<input type="hidden" class="form-control" id="imagelink" name="imagelink" style="height:max-content">	
</div>

<div class="form-group">
	<button type="submit" class="btn btn-success">{{isset(($movie)) ? 'Update Movie' : 'Create Movie' }}</button>	
</div>
</form>
</div>
</div>
@endsection
@section('js')
<script>

	$(document).ready(function() {
    	$("#search").click(function(){
        var searchid = $('#searchid').val();
        var settings = {
			"async": true,
			"crossDomain": true,
			"url": "https://movie-database-imdb-alternative.p.rapidapi.com/?i=tt"+searchid+"&r=json",
			"method": "GET",
			"headers": {
			"x-rapidapi-host": "movie-database-imdb-alternative.p.rapidapi.com",
			"x-rapidapi-key": "775e0b174emsh7f8424dde9515c1p1f8244jsn0e109093189d"
			}
		}
		$.ajax(settings).done(function (response) {
		// console.log(response.Title);
		$('#title').val(response.Title);
		$('#description').val(response.Plot);
		$('#method').val('imdb');
		$('#image').prop('type', 'image');
		$('#image').prop('src', response.Poster);
		$('#imagelink').val(response.Poster);
		$('#image').css({"width":"200px","height":"200px"});
		// $('#image').removeAttr('required');​​​​​
		});
		
    	}); 
	});

		

</script>
@endsection
