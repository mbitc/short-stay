<html>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	@include('layouts.header')	
    <body id="issue_body"> 
        <div class="container_issue">
	        <div class="row top10">
		        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
		        	<div class="highlight formhl">
			        	
							{{--<ul class="nav nav-tabs" role="tablist" id="myTab">
							  <li class="active" role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>	 
							  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
							</ul>--}}
				            @yield('content')
				        
			        </div>
		        </div>
		    </div>
        </div>
    </body>
    @include('layouts.footer')	
    @yield('js')
    
</html>