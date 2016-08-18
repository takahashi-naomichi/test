<?php
	define("ROOT_DIR",$_SERVER['DOCUMENT_ROOT']);
	include_once("../inc.php");

	$param_array = array('document','briefing','establish','name1','name2','kana1','kana2','gender','generation','zipcode1','zipcode2','pref','addr','tel1','tel2','tel3','email','confirm_email','comment');
	$requestParam = convert1dArray($_POST);
	$request_array = array();
	foreach ($param_array as $tmp) {
		$request_array[$tmp] = getTextData($requestParam, $tmp);
		${$tmp} = escapeHtml($request_array[$tmp]);
		switch ($tmp) {
			case 'zipcode1':
			case 'zipcode2':
			case 'tel1':
			case 'tel2':
			case 'tel3':
				${$tmp} = mb_convert_kana(${$tmp}, 'n');
				break;
			default:
				break;
		}
	}
	$name  = $name1 .' '. $name2;
	$kana  = $kana1 .' '. $kana2;
	//$birth = $birth_y .'年'.$birth_m.'月'.$birth_d.'日';
	$zipcode = $zipcode1.'-'.$zipcode2;
	$address = $pref . $addr;
	$tel = $tel1.'-'.$tel2.'-'.$tel3;

	$mode = getTextData($requestParam, "mode");
	$mailSend_flg = true;

	include_once('validate.php');
?>

<?php 
if($mode == "complete"){
	mb_language("ja");
	mb_internal_encoding(__ENCODE_TEMPLATE__);
	$valid_flg = true;
	if($valid_flg){
		include_once('sendmail.php');
	}else{
		$mailSend_flg = false;
	}
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="Description" content="公文式の考え方を書写の分野に応用した書写教室で、学習者の方により早く、より高い書写力をつけていただくことを目的に、地域の皆さまの書写学習をお手伝いさせていただきたいと考えています。" />
<meta name="Keywords" content="教室開設までの流れ,公文書写の先生,公文エルアイエル,公文,公文書写,書写,かきかた,ペン習字,筆ペン,毛筆,くもん,KUMON," />
<title>教室開設に関するお問い合わせ・お申し込み | 公文書写</title>
<link rel="stylesheet" type="text/css" href="../../common/css/import.css" media="all" />
</head>

<body>
<div id="wrapper">
  	<!-- / id header --> 
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/lil/include/header.html"); ?>
   <!-- / id header -->
  
  <div id="contents" class="clearfix">
    <div id="main">
    	<div id="inst">
          <h2 class="h2_title"><img src="../../img/common/recruitment_title.gif" width="383" height="36" alt="くもん書写の先生募集" /></h2>
          <div class="group m_b35">
        	<div class="inquiry_box">
            	<h2 class="h2_title"><img src="../../img/inst/contact/title.gif" width="685" height="132" alt="" /></h2>
                <div class="box_text">
                   <ul class="text_list">
                        <li>教室開設ご希望の方は、</li>
                        <li>各地の<span>「<a href="../../inst/meeting.php">教室開設説明会</a>」</span>にご出席ください。</li>
                   </ul>
                   <p>★上記リンクより説明会開催日程をご確認の上、ご参加のご都合がつかない方には、<br />
　資料をお送りしております。<br />
　また、ご不明な点などがございましたら、公文エルアイエル事務局にお尋ねください。</p>
                </div>
            </div><!-- / inquiry_box -->
          </div>
          
          <div class="group m_b45">
            <div class="form_box">
            	<h3 class="h3_title"><img src="../../img/inst/contact/sub_title01.gif" width="608" height="40" alt="公文エルアイエル事務局に問い合わせ・資料請求" /></h3>
                <div class="box_text">
                    <p>下記の項目をご入力のうえ、「内容確認」ボタンを押してください。<br />
メールまたはお電話にてお返事させていただきます。</p>
                    <p><a href="http://www.kumon.ne.jp/hogo.html?lid=4">&gt;&gt;個人情報のお取り扱いについて</a></p>
                </div>
<!-- コンプリート画面 -->
<?php if($mode == "complete"){ ?>
<p><img src="../../img/contact/img_step3.gif" width="683" height="40" alt="" /></p>
<?php if($mailSend_flg){ ?>
	<p class="completeTitle">お問い合わせを受け付けました。</p>
	<p>
		この度はお問い合わせいただき誠にありがとうございました。<br>
		<br>
		近日中に折り返しの電話またはメールにてご連絡させていただきます。<br>
		連絡がない場合は、お手数でございますが再度お問い合わせください。<br>
		<br>
		※弊社休業日（土日祝祭日、年末年始、夏季休暇など）を挟む場合は、<br>
		通常よりもお時間をいただく場合がございます。
	</p>
<?php }else{ ?>
  <p>
  	正しくメールが送信されていない可能性があります。<br />
  	お手数でございますが再度ご入力いただくか、直接お電話にてお問い合わせくださいませ。</p>
<?php } ?>
<!-- 確認画面 -->
<?php }else if($mode == "confirm"){ ?>
<form id="contactForm" name="contactform" action="" method="post">
<?php foreach ($param_array as $key){ $value = ${$key}; echo "<input type=\"hidden\" name=\"".$key."\" value=\"".$value."\" />";} ?>
<p><img src="../../img/contact/img_step2.gif" width="683" height="40" alt="" /></p>
<input type="hidden" name="mode" value="complete" />
<table class="table_01">
<col style="width:25%"><col>
<tr>
	<th><p>ご希望の項目</p></th>
	<td><p><?php echo $establish. '<br>' .$briefing. '<br>' .$document; ?></p></p></td>
</tr>
<tr>
	<th><p>お名前</p></th>
	<td><p><?php echo $name; ?></p></td>
</tr>
<tr>
	<th><p>フリガナ</p></th>
	<td><p><?php echo $kana; ?></p></td>
</tr>
<tr>
	<th><p>性別</p></th>
	<td><p><?php echo $gender; ?></p></td>
</tr>
<tr>
	<th><p>年代</p></th>
	<td><p><?php echo $generation; ?></p></td>
</tr>
<tr>
	<th><p>ご住所</p></th>
	<td><p>	〒<?php echo $zipcode; ?><br><?php echo $address; ?></p></td>
</tr>
<tr>
	<th><p>電話番号</p></th>
	<td><p><?php echo $tel; ?></p></td>
	</tr>
<tr>
	<th><p>メールアドレス</p>
</th>
	<td><p><?php echo $email; ?></p></td>
</tr>
<tr>
	<th><p>お問い合わせ内容</p></th>
	<td><p><?php echo nl2br($comment); ?></p></td>
</tr>
</table>
<div class="sendBtnBox">
<input class="modifyButton" type="button" onclick="this.form.mode.value='';this.form.submit();return false;" value="">
<input class="sendButton"   type="submit" value="">
</div>
</form>

<!-- 入力画面 -->
<?php }else{ ?>
                <p><img src="../../img/inst/contact/img_01.gif" width="683" height="41" alt="" /></p>
                <form id="contactForm" name="contactform" action="" method="post">
                <input type="hidden" name="mode" value="confirm" />
                    <table class="table_01">
                    	<tr>
                            <th>ご希望の項目に<br />チェックしてください<span>(必須)</span></th>
                            <td>
                            	<ul class="checkbox_list">
                                    <li><input type="checkbox" name="establish" id="establish" value="教室開設に関するお問い合せ" <?php echo setValueChecked('教室開設に関するお問い合せ',$establish); ?>><label for="establish">教室開設に関するお問い合せ</label></li>
                                    <li><input type="checkbox" name="briefing" id="briefing" value="説明会に参加を希望" <?php echo setValueChecked('説明会に参加を希望',$briefing); ?>><label for="briefing">説明会に参加を希望</label></li>
                                   	<li><input type="checkbox" name="document" id="document" value="資料の送付を希望" <?php echo setValueChecked('資料の送付を希望',$document); ?>><label for="document">資料の送付を希望</label></li>
                                </ul>
                            </td>
                        </tr>
                            <tr>
                                <th>お名前<span>(必須)</span></th>
                                <td><div>姓 <input type="text" name="name1" id="name1" value="<?php echo $name1; ?>" class="size size02" /> 名 <input type="text" name="name2" id="name2" value="<?php echo $name2; ?>" class="size size02" /></div>
                        <label id="nameError"></label><?php echo $errMsg['name']; ?></td>
                            </tr>
                            <tr>
                                <th>フリガナ<span>(必須)</span></th>
                                <td><div>セイ <input type="text" name="kana1" id="kana1" value="<?php echo $kana1; ?>" class="size size02" /> メイ <input type="text" name="kana2" id="kana2" value="<?php echo $kana2; ?>" class="size size02" /></div>
                        <label id="kanaError"></label><?php echo $errMsg['kana']; ?></td>
                            </tr>
                            <tr>
                                <th>性別<span>(必須)</span></th>
                                <td><div><?php $genderList = array('男' => 'gender1','女' => 'gender2');
foreach ($genderList as $key => $value) {
if($key == $gender){ echo "<label for=\"". $value ."\"><input type=\"radio\" name=\"gender\" id=\"". $value ."\" value=\"". $key ."\"  checked=\"checked\">" . $key . "</label>";}
else{                echo "<label for=\"". $value ."\"><input type=\"radio\" name=\"gender\" id=\"". $value ."\" value=\"". $key ."\">" . $key . "</label>";}
} ?></div>
                        <label id="genderError"></label><?php echo $errMsg['gender']; ?></td>
                            </tr>
                            <tr>
                                <th>年代</th>
                                <td><div><select name="generation" id="generation">
                            <?php
                            $generation_array = array(
                                '--',
                                '～20代以下',
                                '30代',
                                '40代',
                                '50代',
                                '60代'
                            );
                            foreach($generation_array as $tmp){
                            	if($tmp == "--"){
                            		$option_value = "";
                            	}else{
                            		$option_value = $tmp;
                            	}
                                echo '<option value="'.$option_value.'">'.$tmp.'</option>';
                            }
                            ?>
                            </select>
                            	<span>※原則として、25～60歳までの方を対象とさせていただきます。</span></div>
                        <label id="generationError"></label><?php echo $errMsg['generation']; ?></td>
                            </tr>
                            <tr>
                                <th>ご住所<span>(必須)</span></th>
                                <td>〒 <input class="input_zip1 js-convertEn" maxlength="3" type="text" name="zipcode1" id="zipcode1" value="<?php echo $zipcode1; ?>"> -
<input class="input_zip2 js-convertEn" maxlength="4" type="text" name="zipcode2" id="zipcode2" value="<?php echo $zipcode2; ?>"><br />
                                    <dl>
                                        <dt>都道府県</dt>
                                        <dd><select name="pref" id="pref">
<?php $pref_array = array('' =>'▼選択してください');
$pref_list = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','新潟県','富山県','石川県','福井県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
foreach($pref_list as $tmp) { $pref_array[$tmp] = $tmp;}
foreach($pref_array as $key => $value){
if($key == $pref){ echo "<option value=\"".$key."\" selected>".$value."</option>"; }
else{              echo "<option value=\"".$key."\">".$value."</option>"; }
} ?>
                                        </select></dd>
                                        <dt>市区郡以下</dt>
                                        <dd><input class="input_addr size size03" type="text" name="addr" id="addr" value="<?php echo $addr; ?>">
                                            <span>(例) 大阪市淀川区西中島5-6-6 公文教育会館</span></dd>
                                     </dl>
                                     <label id="addrError"></label><?php echo $errMsg['address']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号<span>(必須)</span></th>
                                <td><div><input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel1" id="tel1" value="<?php echo $tel1; ?>"> -
<input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel2" id="tel2" value="<?php echo $tel2; ?>"> -
<input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel3" id="tel3" value="<?php echo $tel3; ?>"></div>
											<label id="telError"></label><?php echo $errMsg['tel']; ?>
											<span>※メールでの回答が難しい場合、お電話にてご連絡させていただきます。</span></td>
                            </tr>
                            <tr>
                                <th>メールアドレス<br />
						    <span>(必須)</span></th>
                                <td><div><input class="input_email size size03" type="text" name="email" id="email" value="<?php echo $email; ?>"></div>
                                			<label id="emailError"></label><?php echo $errMsg['email']; ?>
                                    <span>確認のためもう一度、コピーせずに直接入力してください</span>
                                    <div><input class="input_email size size03" type="text" name="confirm_email" id="confirm_email" value="<?php echo $confirm_email; ?>" oncopy="return false" onpaste="return false" oncontextmenu="return false"></div>
                                    		<label id="confirm_emailError"></label><?php echo $errMsg['confirm_email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>お問い合わせ内容</th>
                                <td><textarea name="comment" id="textarea4" cols="30" rows="10"><?php echo $comment; ?></textarea></td>
                            </tr>
                    </table>
                    <p class="button"><input type="image" src="../../img/common/btn_submit01.gif" width="99" height="34" class="confirmButton" alt="" /></p>
                </form>
<?php } //入力画面end ?>
              </div>
          </div>
          
          <div class="group">
          	<h3 class="h3_title"><img src="../../img/inst/contact/sub_title02.gif" width="390" height="41" alt="" /></h3>
            <div class="phone_box">
            	<div>
                	<p class="title">学習内容･教室に関する詳細は下記まで、</p>
                    <p><img src="../../img/common/phone_txt.gif" width="374" height="43" alt="0120-410-297" /></p>
                    <p class="m_t20">（月曜日から金曜日の10時〜１７時  祝日を除く）</p>
                </div>
            </div>
          </div>
          <p class="align_c m_t55"><a href="/lil/inst/meeting.php"><img src="../../img/common/btn_06.gif" width="333" height="87" alt="" class="transparent" /></a></p>
        </div><!-- / id inst -->
  	</div><!-- / id main -->
    
    <!-- / id sidebar --> 
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/lil/include/sidebar.html"); ?>
   <!-- / id sidebar -->
  </div><!-- / id contetns -->
  
   <!-- / id footer --> 
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/lil/include/footer.html"); ?>
   <!-- / id footer -->
</div><!-- / id wrapper -->
<!-- js -->
<script type="text/javascript" src="../../common/js/common.js"></script>
<script type="text/javascript" src="../../common/js/jquery.zip2addr.js"></script>
<script type="text/javascript" src="../../common/js/jquery.ah-placeholder.js"></script>
<script type="text/javascript" src="../../common/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../common/js/form.js"></script>
<!-- js -->
</body>
</html>
