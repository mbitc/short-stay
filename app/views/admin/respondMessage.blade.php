@extends('layouts.admin')
@include('layouts.admin_header')

@section('content') 
   
<div class="container top10" >
	<ul class="nav nav-pills" role="tablist">      
        
        <?php echo link_to_action('AdminController@allIssues', 'Back to list', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
      </ul>
      <div class="clearfix top10">
      				<hr />	
      				<dl class="dl-horizontal top10">
      				<h4>Apartament</h4>
      				<dt>Name</dt>
					   <dd>{{ $discussion->apartament["name"] }}</dd>
					</dl>
					<dl class="dl-horizontal top10">
					<dt>Telephone</dt>
					   <dd>{{ ($discussion["telephone"]!="")?$discussion["telephone"]:'n/a'; }}</dd>
					</dl>
					<dl class="dl-horizontal top10">
					<dt>Email</dt>
					   <dd>{{ ($discussion["email"]!="")?$discussion["email"]:'n/a'; }}</dd>
					</dl>					
					<hr />
      		@foreach ($discussion->messages as $key=>$message)      			
      			@if ($message->text != "" || $message->message_type_id !=0)
      			<div class="col-md-5 clearfix top10 @if($key!=0) left10 @endif" style="border:1px solid #eee;">
      				<h4>Message</h4>
      				<dl class="dl-horizontal top10">					  
					  <dt>Type</dt>
					  <dd>{{ $message->messageType["name"] }}</dd>					  
					   <dt>Text</dt>
					  <dd> 
					  	@if($key==0)
					  		{{ ($discussion["text"]!="")?$discussion["text"]:'n/a'; }}
					  	@else 
					  	{{ ($message->text!="")?$message->text:'-'; }}
					  	@endif
					  </dd>
					  
					  <dt>Posted</dt>
					   <dd>{{ $message["created_at"] }}</dd>
					</dl>
				</div>
				<div style="clear:both;"></div>
      				
      			@endif
      		@endforeach
      </div>
      <div class="col-md-5 top10 clearfix bott10" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:10px;">
      <h4>Write response</h4>
      {{ Form::open(array('id' => 'issue' ,'role' => "form", 'action' => $action,'method' => $method)) }}
		 
			  <div class="form-group">
			    <label for="exampleInputEmail1">Response</label>
			    <textarea name="text" class="form-control" id="exampleInputEmail1" placeholder="Response"></textarea>
			  </div>	  			  
			  <button type="submit" class="btn btn-primary">Submit</button>
		{{ Form::close() }}
		</div>	
		<div class="clr"></div>
</div>

@stop