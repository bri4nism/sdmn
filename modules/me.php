<?php

/*

///==[Me Commands]==///

/me - Returns your info

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

$date1 = date("Y-m-d");
$time = date("h:i:sa");

////////////====[MUTE]====////////////
if(strpos($message, "/me") === 0 || strpos($message, "!me") === 0){   
    $antispam = antispamCheck($userId);
    addUser($userId);
    
    if($antispam != False){
      bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
      ]);
      return;

    }else{
        $messageidtoedit1 =   bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>𝐔𝐒𝐄𝐑 𝐈𝐍𝐅𝐎</b>
- <ins>ID:</ins> <code>$userId</code>
- <ins>Fullname:</ins> ".htmlspecialchars($firstname.$lastname)."
- <ins>Username:</ins> @$username
- <ins>Type:</ins> <b>Free User</b>
━━━━━━━━━━━━━=
<b>$date1 $time</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id,
          'reply_markup'=>json_encode(['inline_keyboard'=>[
          [['text'=>"Checker Stats",'callback_data'=>"checkerstats"]],
          ],'resize_keyboard'=>true])
          ]);
        }
}

if($data == "checkerstats"){
        $gStats = fetchGlobalStats();
        $uStats = fetchUserStats($callbackuserid);
        bot('editMessageText',[
          'chat_id'=>$callbackchatid,
          'message_id'=>$callbackmessageid,
          'text'=>"➤ <b>𝐔𝐒𝐄𝐑 𝐒𝐓𝐀𝐓𝐒</b>

- <ins>Total Cards Checked:</ins> ".$uStats['total_checked']."
- <ins>Total CVV Cards:</ins> ".$uStats['total_cvv']."
- <ins>Total CCN Cards:</ins> ".$uStats['total_ccn']."
          
➤ <b>𝐆𝐋𝐎𝐁𝐀𝐋 𝐒𝐓𝐀𝐓𝐒</b>

- <ins>Total Cards Checked:</ins> ".$gStats['total_checked']."
- <ins>Total CVV Cards:</ins> ".$gStats['total_cvv']."
- <ins>Total CCN Cards:</ins> ".$gStats['total_ccn']."",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id,
          'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"Back",'callback_data'=>"backme"]],
            ],'resize_keyboard'=>true])]);

}

if($data == "backme"){
  $gStats = fetchGlobalStats();
  $uStats = fetchUserStats($callbackuserid);
  bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>𝐔𝐒𝐄𝐑 𝐈𝐍𝐅𝐎</b>
- <ins>ID:</ins> <code>$userId</code>
- <ins>Fullname:</ins> ".htmlspecialchars($firstname.$lastname)."
- <ins>Username:</ins> @$username
- <ins>Type:</ins> <b>Free User</b>
━━━━━━━━━━━━━=
<b>$date1 $time</b>",
      'parse_mode'=>'html',
      'reply_to_message_id'=> $message_id,
      'reply_markup'=>json_encode(['inline_keyboard'=>[
      [['text'=>"Checker Stats",'callback_data'=>"checkerstats"]],
      ],'resize_keyboard'=>true])]);

}


?>