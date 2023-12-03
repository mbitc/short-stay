@extends('layouts.admin')

    
@section('content') 
@include('layouts.admin_header')
   <div class="container top10" >
    @include('admin.settings.leftmeniu')
        <div class="col-md-7 top10">
            
            <?php echo link_to_action('SettingsController@formDiscussionStatus', 'New discussion status', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
            <div class="table-responsive top10">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Level</td>
                        <td>Color</td>
                        <td>Actions</td>
                        
                    </tr>
                </thead>
                <tbody>
                    @if (isset($ds) && count($ds)>0)              
                        @foreach ($ds as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name}}</td>
                            <td>{{ $d->level}}</td>
                            <td><div style="background-color:{{ $d->color}};width:20px;height:20px;margin:0 auto;border:3px solid #ccc;"></div></td>
                            <td>
                                <div class="btn-group">
                                  <a href="{{ action('SettingsController@editDiscussionStatus',$d->id); }}"type="button" class="btn btn-default">Edit</a>
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li>{{ Form::open(array('action' => array('SettingsController@deleteDiscussionStatus', $d->id), 'method' => 'delete', 'style'=>'margin-bottom:0;')) }}
                                            
                                            <button type="submit" class="lia">Delete</button>
                                        {{ Form::close() }}</li>                  
                                  </ul>
                                </div>
                             </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="3"><div class="alert alert-info" role="alert">There is no discusions statuses</div></td>
                    </tr>
                    @endif
                </tbody>
                </table>
            </div>
        </div>
        
        </div>
    </div><!-- /.container -->   
@stop
