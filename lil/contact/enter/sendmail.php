<?php 

$sent = date('Y/m/d/ G:i:s');

// 事務局振分け
$tokyo   = array('北海道','千葉県','東京都','神奈川県','山梨県','茨城県');
$nagoya  = array('岐阜県','愛知県','三重県','静岡県');
$fukuoka = array('福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
$omiya   = array('青森県','岩手県','宮城県','秋田県','山形県','福島県','栃木県','群馬県','埼玉県','新潟県','長野県');
$office  = array('tokyo','nagoya','fukuoka','omiya');
foreach ($office as $key) {
	if(in_array($pref , ${$key})){
		$area = $key;
		break;
	}else{
		$area = 'osaka';
	}
}

if ( $area == 'tokyo')       { $from_email = __EMAIL_TOKYO__;
}elseif ($area == 'nagoya')  { $from_email = __EMAIL_NAGOYA__;
}elseif ($area == 'fukuoka') { $from_email = __EMAIL_FUKUOKA__;
}elseif ($area == 'omiya')   { $from_email = __EMAIL_OMIYA__;
}else                        { $from_email = __EMAIL_OSAKA__;}

//受付メール
$from    = "From: " . $email . (strlen(__BCC_ADMIN__) > 0 ? "\nBcc: " . __BCC_ADMIN__ : "");
$subject = "PCからのお問い合わせ";
$body    = <<<EOM

送信日時: {$sent}

学習に関するお問い合わせ
====================================================================

資料 : {$document}
学習・入会 ： {$entering}

====================================================================

お名前 ： {$name}
フリガナ ： {$kana}
性別 ： {$gender}
生年月日 : {$birth}
郵便番号 ： {$zipcode}
ご住所 ： {$address}
電話番号 ： {$tel}
メールアドレス ： {$email}
ご希望の学習教科 ： {$curriculum}

====================================================================

その他、お問い合わせ内容 ： 
{$comment}

EOM;
$mailSend_flg &= mb_send_mail($from_email, $subject, $body, $from);


// 自動返信
$from    = "From: " . $from_email . (strlen(__BCC_USER__) > 0 ? "\nBcc: " . __BCC_USER__ : "");
$subject = "お問い合わせを受け付けました";
$body    = <<<EOM
====================================================================

{$name}様

この度はお問い合わせいただき誠にありがとうございました。

近日中に折り返しの電話またはメールにてご連絡させていただきます。
連絡がない場合は、お手数でございますが再度お問い合わせください。

※弊社休業日（土日祝祭日、年末年始、夏季休暇など）を挟む場合は、
通常よりもお時間をいただく場合がございます。


公文エルアイエル

====================================================================
EOM;
$mailSend_flg &= mb_send_mail($email, $subject, $body, $from);

?>