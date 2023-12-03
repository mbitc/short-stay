@extends('layouts.admin')


@section('content') 
   
<div class="container top10" >
     
      <div class="starter-template">
        <h1>All messages from apartaments</h1>        
      </div>   
      <form> 
      <div class="btn-group navbar-btn">
                  <a id="change_status" href="#"type="button" class="btn btn-default">Change status</a>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a class="dst" href="5">Pending</a></li>
                    <li><a class="dst" href="10">Worker sent</a></li>
                    <li><a class="dst" href="15">Done</a></li>                       
                  </ul>
      </div>
      <div class="table-responsive top10">
      <table id="issues-table" class="table table-bordered">
        <thead>
          <tr>
            <td></td>
            <td>Id</td>
            <td>Date</td>
            <td>Text</td>
            <td>Mesage type</td>
            <td>Apartament name</td>
            <td>Apartament address</td>
            <td>Status</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>

          @if (isset($messages) && count($messages)>0)              
            @foreach ($messages as $message)
            <tr style="background-color:  {{ $message->discussion->discussionStatus['color'] }};">
              <td>{{ Form::checkbox('ids[]', $message->discussion->id, false, array('class' => 'ids')) }}</td>
              <td>{{ $message->id }}</td>
              <td>{{ $message["created_at"]}}</td>
              <td>{{ $message->discussion['text'] }}</td>
              <td>{{ $message->messageType["name"] }}</td>
              <td>{{ $message->discussion->apartament["name"]}}</td>
              <td>{{ $message->discussion->apartament['street'] }} {{ $message->discussion->apartament['house_name'] }}, {{ $message->discussion->apartament['city'] }}</td>
              <td>{{ $message->discussion->discussionStatus['name'] }}</td>
              <td>
                <div class="btn-group navbar-btn">
                  <a href="{{ action('AdminController@respondMessage',$message->discussion['id']); }}"type="button" class="btn btn-default">Respond</a>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">                    
                    <li><a href="{{ action('AdminController@changeDiscussionStatus',array('id'=>$message->discussion['id'],'status'=>5,)) }}">Pending</a></li>
                    <li><a href="{{ action('AdminController@changeDiscussionStatus',array('id'=>$message->discussion['id'],'status'=>10,)) }}">Worker sent</a></li>
                    <li><a href="{{ action('AdminController@changeDiscussionStatus',array('id'=>$message->discussion['id'],'status'=>15,)) }}">Done</a></li>                         
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
            @else
          <tr>
              <td colspan="7"><div class="alert alert-info" role="alert">There is no issues</div></td>
          </tr>
          @endif            
        </tbody>
        <tfoot></tfoot>
      </table>
      </form>
    </div>
    <!-- end of main table -->
      

    </div><!-- /.container -->


@stop
@section('js') 
<script>
    $(document).ready(function(){
      $('.dst').click(function(e){
           e.preventDefault();
           var status = $(this).attr('href');
           var arrayIds = [];
           $.each($('table .ids'), function(k,v) { 
           	if($(v).prop('checked')){
           		arrayIds.push($(v).val());
           	}
           ;});
           $.ajax({
           		url: "/admin/issues/update",
				context: document.body,
			  	data : {'ids':arrayIds,'status':status}
			}).done(function(data) {
			  $.each($('table .ids'), function(k,v) { 
	           	if($(v).prop('checked')){
	           		$(v).parent().parent().css('background-color',data.color);
	           		var el = $(v).parent().parent();
	           		$(el).find(':nth-child(8)').html(data.name);
	           	}
	           ;});
			});
       });
       $('#issues-table').DataTable({
		  columnDefs: [
            { width: "5%", targets: 0}
        	]
		} );
    });    
   
</script>
@stop