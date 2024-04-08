<!DOCTYPE html>
<html>
<head>
    <title>Messager</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {background-color: #f5f5f5;}
        .avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            color: #5C6BC0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Messager</h1>
        <div class="box">
            <?php $this->renderFeedbackMessages(); ?>
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>User's email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->users as $user) { ?>
                        <?php if($user->user_id != Session::get("user_id")): //der angemeldete User wird nicht angezeigt?> 
                            <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                                <td class="avatar">
                                    <?php if (isset($user->user_avatar_link)) { ?>
                                        <img src="<?= $user->user_avatar_link; ?>" />


										<?php if(MessagerController::ifNewMessageShow($user->user_id, Session::get("user_id"))){ ?>

											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
											<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
											</svg>

										<?php } ?>

                                    <?php } ?>
									
                                </td>
                                <td><?= $user->user_name; ?></td>
                                <td><?= $user->user_email; ?></td>
                                <td><a href="<?= Config::get('URL') . 'messager/chat/' . $user->user_id; ?>"><?php if(MessagerController::ifNewMessageShow($user->user_id, Session::get("user_id"))){echo(" New messages: ". MessagerController::UnreadMessageCount($user->user_id, Session::get("user_id")));}else{echo("Message");}?></a></td>
                            </tr>
                        <?php endif; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>