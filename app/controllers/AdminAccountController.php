<?php
class AdminAccountController extends BaseController {

    protected $layout = 'layouts.admin';

	public function mainArea(){
        return View::make('admin.account.main');
    }
    public function companyForm()
    {
        return View::make('admin.account.companyform',array('method'=>'post','action'=>'AdminAccountController@saveCompany'));
    }

    public function saveCompany()
    {

    }

    public function userForm()
    {
        return View::make('admin.account.userform',array('method'=>'post','action'=>'AdminAccountController@modifyUser'));
    }

    public function modifyUser()
    {

    }
}