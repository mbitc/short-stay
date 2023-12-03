@extends('layouts.admin')

	
@section('content') 
@include('layouts.admin_header')
   <div class="container top10" >
	@include('admin.settings.leftmeniu')
		<div class="col-md-7 top10">
			
			<?php echo link_to_action('SettingsController@issueForm', 'New issue type', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
			<div class="table-responsive top10">
				<table class="table table-bordered">
		        <thead>
		         	<tr>
		            	<td>Id</td>
		            	<td>Name</td>
		            	<td>Actions</td>
		        	</tr>
		        </thead>
		        <tbody>
		        	@if (isset($mt) && count($mt)>0)              
            			@foreach ($mt as $m)
            			<tr>
            				<td>{{ $m->id }}</td>
            				<td>{{ $m->name}}</td>
            				<td>
			                    <div class="btn-group navbar-btn">
			                      <a href="{{ action('SettingsController@issueEdit',$m->id); }}"type="button" class="btn btn-default">Edit</a>
			                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			                        <span class="caret"></span>
			                        <span class="sr-only">Toggle Dropdown</span>
			                      </button>
			                      <ul class="dropdown-menu" role="menu">
			                        <li>{{ Form::open(array('action' => array('SettingsController@deletemt', $m->id), 'method' => 'delete', 'style'=>'margin-bottom:0;')) }}
			                                
			                                <button type="submit" class="lia">Delete</button>
			                            {{ Form::close() }}</li>                  
			                      </ul>
			                    </div>
                 			 </td>
            			</tr>
            			@endforeach
         			@else
		        	<tr>
		        		<td colspan="2"><div class="alert alert-info" role="alert">There is no issue types</div></td>
		        	</tr>
		        	@endif
		        </tbody>
		       	</table>
	       	</div>
	    </div>
	    
		</div>
	</div><!-- /.container -->   
@stop
