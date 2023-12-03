<?php
class UserController extends BaseController {

	protected $layout = 'layouts.master';
    /**
     * Show the profile for the given user.
     */
    public function showForm($id)
    {
    	$m_t = MessageType::all();
    	$discussions = Apartament::find($id)->discussions;
    	$this->layout->content = View::make('user.issue_form',array('id'=>$id,'discussions'=>$discussions,'mt'=>$m_t));
       //return View::make('front')->nest('body', 'user.issue_form');
    }
	public function showSubmit($id){
		$this->layout->content = View::make('user.issue_submitted',array('id'=>$id));
	}
    public function retrieveInfo($id){
    	$input = Input::all();

        /*$discussion = new Discussion();
        $discussion->apartament_id = $id;
        $discussion->save();
        $message = new Message();
        $message->discussion_id = $discussion->id;
        $message->message_type_id = $input['message_type_id'];
        $message->text = $input['text'];
        $message->save();*/
        if($input['discussion_id']!=0 && isset($input['discussion_id']))
        {
	        $discussion = Discussion::find($input['discussion_id']);
			$discussion->text = $input['text'];
			$discussion->email = $input['email'];
			$discussion->telephone = $input['telephone'];
			$discussion->save();
		}	
        return $this->showSubmit($input['discussion_id']);
    }
	public function processIssue($id){
		if (Request::ajax()){
			$input  = Input::all();
			$arrMT = explode(",",$input['message_type']);
			$discussion = new Discussion();
	        $discussion->apartament_id = $id;
	        $discussion->save();
			foreach($arrMT as $mt){
				$message = new Message();
		        $message->discussion_id = $discussion->id;
		        $message->message_type_id = $mt;		        
		        $message->save();
			}
			$users = User::all();
            //$mail = Mail::pretend();
            foreach($users as $user){
                $user->email;
                $data = array('user'=>$user, 'discussion'=>$discussion->id);
                Mail::send('emails.issue', $data, function($message) use ($user)
                {
                    //var_dump($message);
                    $message->to($user->email , $user->first_name)->subject('New issue!');
                });
            }
            $data = array('user'=>'test');

            /*$data = array(
                'customer' => 'John Smith',
                'url' => 'http://laravel.com'
            );
            Mailgun::send('emails.welcome', $data, function($message)
            {
                $message->to('dovydsb@gmail.com', 'John Smith')->subject('Welcome!');
            });*/
			//print_r($input);
			return Response::json(array('status' => '200','discussionId'=>$discussion->id,'mail'=>''));
		}
	}

}