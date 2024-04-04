<?php
class MessagerModel 
{
    public static function getAllMessages($sender_id, $receiver_id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "CALL getAllMessages(:sender, :receiver)";
        $sth = $database->prepare($sql);
        $sth->execute(array(
            ':sender' => $sender_id,
            ':receiver' => $receiver_id
        ));
            
        $all_messages = array();
        $data = $sth->fetchAll();
        $sth->closeCursor();

        foreach ($data as $messageUser) {
            $all_messages[$messageUser->id] = new stdClass();
            $all_messages[$messageUser->id]->id = $messageUser->id;
            $all_messages[$messageUser->id]->message = $messageUser->message;
            $all_messages[$messageUser->id]->sender = UserModel::getPublicProfileOfUser($messageUser->sender);
            $all_messages[$messageUser->id]->receiver = UserModel::getPublicProfileOfUser($messageUser->receiver);
            $all_messages[$messageUser->id]->seen = $messageUser->seen;
        }
        return $all_messages;
    }

    public static function setUnreadToRead($sender_id, $receiver_id) {
        $database = DatabaseFactory::getFactory()->getConnection();
            $sql = "CALL setUnreadToRead(:receiver_id, :sender_id)";
            $sth = $database->prepare($sql);
            $sth->execute(array(
                ':receiver_id' => $receiver_id, 
                ':sender_id' => $sender_id
            ));
    }

    public static function sendMessage($receiver_id, $message) {
        $database = DatabaseFactory::getFactory()->getConnection();
    
        $sql = "INSERT INTO messages (sender, receiver, message, seen) VALUES (:sender, :receiver, :message, :seen)";
        $sth = $database->prepare($sql);
        $sth->execute(array(
            ':sender' => Session::get('user_id'),
            ':receiver' => $receiver_id,
            ':message' => $message,
            ':seen' => FALSE
        ));
    }

    public static function getAllUnreadMessagesCount($receiver_id, $sender_id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "CALL getAllUnreadMessagesCount(:receiver, :sender)";
        $sth = $database->prepare($sql);
        $sth->execute(array(
            ':receiver' => $receiver_id,
            ':sender' => $sender_id
        ));
        return $sth->fetch()->count;
    }

    public static function isNewMessage($receiver_id, $sender_id) {
        $database = DatabaseFactory::getFactory()->getConnection();
    
            $sql = "SELECT id FROM messages WHERE sender = :sender AND receiver = :receiver AND seen=0";
            $sth = $database->prepare($sql);
            $sth->execute(array(
                ':sender' => $sender_id,
                ':receiver' => $receiver_id
            ));

            if($sth->rowCount()==0){
                return false;
            }else{
                return true;
            }
    }

    
}
