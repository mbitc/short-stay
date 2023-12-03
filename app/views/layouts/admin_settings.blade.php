<html>
	@include('layouts.header')	
	
    <body> 
    	@yield('left_menu')	
    	@yield('content')			       
    </body>
    @include('layouts.footer')	
    @yield('js')
</html>