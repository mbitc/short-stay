@extends('layouts.admin')


@section('content') 
<div class="container top10" >
	<ul class="nav nav-pills" role="tablist">      
        
        <?php echo link_to_action('AdminController@apartamentsArea', 'Back to list', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
      </ul>
      {{ Form::open(array('id' => 'apartament' ,'role' => "form", 'action' => $action,'method' => $method, 'class'=>'form-create clearfix top10 col-md-10')) }}
      <div class="col-md-6 top10 clearfix" style="">
      
		 
			  <div class="form-group">
			    <label for="exampleInputEmail1">Apartament name</label>
			    <input type="text" name="name" @if (isset($apartament)) value="{{ $apartament->name }}" @endif class="form-control" id="exampleInputEmail1" placeholder="Enter name">
			  </div>			 
			  <div class="form-group">
			    <label for="exampleInputEmail1">House number / name</label>
			    <input type="text" name="house_name" @if (isset($apartament)) value="{{ $apartament->house_name }}" @endif class="form-control" id="exampleInputEmail1" placeholder="House name / number">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Street</label>
			    <input type="text" name="street" @if (isset($apartament)) value="{{ $apartament->street }}" @endif class="form-control" id="exampleInputEmail1" placeholder="Street name">
			  </div>
			  <div class="form-group">
				    <label for="exampleInputEmail1">Post code</label>
				    <input type="text" name="post_code" @if (isset($apartament)) value="{{ $apartament->post_code }}" @endif class="form-control" id="exampleInputEmail1" placeholder="Post code">
				  </div>
			  <div class="form-group">
			  	<button type="submit" class="btn btn-primary margin-z">Submit</button>
			  </div>
			  
			  </div>
			  	
			  	
			  
			   <div class="col-md-6 top10">
			  	  
				  <div class="form-group">
				    <label for="exampleInputEmail1">City</label>
				    <input type="text" name="city" @if (isset($apartament)) value="{{ $apartament->city }}" @endif class="form-control" id="exampleInputEmail1" placeholder="City name">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Country</label>
				    <input type="text" name="country" @if (isset($apartament)) value="{{ $apartament->country }}" @endif class="form-control" id="exampleInputEmail1" placeholder="Country name">
				  </div>
				  
				  @if (isset($apartament))	
				  <div class="form-group clearfix">
				  <label for="exampleInputEmail1">Qr code</label>
				  <div class="col-md-12 row">
				  <button id="generateQr" class="btn btn-default">Generate QR</button>
				  @if (isset($apartament->qr))
				   <?php echo link_to_action('AdminController@downloadQR', 'Download Qr', $parameters = array('id'=>$apartament->id), $attributes = array('class'=>'btn btn-default')); ?>
				  @endif 	
				  <button id="genLink" class="btn btn-default">Generate Link</button>
				  <div id="result"></div>
				  </div>
				  </div>
				  <div class="form-group clearfix">				  
                     <div class="col-md-12 row"><label>Short link</label></div>
                      <div class="col-md-6 row">
                          <input type="text" class="form-control" name="short_link" id="short_link" value="@if (isset($apartament->qr)){{ $apartament->short_link }}@endif" />
                      </div>
                      <div id="qrcodePlace" class="col-md-6 pull-right">
                      @if (isset($apartament->qr))
                       <a href="{{ asset('images/'.$apartament->qr) }}" target="_blank"><img src="{{ asset('images/'.$apartament->qr) }}" /></a>
                      @endif       
                      </div>
                  </div>
                  @endif 
                  <div class="clearfix"></div>
                  <input type="hidden" name="qr" id="qr" value="@if (isset($apartament)){{ $apartament->qr }}@endif" />
				  </div>
				</div>
			  <div class="col-md-12">	  
			  		  			  
			  
			  </div>
		{{ Form::close() }}
		</div>	
</div>

@stop

@section('js') 
<script type="text/javascript">
$(document).ready(function(){
	$('#generateQr').click(function(e){
		e.preventDefault();
		@if (isset($gurl)) 
		$.ajax({
		  url: "{{ $gurl }}"
		}).done(function(data) {
			console.log(data.image);
			$('#qrcodePlace').html('');
			$('#qrcodePlace').append(' <a href="'+data.image+'" target="_blank"><img src="'+data.image+'" /></a>');
			$('#qr').val(data.shPath);
		  $( this ).addClass( "done" );
		});
		@endif
		alert('generate Qr');
	});

	$('#genLink').click(function(e){
		e.preventDefault();
		@if (isset($apartament->id))
		var url = '/admin/getshortlink/'+'{{ $apartament->id }}';
        $.ajax({
            type:"POST",            
            url: url,
            success: function(msg) {
                //$("#results").append("The result =" + StringifyPretty(msg));
                console.log(msg.id);
                if(msg.id){
                    $('#short_link').val(msg.id);
                }
            }
       });
       @endif
	})
});
</script>
@stop