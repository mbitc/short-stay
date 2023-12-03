@extends('admin.account.main')

@section('content')
    <div class="container top10" >
        @include('admin.account.leftmeniu')
        <div class="col-md-7 top10">
            <ul class="nav nav-pills" role="tablist">
                <?php echo link_to_action('AdminAccountController@mainArea', 'Back to main', $parameters = array(), $attributes = array('class'=>'btn btn-default')); ?> </li>
            </ul>
            {{ Form::open(array('id' => 'apartament' ,'role' => "form", 'action' => $action,'method' => $method, 'class'=>'form-create clearfix top10 col-md-10')) }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" @if (isset($user)) value="{{ $user->name }}" @endif placeholder="" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="name" @if (isset($user)) value="{{ $user->email }}" @endif placeholder="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary margin-z" name="submit">Submit</button>
            </div>
            </form>
        </div>
    </div><!-- /.container -->
@stop