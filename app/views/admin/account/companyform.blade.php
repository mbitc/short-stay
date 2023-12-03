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
                <label>Company name</label>
                <input type="text" class="form-control" name="name" @if (isset($company)) value="{{ $company->name }}" @endif placeholder="Company name" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary margin-z" name="submit">Submit</button>
            </div>
            </form>
        </div>
    </div><!-- /.container -->
@stop