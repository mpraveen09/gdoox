<?php
namespace Gdoox\Http\Controllers\backend\dashboard\chat;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\ChatContacts;
use Gdoox\Models\ChatMessages;
use Gdoox\Models\ChattingUsersRelations;
use Illuminate\Support\Facades\DB;
use Gdoox\Models\BusinessInfo;
//use Gdoox\Models\AlertSystem;
//use Gdoox\User;
use Form;
use Input;
//use DB;


class ChatController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions; 
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function index() {
        try {   
            $chat_invitations = ChatContacts::where('user_id','=',Auth::user()->id)->where('type','=','singlechat')->where('status','=','Pending')->paginate(25);
            return view('backend.dashboard.chat.index', compact('chat_invitations'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
          }
    }

    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()){
//                $user_info = DB::table('chat_messages')
//                    ->select(DB::raw('count(*) as total'))
//                    ->where('viewed','=', '0')
//                    ->groupBy('chat_id','type')
//                    ->get();
                
//                $users = DB::table('chat_messages')
//                    ->select(DB::raw('count(*) as chat_count','type'))
//                    ->where('viewed', '0')
//                    ->groupBy('type')
//                    ->get();
                
//                $users = DB::table('chat_messages')
//                    ->select(DB::raw('count(*) as chat_count'))
//                    ->where('viewed', '0')
//                    ->groupBy('type')
//                    ->get();
                
//                echo "<pre>";
//                print_r($user_info);
//                exit;
                
               // $chat_counts = ChatMessages::groupBy('chat_id')->where('viewed','=','0')->count();
                
//                $update = AlertSystem::where('user_id','=',Auth::user()->id)->first();
//                $update->chat_messages = array('read_at'=>date("Y-m-d H:i:s"),"notification"=>"");
                
//                if($update->save()){
                    $new_chat_req = ChatContacts::where('user_id','=', Auth::user()->id)->where('request','=','Pending')->get();
                    $contacts = ChatContacts::where('user_id','=', Auth::user()->id)->where('request','=','Accepted')->get();
                    $chat_groups = ChatContacts::where('users','=', Auth::user()->id)->where('type','=','groupchat')->get();
                    $chat_contacts = ChatContacts::where('user_id','=', Auth::user()->id)->where('request','=','Accepted')->where('type','=','singlechat')->get();
                    return view('backend.dashboard.chat.create', compact('new_chat_req','chat_contacts','flag','contacts','chat_groups'));   
//                } 
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
     /*
   * Edit product
   */
    public function edit($id) {
         echo "Edit"; exit;
    }    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    
//    Function to save the create and save group into the database.
    
    public function store(){
        
        $request = Request::all();
        $request['users'][] = Auth::user()->id;
        
        $relation = new ChattingUsersRelations();
        $relation->user_id = Auth::user()->id;
        $relation->users = $request['users'];
        $relation->type = 'groupchat';
        $relation->group_name = $request['groupname'];
        
 
        if($relation->save()){
            $chat_id = ChattingUsersRelations::where('user_id','=', Auth::user()->id)->where('group_name','=',$request['groupname'])->first();  
            $group = new ChatContacts();
            $group->user_id = Auth::user()->id;
            $group->chat_id = $chat_id->_id;
            $group->users = $request['users'];
            $group->group_name = $request['groupname'];
            $group->status = '0';
            $group->viewed = '0';
            $group->type = 'groupchat';
            
            if($group->save()){
                return Redirect::route('chat.create')->with('message','Chat Group Created Successfully');
            }
            else {
                return Redirect::route('chat.create')->with('message','Chat Group could not be Created! Please try Again');
            }   
        }
        else {
            return Redirect::route('chat.create')->with('error','Chat Group could not be Created! Please try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        echo "show"; exit;
        
    }
    
    public function startChatting($chatid){
        try {
            if(Auth::user()){
                $request = explode(",",$chatid);
                $chat_id = $request[1];
                $date = date('Y-m-d');
                $data = ChattingUsersRelations::where('_id','=', $chat_id)->first();
             // $prev_chats = ChatMessages::orderBy('created_at','asc')->where('chat_id','=', $chat_id)->take(2)->get();
             // $prev_chats = ChatMessages::where('chat_id','=', $chat_id)->get();
                $prev_chats = ChatMessages::where('chat_id','=', $chat_id)->where('date','like', $date.'%')->get();
                return view('backend.dashboard.chat.start_chat', compact('prev_chats','chat_id','data'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function addContacts(){
        $request = Request::all();
        $chat_id = $request['chat_id'];
        $user_id = Auth::user()->id;
        
        $users = ChattingUsersRelations::where('_id','=', $chat_id)->first();
        $contacts = ChatContacts::whereNotIn('contact_id', $users->users)->where('user_id','=', $user_id)->where('type','=','singlechat')->get();
        
        $html = "";
        if(!empty($contacts->count())){
            $html.='<table class="table table-striped responsive-utilities jambo_table ">';
                $html.='<tbody>';
                foreach($contacts as $contact) {
                    $html.='<tr>
                                <td>'.$contact->contact_name.'</td>
                                <td>'.Form::checkbox('contact_ids', $contact->contact_id, '' ,array('id' => 'contact_ids')).'</td>
                            </tr>';
                }
                $html.='<tr><td></td><td><input class="btn btn-primary" id="save_contact" type="button" value="Add to Group"></td></tr>';
                $html.='</tbody>';
            $html.='</table>';
        }
        else {
            $html.='<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no more contacts to add to this group.
            </div>';
        }
    
        return $html;
    }
    
    public function saveContacts(){
        $request = Request::all();
        $values = $request['contact_ids'];
        $chat_id = $request['chat_id'];
        $contact_ids = explode(',', $values);
        
        DB::collection('chat_users_relations')->where('_id','=', $chat_id)->push('users', $contact_ids);
        
        $users = ChattingUsersRelations::where('_id','=', $chat_id)->first();
        //  $users = ChatContacts::where('chat_id','=', $chat_id)->first();
            
        $contacts = array();
        foreach($users->users as $user) {
            $contacts[] = $user;
        }

        $contact_info = ChatContacts::whereIn('contact_id', $contacts)->get();
        $html="";
        $html.='<div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">';
            $html.='<table class="table table-striped responsive-utilities jambo_table ">';
                $html.='<thead><tr><th>Users:</th></tr></thead>';
                $html.='<tbody>';
                foreach($contact_info as $contact){
                    $html.='<tr><td>'.$contact->contact_name.'</td></tr>';
                }
                $html.='</tbody>';
            $html.='</table>';

            $html.='<div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input id="start_chat" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$chat_id.'" type="button" value="Start Chat"/>
                    <input id="add_contact" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$chat_id.'" type="button" value="Add Contacts to Group"/> 
                </div>
            </div>';
        $html.='</div>';
        return $html;
    }
    
    // public function storeChat(Request $request){
    public function storeChat(){
        try {
            if(Auth::user()){   
                $request = Request::all();
                $file='';
                if(Input::file('file')){
                    $ext = Input::file('file')->getClientOriginalExtension();
                    if (Input::file('file')->isValid()) {
                        $permission = 0777;
                        $destinationPath = Auth::user()->directory_path."/chatdocuments/".date('m')."/".date('d')."/"; // upload path
                        $fileName = "pdf-" . $this->randomString() . "-". time().".".$ext; // renameing image
                        $target_dir = $this->make_directory($destinationPath, $permission, true);

                        if(Input::file('file')->move($target_dir, $fileName)){
                            $file = $destinationPath.$fileName;
                        }
                        else {
                            return 'file_upload_error';
                        }
                    }
                  else {
                    return 'file_notvalid_error';
                  }
                }
                 
                $data = ChattingUsersRelations::where('_id','=', $request['chat_id'])->first();
                
                if($data->type == 'singlechat') {
                    $from_data = ChatContacts::where('contact_id','=', Auth::user()->id)->first();
                    $to_data = ChatContacts::where('chat_id','=', $request['chat_id'])->where('contact_id','!=', Auth::user()->id)->first();
                    
                    $message_data = new ChatMessages();
                    $message_data->users = $from_data->users;
                    $message_data->message = $request['message'];
                    $message_data->file = $file;
                    $message_data->type = "singlechat";
                    $message_data->date = date('Y-m-d H:i:s');
                    $message_data->from_id = Auth::user()->id;
                    $message_data->from_name = $from_data->contact_name;
                    $message_data->to_id = $to_data->user_id;
                    $message_data->to_name = $to_data->contact_name;
                    $message_data->chat_id = $request['chat_id'];
                    $message_data->viewed = '0';
                    $message_data->status = '1';
                    $message_data->save();
                    
                    if(isset($request['date']) && $request['date']!=='undefined'){
                        $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','>', $request['date'])->get();
                    }
                    else {
                        $date = date('Y-m-d');
                        $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','like', $date.'%')->get();
                    }
                    
                    $html = "";
                        if(!empty($prev_chats)) {
                            foreach ($prev_chats as $value) {
                                if($value->from_id == Auth::user()->id) {
                                    $html.='<div class="lv-item media">'.
                                    'ME'.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                         $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>';
                                    
                                $html.='</div>';
                                }
                                else {
                                    $html.='<div class="lv-item media right">'.
                                        $value->from_name.
                                        '<div class="media-body">
                                            <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                            $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                        </div>
                                    </div>';
                                }
                            }
                        }
                    }
                else {
                    $from_data = ChatContacts::where('contact_id','=', Auth::user()->id)->first();
                    
                    $message_data = new ChatMessages();
                    $message_data->message = $request['message'];
                    $message_data->type = "groupchat";
                    $message_data->file = $file;
                    $message_data->date = date('Y-m-d H:i:s');
                    $message_data->from_id = Auth::user()->id;
                    $message_data->from_name = $from_data->contact_name;
                    $message_data->chat_id = $request['chat_id'];
                    $message_data->status = '1';
                    $message_data->save();
                    $html = "";
                    
                    if(isset($request['date'])){
                        $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','>', $request['date'])->get();
                    }
                    else {
                        $date = date('Y-m-d');
                        $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','like', $date.'%')->get();
                    }
                    
                    foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                                $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                    }
                }
                    
                return $html;
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function fetchChat(){
        try {
            if(Auth::user()){
                $request = Request::all();
                $chat_id = $request['chat_id'];
                
                $data = ChattingUsersRelations::where('_id','=', $chat_id)->first();
                
                if(isset($request['date'])){
                    $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','>', $request['date'])->get();
                }
                else {
                    $date = date('Y-m-d');
                    $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','like', $date.'%')->get();
                }
                
                if($data->type==='singlechat'){
                    $html = "";
                    if(!empty($prev_chats)) {
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                               $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
                else {
                    $html = "";
                    if(!empty($prev_chats)){
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                                $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
               return $html;
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function loadPreviousChats(){
        try {
            if(Auth::user()){
                $request = Request::all();
                $data = ChattingUsersRelations::where('_id','=', $request['chat_id'])->first();
                
                if(isset($request['date'])){
                    $date = $request['date'];
                    $prev_day_date = date('Y-m-d H:i:s', strtotime($date .' -10 day'));
                    $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','>=', $prev_day_date)->where('date','<', $date)->get();
                    if(!$prev_chats->count()){
                        $date = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','<',$prev_day_date)->first();
                        $last_msg_date = $date->date;
                        $prev_chats = ChatMessages::where('chat_id','=', $request['chat_id'])->where('date','>=', $last_msg_date)->where('date','<', $date)->get();
                    }
                }
                
                $html = "";
                if($data->type==='singlechat'){
                    if(!empty($prev_chats)) {
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                               $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
                else {
                    if(!empty($prev_chats)){
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                                $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
               return $html;
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function chatArchive($chatid){
        try {
            if(Auth::user()){
                $request = explode(",",$chatid);
                $chat_id = $request[1];
                return view('backend.dashboard.chat.chat_archive', compact('chat_id'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
                
    public function searchChatArchive(){
        try {
            if(Auth::user()){
                $request = Request::all();
                $chat_id = $request['chat_id']; 
                $from_date = $request['from_date'];
                $to_date = $request['to_date'];
                $data = ChattingUsersRelations::where('_id','=', $chat_id)->first();
                
                $prev_chats = ChatMessages::where('chat_id','=', $chat_id)->where('date','>=',$from_date)->where('date','<=',$to_date)->get();
                $html = "";
                
                if($data->type==='singlechat'){
                    if(!empty($prev_chats)) {
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                               $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
                else {
                    if(!empty($prev_chats)){
                        foreach ($prev_chats as $value) {
                            if($value->from_id == Auth::user()->id) {
                                $html.='<div class="lv-item media">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                            else {
                                $html.='<div class="lv-item media right">'.
                                    $value->from_name.
                                    '<div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">'.$value->message.'</div>';
                                            if($value->file!==''){
                                                $html.='<div data-name="download"><a href="'.asset($value->file).'" download>Download Attachment <i class="zmdi zmdi-download zmdi-hc-fw"></i></a></div>';
                                            }
                                        $html.='<small class="ms-date" data-msg_time="'.$value->date.'"><i class="zmdi zmdi-time"></i>'.$value->date.'</small>
                                    </div>
                                </div>';
                            }
                        }
                    }
                }
               return $html;
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    public function fetchContactInfo(){
        $html="";
        $request = Request::all();

        if($request['chat_type']==='groupchat'){
            $chat_id = $request['chat_id'];

            $users = ChattingUsersRelations::where('_id','=', $chat_id)->first();

           //  $users = ChatContacts::where('chat_id','=', $chat_id)->first();

            $contacts = array();
            foreach($users->users as $user) {
                $contacts[] = $user;
            }

            $contact_info = ChatContacts::whereIn('contact_id', $contacts)->get();

            $html.='<div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">';
                $html.='<table class="table table-striped responsive-utilities jambo_table ">';
                    $html.='<thead><tr><th>Users:</th></tr></thead>';
                    $html.='<tbody>';
                    foreach($contact_info as $contact){
                        $html.='<tr><td>'.$contact->contact_name.'</td></tr>';
                    }
                    $html.='</tbody>';
                $html.='</table>';

                $html.='<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input id="start_chat" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$chat_id.'" type="button" value="Start Chat"/>
                        <input id="add_contact" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$chat_id.'" type="button" value="Add Contacts to Group"/>
                        <input id="chat_archive" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$chat_id.'" type="button" value="Chat Archive"/>
                    </div>
                </div>';
            $html.='</div>';
    }
        else {
            $chat_id = $request['chat_id'];  
            $contact = ChatContacts::where('chat_id','=',$chat_id)->where('user_id','!=',Auth::user()->id)->first();
            $contact_info = BusinessInfo::where('user_id', '=', $contact->user_id)->first();
            $contactstatus = ChatContacts::where('chat_id','=', $chat_id)->where('user_id','=',Auth::user()->id)->first();

            if(is_array($contact_info->org_type)){
                $str = implode (", ", $contact_info->org_type);
                $org_type = $str;
            }
            else {
                $org_type = $contact_info->org_type;
            }
            
            $html.='<div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">';
                $html.='<table class="table table-striped responsive-utilities jambo_table ">';
                    $html.='<thead><tr><th></th><th></th></tr></thead>';
                    $html.='<tbody>';
                        $html.='<tr><td>Company Name:</td><td>'.$contact_info->company_name.'</td></tr>';
                        $html.='<tr><td>Organization Type:</td><td>'.$org_type.'</td></tr>';
                        $html.='<tr><td>Business Email:</td><td>'.$contact_info->business_email1.'</td></tr>'; 
                        $html.='<tr><td>Stree Address:</td><td>'.$contact_info->street_add.'</td></tr>'; 
                        $html.='<tr><td>City:</td><td>'.$contact_info->city.'</td></tr>';
                        $html.='<tr><td>Country:</td><td>'.$contact_info->country.'</td></tr>';
                    $html.='</tbody>';
                $html.='</table>';

                if($contactstatus->request==='Pending' && $contactstatus->request_by !== Auth::user()->id){
                    $html.='<table class="table table-striped responsive-utilities jambo_table ">';
                        $html.='<tbody>';
                            $html.="<tr>
                                        <td>Chat Request</td>
                                        <td><a href=".route('updatecontact',['id'=>$contactstatus->chat_id,'action'=>'Accepted'])."><i class='zmdi zmdi-check zmdi-hc-fw'></i>Accept</a></td>
                                        <td><a href=".route('updatecontact',['id'=>$contactstatus->chat_id,'action'=>'Denied'])."><i class='zmdi zmdi-block-alt zmdi-hc-fw'></i>Deny</a></td>
                                    </tr>";
                        $html.='</tbody>';
                    $html.='</table>';
                }

                if($contactstatus->request==='Accepted') {
                    $html.='<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input id="start_chat" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$contactstatus->chat_id.'" type="button" value="Start Chat"/>
                            <input id="chat_archive" data-chat_type="'.$request['chat_type'].'" data-chat_id="'.$contactstatus->chat_id.'" type="button" value="Chat Archive"/>
                        </div>
                    </div>';      
                }
            $html.='</div>'; 
        }
    return $html; 
    }
    
    public function updateContactStatus(){
        try {
            if(Auth::user()){
                $request = Request::all();
                if($request['action']=='Accepted'){
                    ChatContacts::where('chat_id', '=', $request['id']) ->update(['request' => 'Accepted']);
                }
                else {
                    ChatContacts::where('chat_id', '=', $request['id']) ->update(['request' => 'Denied']);
                }   
                return Redirect::route('chat.create');
            }
            else
            {
                return redirect('auth/login')->with('message',"Please Login to Create Contact!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }
    
    public function randomString(){
    try{
        // Random characters
        $characters = array("B","C","D","F","G","H","J","K","L","M","N",
        "P","Q","R","S","T","V","W","X","Y","Z","b","c","d","f","g","h",
        "j","k","l","m","n","p","q","r","s","t","v","w","x","y","z",
        "0", "1","2","3","4","5","6","7","8","9");

        // set the array
        $keys = array();

        // set length
        $length = 8;

        // loop to generate random keys and assign to an array
        while(count($keys) < $length) {
          $x = mt_rand(0, count($characters)-1);
          if(!in_array($x, $keys)) {
               $keys[] = $x;
            }
        }

        // extract each key from array
        $random_chars='';
        foreach($keys as $key){
           $random_chars .= $characters[$key];
        }

        // display random key
        return $random_chars;
    }
    catch (\Exception $e){
        $error = "An error occured. ".
                        "Line Number: ".$e->getLine()." ".
                        "File Name: ".$e->getFile()." ".
                        "Error Description: ".$e->getMessage();
        return view('errors.custom_error')->withErrors($error);
    }
 }
   
    /*
     * Update product
     */
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
