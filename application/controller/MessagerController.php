<?php
class MessagerController extends Controller
{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(Session::userIsLoggedIn()){
            $this->View->render('messager/index', array(
                'users' => UserModel::getPublicProfilesOfAllUsers()
            ));
        }
    }

    public function chat($sender_id) {
        if (isset($sender_id) && Session::userIsLoggedIn()) {
            var_dump($sender_id);
            
            MessagerModel::setUnreadToRead($sender_id,Session::get('user_id'));
            
            $this->View->render('messager/chat', array(
                'messages' => MessagerModel::getAllMessages(Session::get('user_id'), $sender_id),
                'sender' => UserModel::getPublicProfileOfUser(Session::get('user_id')),
                'receiver' => UserModel::getPublicProfileOfUser($sender_id)
            ));
        } else {
            Redirect::home();
        }
    }
    
   public function sendMessages(){
        MessagerModel::sendMessage(Request::post("receiver_id"), Request::post("message"));
        Redirect::to("messager/chat/".Request::post("receiver_id"));
   }
   public static function ifNewMessageShow($sender_id, $receiver_id){
        return MessagerModel::isNewMessage($receiver_id, $sender_id);
   }

   public static function UnreadMessageCount($sender_id, $receiver_id){
        return MessagerModel::getAllUnreadMessagesCount($receiver_id, $sender_id);
   }
    
}