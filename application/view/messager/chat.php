<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            padding: 20px 0;
            color: #333;
        }
        .box {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }
        .chat {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .chat img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .chat p {
            margin: 0;
        }
        .chat.darker {
            justify-content: flex-end;
        }
        .chat.darker img {
            margin-right: 0;
            margin-left: 20px;
        }
        .chat.darker h3, .chat.darker p {
            text-align: right;
        }
        form {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        form input[type="text"] {
            flex-grow: 1;
            margin-right: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #5C6BC0;
            color: #fff;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #333;
        }
        .chat.sender {
    justify-content: flex-end;
}
.chat.sender img {
    margin-right: 0;
    margin-left: 20px;
}
.chat.sender h3, .chat.sender p {
    text-align: right;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Chat</h1>
        <div class="box">
            <h2>You are chatting with <?php echo($data['receiver']->user_name)?></h2>
            <?php foreach ($data['messages'] as $message) { ?>
               <div class="chat <?php echo($message->sender->user_id == Session::get("user_id") ? 'sender' : ''); ?>">
                <img src="<?= $message->sender->user_avatar_link; ?>" />
                <div>
                    <h3><?php echo($message->sender->user_name)?></h3>
                    <p><?php echo($message->message)?></p>
                </div>
            </div>
            <?php } ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>messager/sendMessages">
                <input type="text" name="message" placeholder="Your message" required />
                <input type="hidden" name="receiver_id" value=<?php echo($data['receiver']->user_id)?>/>
                <input type="submit" value="Send" />
            </form>
        </div>
    </div>
</body>
</html>