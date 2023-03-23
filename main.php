<?php


include __DIR__."/config/config.php";
include __DIR__."/config/variables.php";
include __DIR__."/functions/bot.php";
include __DIR__."/functions/functions.php";
include __DIR__."/functions/db.php";


date_default_timezone_set($config['timeZone']);


////Modules
include __DIR__."/modules/admin.php";
include __DIR__."/modules/skcheck.php";
include __DIR__."/modules/binlookup.php";
include __DIR__."/modules/iban.php";
include __DIR__."/modules/stats.php";
include __DIR__."/modules/me.php";
include __DIR__."/modules/apikey.php";


include __DIR__."/modules/checker/ss.php";
include __DIR__."/modules/checker/schk.php";
include __DIR__."/modules/checker/sm.php";



//////////////===[START]===//////////////

if(strpos($message, "/start") === 0){
if(!isBanned($userId) && !isMuted($userId)){

  if($userId == $config['adminID']){
    $messagesec = "<b>Type /admin to know admin commands</b>";
  }

    addUser($userId);
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Hello @$username!

I'm Prince Brian Ready to Help You♡
Type /menu to display all the menus I provide.</b>

$messagesec",
	'parse_mode'=>'html',
	'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard' => [
        [
          ['text' => "𝗗𝗼𝗻𝗮𝘁𝗲", 'url' => "paypal.me/eg4u"]
        ],
        [
          ['text' => "𝗢𝘄𝗻𝗲𝗿", 'url' => "t.me/todayisdisaster"]
        ],
      ], 'resize_keyboard' => true])
        
    ]);
  }
}

//////////////===[CMDS]===//////////////

if(strpos($message, "/menu") === 0 || strpos($message, "!menu") === 0){

  if(!isBanned($userId) && !isMuted($userId)){
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Choose the menu you want to check!</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"𝗖𝗵𝗲𝗰𝗸𝗲𝗿 𝗠𝗲𝗻𝘂",'callback_data'=>"checkergates"]],[['text'=>"𝗢𝘁𝗵𝗲𝗿𝘀 𝗠𝗲𝗻𝘂",'callback_data'=>"othercmds"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  }
  
  if($data == "back"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>Choose the menu you want to check!</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"𝗖𝗵𝗲𝗰𝗸𝗲𝗿 𝗠𝗲𝗻𝘂",'callback_data'=>"checkergates"]],[['text'=>"𝗢𝘁𝗵𝗲𝗿𝘀 𝗠𝗲𝗻𝘂",'callback_data'=>"othercmds"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  if($data == "checkergates"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>𝗖𝗵𝗲𝗰𝗸𝗲𝗿 𝗠𝗲𝗻𝘂</b>
  
<b>/ss | !ss - Stripe [Auth]</b>
<b>/sm | !sm - Stripe [Merchant]</b>
<b>/schk | !schk - User Stripe Merchant [Needs SK]</b>

<b>/apikey sk_live_xxx - Add SK Key for /schk gate</b>
<b>/myapikey | !myapikey - View the added SK Key for /schk gate</b>

<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }
  
  
  if($data == "othercmds"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>━━Other Commands━━</b>
  
<b>/me | !me</b> - Your Info
<b>/stats | !stats</b> - Checker Stats
<b>/key | !key</b> - SK Key Checker
<b>/bin | !bin</b> - Bin Lookup
<b>/iban | !iban</b> - IBAN Checker
  
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }

?>