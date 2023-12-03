<!DOCTYPE html>
<html>
	@include('layouts.header')	
	@include('layouts.admin_header')	
    <body id="admin_body"> 
    	@yield('content')			       
    </body>
    @include('layouts.footer')	
    @yield('js')
</html>