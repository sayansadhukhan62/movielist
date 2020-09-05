<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
	<div class="c-sidebar-brand d-md-down-none">
        <span class="brandname"><img class="brandicon" src="{{asset('/storage/favicon.ico')}}">Movie+</span>
	</div>
	<ul class="c-sidebar-nav">
		<li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link c-active" href="/movie">
		 		Dashboard
		 	</a>
		 </li>
		@if(Auth::check())
		@if(auth()->user()->role_id==1)
		 <li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="{{ route('movie.create') }}">
		 		Add Movie
		 	</a>
		 </li>
        @endif
        @endif
		 <li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="{{ route('logout') }}"
             	onclick="event.preventDefault();
               	document.getElementById('logout-form').submit();">
		 		Logout
		 	</a>
		 </li>
	</ul>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>