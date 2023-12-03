@extends('layouts.admin')


@section('content') 
   
<div class="container top10" >
     
      <div class="starter-template">
        <h1>All apartaments</h1>
        
      </div>
       <ul class="nav nav-pills" role="tablist">
        <?php echo link_to_action('AdminController@formApartament', 'New apartament', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
      </ul>
      <div class="table-responsive top10">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>id</td>
            <td>Apartament</td>
            <td>Address</td>
            <td>City</td>
            <td>Country</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          @if (isset($apartaments) && count($apartaments)>0)              
            @foreach ($apartaments as $apartament)
                <tr>
                  <td>{{  $apartament->id }}</td>
                  <td>{{  $apartament->name }}</td>
                  <td>{{  $apartament->street }} {{  $apartament->house_name }}</td>
                  <td>{{  $apartament->city  }} </td>
                  <td>{{  $apartament->country  }} </td>
                  <td>
                    <div class="btn-group navbar-btn">
                      <a href="{{ action('AdminController@editApartment',$apartament->id); }}"type="button" class="btn btn-default">Edit</a>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>{{ Form::open(array('action' => array('AdminController@deleteApartament', $apartament->id), 'method' => 'delete', 'style'=>'margin-bottom:0;')) }}
                                
                                <button type="submit" class="lia">Delete</button>
                            {{ Form::close() }}</li>                  
                      </ul>
                    </div>
                  </td>
                </tr>
                
            @endforeach
          @else
          <tr>
              <td colspan="4"><div class="alert alert-info" role="alert">There is no apartaments</div></td>
          </tr>
          @endif          
        </tbody>
        <tfoot></tfoot>
      </table>
    </div>
    <!-- end of main table -->
      

    </div><!-- /.container -->

@stop