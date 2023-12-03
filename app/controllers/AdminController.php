<?php
class AdminController extends BaseController {


	protected $layout = 'layouts.admin';

	 public function getIndex(){

	 	return View::make('admin.login');

	 }
     
     public function showLogin(){

        return View::make('admin.login');

     }


	 public function retrieveLogin(){

	 	$username = Input::get('username');
	 	$password = Input::get('password');
	 	
	 	if (Auth::attempt(array('username' => $username, 'password' => $password))) {
	 		//echo 'attempting to login';
	 		//exit();
	 		return Redirect::intended('/admin/main');
	 	}
	 	//echo 'not logged';
	 		//exit();
	 	return Redirect::back()
	 		->withInput()
	 		->withErrors('That username/password combo does not exist');

	 }

	 public function getLogin(){

	 	return Redirect::to('/admin/login');

	 }

	 public function getLogout(){
	 	
	 	Auth::logout();

	 	return Redirect::to('/admin/login');
	 }

	 public function mainArea(){

	 	return View::make('admin.main',array('title' => 'Dashboard'));
	 }

	 public function apartamentsArea(){

	 	$apartaments = Apartament::all();
	 	
	 	return View::make('admin.apartaments',array('title' => 'Apartaments', 'apartaments'=>$apartaments));
	 }
	 public function allIssues(){
	    /*$messages = DB::table('messages')
	                   ->join('discussion','messages.discussion_id','=','discussion.id')
                       ->join('discussion_status','discussion.discussion_status_id','=','discussion_status.id')
                       ->where('discussion_status.level','<','15')
                       ->orderby('created_at','desc')
                       ->groupby('discussion.id')
                       ->get();*/
                       	    	

	 	$messages = Message::orderBy('created_at','desc')->groupBy('discussion_id')->get();
	 	return View::make('admin.issues',array('title' => 'Issues', 'messages'=>$messages));
	 }
     public function newIssues(){
        /*$messages = DB::table('messages')
                       ->select('articles.id as articles_id', ..... )
                       ->leftJoin('message_types','messages.message_type_id','=','message_types.id')
                       ->leftJoin('discussions','messages.discussion_id','=','discussions.id')
                       ->leftJoin('discussion_status','discussions.discussion_status_id','=','discussion_status.id')
                       ->where('discussion_status.level','<','15')
                       ->orderby('messages.created_at','desc')
                       ->groupby('discussions.id')
                       ->get();*/
        /*$messages = Message::with(array('discussion.discussionstatus' => function($query) {
                return $query->where('level','<', 15);
            }))->orderBy('created_at','desc')->groupBy('discussion_id')->get();
        $queries = DB::getQueryLog();
        $last_query = $queries;
        print_r($last_query);
        
        $discussions = Discussions::with(array('discussionstatus' => function($query)
        {
            $query->where('level', '<', '15');
        
        }))->get();
        print_r($discussions);*/
        //$messages = Message::with('discussions')->where('discussion_status_id','<', 2)->get(); 
        //$messages = Message::with('discussions')->where('discussions.discussion_status_id','<', 2)->get();
        $messages = Message::with(['discussion'=>function($q){
            $q->where('discussion_status_id','<', 11);
        },'discussion.discussionStatus' => function ($q) {
          //$q->done();          
        },'discussion.apartament'])->orderBy('created_at','desc')->groupBy('discussion_id')->get();
        $queries = DB::getQueryLog();
        $last_query = $queries;
        //print_r($last_query);                     
        return View::make('admin.issuesnew',array('title' => 'Issues', 'messages'=>$messages));
     }
	 public function formApartament(){	 	
	 	$url = action('AdminController@apartamentsArea', array());
	 	return View::make('admin.newApartament', array('url'=>$url, 'action'=>'AdminController@createApartament', 'method'=>'post'));
	 }

	 public function editApartment($id){
	 	
	 	$apartament = Apartament::find($id);
	 	$url = action('AdminController@apartamentsArea', array());
	 	$gUrl = action('AdminController@genereateQR', array('id'=>$id));
	 	return View::make('admin.newApartament', array('url'=>$url, 'apartament' => $apartament, 'method'=>'put', 'action'=> array('AdminController@updateApartament', $id),'gurl'=>$gUrl));
	 }

	 public function deleteApartament($id){
	 	print_r($id);
	 	$apartament = Apartament::find($id);
	 	$apartament->delete();
	 	$apartaments = Apartament::all();
	 	return View::make('admin.apartaments',array('title' => 'Apartaments', 'apartaments'=>$apartaments));
	 }

	 public function createApartament(){
	 	$input = Input::all();
	 	$apartament = new Apartament;
		$apartament->name = $input['name'];		
		$apartament->house_name = $input['house_name'];		
		$apartament->street = $input['street'];
		$apartament->post_code = $input['post_code'];
		$apartament->city = $input['city'];
		$apartament->country = $input['country'];
		$apartament->save();
		$apartaments = Apartament::all();
		return View::make('admin.apartaments',array('title' => 'Apartaments', 'apartaments'=>$apartaments));
	 }

	  public function updateApartament($id){

	  		$input = Input::all();
	  		$apartament = Apartament::find($id);
	  		$apartament->name = $input['name'];			
			$apartament->house_name = $input['house_name'];		
			$apartament->street = $input['street'];
			$apartament->post_code = $input['post_code'];
			$apartament->city = $input['city'];
			$apartament->country = $input['country'];
			$apartament->qr = $input['qr'];
	  		$apartament->save();
	  		return $this->apartamentsArea();
	  }

	  public function respondMessage($id){
	  	$discussion = Discussion::find($id);
	  	return View::make('admin.respondMessage',array('title' => 'Apartaments', 'method'=>'put', 'action'=> array('AdminController@saveResponse', $id), 'discussion'=>$discussion));
	  }

	  public function saveResponse($id){
	  		$input = Input::all();	        
	        $message = new Message();
	        $message->discussion_id = $id;
	        $message->message_type_id = 2;
	        $message->text = $input['text'];
	        $message->save();
	        return $this->respondMessage($id);
	  }

	  public function genereateQR($id) {
	  	if (Request::ajax())
			{				
				$path = app_path();
				$name = "qrcode_".(int)$id.".png";
				$path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR."qrcode_".(int)$id.".png";
							
				print_r(\PHPQRCode\QRcode::png(action('UserController@showForm', array('id'=>$id)), $path, 'L', 4, 2));
				if(file_exists($path)){
					$path = asset('images/'.$name);
					
					return Response::json(array('image' => $path, 'status' => '200', 'shPath'=>$name));
				}
			    //
			}
	  }
	  public function downloadQR($id){
	  	$name = "qrcode_".(int)$id.".png";
	  	$path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR."qrcode_".(int)$id.".png";
		if(file_exists($path)){
			//$path = asset('index.php/images/'.$name);
	  		return Response::download($path);
		}
	  }
	  
	  public function generateShortLink($id){
	  	//if (Request::ajax())
            //{    
        
            $ch = curl_init("https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyCdH9rp629XrCZy-k6zeyEQGhiMjHGlBxQ");  
            $opt = array('longUrl' =>url().'/user/'.$id);
            $headers = array('Content-Type:application/json');
            $options = array(
                CURLOPT_HEADER => 0,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_VERBOSE => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST =>1,
                 CURLOPT_POSTFIELDS => json_encode($opt)
            ); 
            
            curl_setopt_array($ch, $options);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
            //print_r($response->id);
            if($response->id){
                $this->saveShortLink($response, $id);
            }
            return Response::json($response);
            //}
	  	
	  }

      public function saveShortLink($response,$id)
      {
          $apartament = Apartament::find($id);
          //print_r($apartament);
          $apartament->short_link = $response->id;
          $apartament->save();
          return true;
            
      }
	  
	  public function testOher(){
	              // Get API key from : http://code.google.com/apis/console/
        $apiKey = 'MyAPIKey';
        
        $postData = array('longUrl' => $longUrl, 'key' => $apiKey);
        $jsonData = json_encode($postData);
        
        $curlObj = curl_init();
        
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
        
        $response = curl_exec($curlObj);
        
        // Change the response json string to object
        $json = json_decode($response);
        
        curl_close($curlObj);
	  }
      public function changeDiscussionStatus($id){
          $input = Input::all();
          $discussion = Discussion::find($id); 
          $discussion_status = DiscussionStatus::where('level',$input['status'])->first();          
          $discussion->discussion_status_id = $discussion_status->id;
          $discussion->save();
          
          return $this->allIssues();
          
      }
	
	public function changeDiscussionsStatus()
	{
		$input = Input::all();
		//var_dump($input);
		if(is_array($input['ids'])){
			foreach($input['ids'] as $item)
			{	
		          $discussion = Discussion::find($item); 
		          $discussion_status = DiscussionStatus::where('level',$input['status'])->first();  
				  //var_dump($discussion_status);        
		          $discussion->discussion_status_id = $discussion_status->id;
		          $discussion->save();
			}
			 return Response::json(array('status'=>200, 'color' => $discussion_status['color'], 'name' => $discussion_status['name']));
		}
	}
      
}