<div class="col-md-3 row top10">
    <div class="list-group">
        <?php $name = Route::current()->getPath(); //var_dump($name);
        $url = action('AdminAccountController@mainArea'); //var_dump($url);
        ?>

        <?php
        /* Get array with controller and function for route, check if active, make function */
        echo link_to_action('AdminAccountController@userForm', 'User info', $parameters = array(), $attributes = array('class'=>'list-group-item'));
        echo link_to_action('AdminAccountController@companyForm', 'My company', $parameters = array(), $attributes = array('class'=>'list-group-item'));?>

        {{-- <a href="#" class="list-group-item active"></a>
          Issue types --}}


    </div>
</div>


