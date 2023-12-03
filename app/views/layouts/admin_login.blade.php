<!DOCTYPE html>
<html>
    @include('layouts.header')  
    
    <body id="admin_body"> 
        @yield('content')                  
    </body>
    @include('layouts.footer')  
    @yield('js')
</html>