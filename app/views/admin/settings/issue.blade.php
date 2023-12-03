@extends('admin.settings.main')	
	
@section('content') 
   <div class="container top10" >
	@include('admin.settings.leftmeniu')
		<div class="col-md-7 top10">		   	
		<ul class="nav nav-pills" role="tablist">
        	<?php echo link_to_action('SettingsController@allIssues', 'Back to list', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
		</ul>
		{{ Form::open(array('id' => 'apartament' ,'role' => "form", 'action' => $action,'method' => $method, 'class'=>'form-create clearfix top10 col-md-10')) }}
		<div class="form-group">
			<label>Issue type name</label>
			<input type="text" class="form-control" name="name" @if (isset($mt)) value="{{ $mt->name }}" @endif placeholder="Issue type name" />
		</div>
		<div class="form-group">
			<button class="btn btn-primary margin-z" name="submit">Submit</button>
		</div>
		</form>
		</div>
	</div><!-- /.container -->   
@stop
