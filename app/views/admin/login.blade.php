@extends('layouts.admin_login')

    
@section('content')	
	@if ($errors->has())
        @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
        @endforeach
    @endif
	{{ Form::open(array('id' => 'adlogin' ,'class' => "form-signin", 'action' => 'AdminController@retrieveLogin','method' => 'post')) }}		
        <h2 class="form-signin-heading">Please sign in</h2>
        {{ Form::text('username', null, array('placeholder' => 'Username', 'required' => '', 'autofocus' => '', 'class' => 'form-control'))}}
        {{ Form::password('password', array('placeholder' => 'Password', 'required' => '', 'class' => 'form-control top10'))}}
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>     
	{{ Form::close() }}
	
	
@stop