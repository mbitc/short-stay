@extends('layouts.master')


@section('content')	
<div class="panel">
	<div class="panel-heading">
	<h2 class="issueh2">Select problem</h2>
	</div>
	<div class="panel-body">	
		{{ Form::open(array('id' => 'issue' ,'class' => "form-horizontal", 'action' => array('UserController@retrieveInfo',$id),'method' => 'post')) }}
		
			
			<!--<select name="problem" class="form-control">
				<option value="Issue">Issue</option>
				<option value="Damage">Damage</optiom>
			</select>-->
			<div class="form-group row" id="ma">
				<input type="hidden" name="message_type" value="" id="message_type" style="display:none;" />
				@foreach ($mt as $me_t)
					<button class="btn btn-default message_type" id="mt{{ $me_t->id }}">{{ $me_t->name }}</button>
					
				@endforeach
			{{--<select name="message_type" class="form-control form-marg">
				
				<option value="1">Issue</option>
				<option value="2">Damage</optiom>
			</select>--}}				
			</div>
			<div id="an" style="display:none;">
			<div class="form-group" id="load_pl">
				<div id="loader"></div>
				<label class="lb_loader">Processing issue</label>
			</div>
			<div class="alert alert-success hidden" role="alert" id="success">Thanks for submit! We will contact shortly. For faster response you can enter data</div>
			<div class="form-group">
			<textarea class="form-control form-marg" name="text" placeholder="Additional notes"></textarea>
			{{ Form::hidden('message_type_id','1')}}
			{{ Form::hidden('discussion_id','0',array('id' => 'discussion_id'))}}
			</div>
			<div class="form-group">
				<label>Telephone number</label>
				<input type="tel" name="telephone" value="" class="form-control form-marg" placeholder="Telephone number" />
				<label>Email</label>
				<input type="email" name="email" value="" class="form-control form-marg"  placeholder="Email adress" />
			</div>
			</div>
			<div id="nex">
			<button class="btn btn-primary pull-right" name="submit" id="next">Submit</button>
			</div>
			<div class="form-group hidden" id="subm" >
				<input type="submit" class="btn btn-primary pull-right" name="submit" value="Submit" />
			</div>
				
		{{ Form::close() }}
	</div>	
	{{-- <div role="tabpanel" class="tab-pane" id="messages">
		<br />
		<ul class="media-list" style="padding-left:0;">
			@foreach ($discussions as $discussion)
		  <li class="media">
		    <a class="" href="#"></a>
		    <div class="media-body">
		      <a class="" href="#"><p class="media-heading">Date started</p>
		       {{ $discussion->created_at }}</a>
		      
			  <div class="media">
			    <a class="media-left" href="#"></a>
			    <div class="media-body">
			      <h4 class="media-heading">Last message :</h4>
			      <span>Text :</span>
			      <span>{{ $discussion->lastMessage()->first()->text }}...</span>
			      <div>
			      <span>Date :</span>
			      <span>{{ $discussion->lastMessage()->first()->created_at }}</span>
			      </div>
			    </div>
			 </div>
		
		    </div>
		    
		  </li>
		  <hr />
		  @endforeach
		</ul>
	</div>--}}
</div>
@stop
<script type="text/javascript">
</script>

@section('js')	
<script type="text/javascript">
	$("#issue_body").delegate(".message_type", "click", function(e)
    {
        e.preventDefault();   
        $(this).toggleClass('selected'); 
        arrTypes = new Array();
        $('.message_type').each(function(k,v){
        	if($(this).hasClass('selected')){
        		var val = $(this).attr('id').split('mt');
        		arrTypes.push(val[1]);
        	}
        })
        $('#message_type').val(arrTypes);
        
    });
    $('#next').click(function(e){
    	e.preventDefault();
    	$('#an').toggleClass('show');
    	$('#nex').addClass('hidden');
    	$('#subm').removeClass('hidden');
    	$('#ma').toggleClass('hide');
    	console.log('next press');
    	var params = $('#issue').serialize();
    	$.ajax({
    		type:'GET',
    		url: '{{ action('UserController@processIssue',$id) }}',
    		data:$('#issue').serialize()
    	}).success(function(data)
    	{
    		$('#discussion_id').val(data.discussionId);
    		$('#load_pl').hide();
    		$('#success').removeClass('hidden');
    	});
    });
</script>
@stop