@extends('layouts.admin')


@section('content') 
   
<div class="container top10" >
     
      <div class="starter-template">
        <h1>All messages from apartaments</h1>        
      </div>   
      <form> 
      <div class="btn-group navbar-btn">
                  <a href="#"type="button" class="btn btn-default">Change status</a>
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
      <table class="table table-bordered">
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
            <tr style="background-color:  {{ $message->discussion['discussion_status']['color'] }};">
              <td>{{ Form::checkbox('ids[]', $message->discussion, false, array('class' => 'ids')) }}</td>
              <td>{{ $message->id }}</td>
              <td>{{ $message["created_at"]}}</td>
              <td>{{ $message->text }}</td>
              <td>{{ $message->messageType["name"] }}</td>
              <td>{{ $message->discussion['apartament']['name']}}</td>
              <td>{{ $message->discussion['apartament']['street'] }} - {{ $message->discussion['apartament']['house_name'] }}</td>
              <td>{{ $message->discussion['discussion_status']['name'] }}</td>
              <td>
                <div class="btn-group navbar-btn">
                  <a href="{{ action('AdminController@respondMessage',$message->discussion['id']); }}"type="button" class="btn btn-default">Respond</a>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">View all conv.</a></li>
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
           console.log('clicked');
           var ids = new Array();
           $.each($('.ids:checked'), function(k,v){
                //console.log($(v).val());
                ids.push($(v).val()); 
           });
           console.log(ids);
       }) 
    });
</script>
@stop