@extends('admin.settings.main') 
    
@section('content') 
   <div class="container top10" >
    @include('admin.settings.leftmeniu')
        <div class="col-md-7 top10">            
        <ul class="nav nav-pills" role="tablist">
            <?php echo link_to_action('SettingsController@allDiscussionStatuses', 'Back to list', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
        </ul>
        {{ Form::open(array('id' => 'apartament' ,'role' => "form", 'action' => $action,'method' => $method, 'class'=>'form-create clearfix top10 col-md-10')) }}
        <h1>Discussion status</h1>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" @if (isset($ds)) value="{{ $ds->name }}" @endif placeholder="Status name" />            
        </div>
        <div class="form-group">
            <label>Level</label>
            <input type="text" class="form-control" name="level" @if (isset($ds)) value="{{ $ds->level }}" @endif placeholder="Status level" />
        </div>
        <div class="form-group">
            <label>Color</label>
            <input type="text" class="form-control" name="color" @if (isset($ds)) value="{{ $ds->color }}" @endif placeholder="Status color " />
        </div>
        <div class="form-group">
            <button class="btn btn-primary margin-z" name="submit">Submit</button>
        </div>
        </form>
        </div>
    </div><!-- /.container -->   
@stop
