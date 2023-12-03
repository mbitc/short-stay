<?php
class SettingsController extends BaseController {

    protected $layout = 'layouts.admin';
    

    public function getIndex(){
	 	return View::make('admin.settings.main');
	}
    public function mainArea(){
	 	return $this->getIndex();
	}
	public function allIssues(){
	 	$mt = MessageType::all();
	 	return View::make('admin.settings.issues',array('mt'=>$mt));
	}
    public function allDiscussionStatuses(){
        $ds = DiscussionStatus::all();
        return View::make('admin.settings.discussionstatuses',array('ds'=>$ds));
    }
    public function formDiscussionStatus(){       
        return View::make('admin.settings.discussionstatus',array('method'=>'post','action'=>'SettingsController@createDiscussionStatus'));
    }
    public function editDiscussionStatus($id){
        $ds = DiscussionStatus::find($id);       
        return View::make('admin.settings.discussionstatus',array('method'=>'post','action'=>array('SettingsController@updateDiscussionStatus',$id),'ds'=>$ds));
    }
    public function updateDiscussionStatus($id){
        $input = Input::all();    
        $ds = DiscussionStatus::find($id);
        $ds->name = $input['name'];
        $ds->level = $input['level'];
        $ds->color = $input['color'];
        $ds->save();
        return $this->allDiscussionStatuses();  
    }
    public function deleteDiscussionStatus($id){
        $ds = DiscussionStatus::find($id);
        $ds->delete();       
        return $this->allDiscussionStatuses();
    }
    public function createDiscussionStatus(){
        $input = Input::all();
        $discussion_status = new DiscussionStatus;
        $discussion_status->name = $input['name'];
        $discussion_status->level = $input['level'];
        $discussion_status->color = $input['color'];
        $discussion_status->save();
        return $this->allDiscussionStatuses();
    }
	public function issueForm(){	 	
        return View::make('admin.settings.issue',array('method'=>'post','action'=>'SettingsController@createIssueType'));
	}
	public function issueEdit($id){
        $mt = MessageType::find($id);
        return View::make('admin.settings.issue',array('method'=>'put','action'=>array('SettingsController@updateIssueType',$id),'mt'=>$mt));
	}
	public function createIssueType(){
        $input = Input::all();
        $message_type = new MessageType;
        $message_type->name = $input['name'];
        $message_type->save();
        return $this->issueArea(); 
	}
	public function updateIssueType($id){	 		
        $input = Input::all();
        $mt = MessageType::find($id);
        $mt->name = $input['name'];
        $mt->update();
        return $this->issueArea();			
	}
}