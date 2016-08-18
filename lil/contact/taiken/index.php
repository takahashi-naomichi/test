<?php
	define("ROOT_DIR",$_SERVER['DOCUMENT_ROOT']);
	include_once("../inc.php");

	$param_array = array('name1','name2','kana1','kana2','gender','birth_y','birth_m','birth_d','zipcode1','zipcode2','pref','addr','tel1','tel2','tel3','email','confirm_email','check_pen','check_kakikata','check_fude','check_mouhitsu','comment');
	$requestParam = convert1dArray($_POST);
	$request_array = array();
	foreach ($param_array as $tmp) {
		$request_array[$tmp] = getTextData($requestParam, $tmp);
		${$tmp} = escapeHtml($request_array[$tmp]);
		switch ($tmp) {
			case 'birth_y':
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
	$birth = $birth_y .'年'.$birth_m.'月'.$birth_d.'日';
	$zipcode = $zipcode1.'-'.$zipcode2;
	$address = $pref . $addr;
	$tel = $tel1.'-'.$tel2.'-'.$tel3;
	$curriculum = $check_pen.' '.$check_kakikata.' '.$check_fude .' '.$check_mouhitsu;

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
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title></title>
<link rel="stylesheet" type="text/css" href="../../common/css/import.css" media="all" />
</head>

<body>
<div id="wrapper">
  <!-- / id header --> 
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/lil/include/header.html"); ?>
   <!-- / id header -->
  
  <div id="contents" class="clearfix">
    <div id="main">
    	<div id="taiken">
          <div class="group m_b35">
        	<div class="inquiry_box">
            	<h2 class="h2_title"><img src="../../img/taiken/contact/main_title.jpg" width="684" height="131" alt="無料体験学習の お問い合わせ・お申し込み" /></h2>
                <p class="sub_title"><img src="../../img/taiken/contact/sub_title01.gif" width="646" height="22" alt="■お問い合せ、お申し込みから体験の流れ" /></p>
                <div class="contact_box">
                	<h3><img src="../../img/taiken/title_01.gif" width="684" height="63" alt="まずはお近く教室までお問い合わせください。" /></h3>
                	<div class="contact_inner">
                    	<p class="image"><img src="../../img/taiken/img_01.png" width="100" height="149" alt="" /></p>
                        <div class="inner">
                        	<p class="text">通いやすい<span>場所・学習曜日</span>、ご都合に合わせて！<br />
ご希望の教科をお伝えのうえ、先生と学習の予約を。<br />
連絡が取れない時はフリーダイヤルへ。</p>
                            <div class="box_search">
                            	<div class="box_inner">
                                	<p><img src="../../img/common/search_title.gif" width="207" height="29" alt="お近くの教室を探す" /></p>
                                    <div class="clearfix">
                                        <div class="left">
                                            <form action="#" method="post">
                                            <p class="title">〒郵便番号から探す</p>
                                            <p><input type="text" id="keyword01" name="keyword01" value="" class="keyword" /><input type="image" src="../../img/common/btn_submit.png" width="57" height="28" alt="" class="btn_submit" /></p>
                                            <p class="m_t5">（例：1234567）※半角</p>
                                            <p class="title">住所から探す</p>
                                            <p><input type="text" id="keyword02" name="keyword02" value="" class="keyword" /><input type="image" src="../../img/common/btn_submit.png" width="57" height="28" alt="" class="btn_submit" /></p>
                                            <p class="m_t5">（例：○○市△△町１－２－３）<br />
                        ※全角で町名までご入力ください。</p>
                                          </form>
                                        </div>
                                        <div class="right">
                                            <p class="title">地図から探す</p>
                                            <div class="box_map"> 
                                            <img width="144" height="123" src="../../img/common/empty02.png" usemap="#map_tag" id="img_map" style="opacity: 0;">
                                                <map name="map_tag" id="map_tag">
                                                  <area href="#" coords="114,1 143,1, 139,26, 122,26, 122,31, 109,31, 114,1" shape="poly" class="map_area_item" name="../img/common/map02_area1.png" id="map_area1">
                                                  <area href="#" coords="109,38, 123,38, 123,33, 137,33, 129,109, 123,109, 120,102, 96,102, 94,116, 75,116, 77,99, 45,99, 47,76, 86,76, 86,70, 96,70, 96,77, 105,77, 109,38" shape="poly" class="map_area_item" name="../img/common/map02_area2.png" id="map_area2">
                                                  <area href="#" coords="44,105, 70,105, 68,122, 42,122, 44,105" shape="poly" class="map_area_item" name="../img/common/map02_area3.png" id="map_area3">
                                                  <area href="#" coords="9,77,41,77, 36,122, 15,122, 18,97, 6,97, 9,77" shape="poly" class="map_area_item" name="../img/common/map02_area4.png" id="map_area4">
                                                  <area href="#" coords="5,108, 14,108, 12,122, 3,122, 5,108" shape="poly" class="map_area_item" name="../img/common/map02_area5.png" id="map_area5">
                                                </map>
                                             </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- / contact_box -->
                <div class="step_box">
                	<ul class="clearfix">
                    	<li>
                        	<div class="heightLine-step">
                            	<p><img src="../../img/taiken/step_img01.gif" width="212" height="190" alt="2最初に教室で 体験学習のご説明。" /></p>
                                <p class="text">くもん書写の学習法や体験学習の進め方について、説明をお聞きください。ご不明なことは、ご質問・ご相談ください。</p>
                            </div>
                        </li>
                        <li>
                        	<div class="heightLine-step">
                            	<p><img src="../../img/taiken/step_img02.gif" width="212" height="190" alt="3期間中、無料で学習を体験できます。" /></p>
                                <p class="text">期間中、最大3回教室での指導が受けられます。1回の学習時間の目安は1教科で約30〜40分です。</p>
                            </div>
                        </li>
                        <li class="last">
                        	<div class="heightLine-step">
                            	<p><img src="../../img/taiken/step_img03.gif" width="212" height="190" alt="ご自宅でも楽しく学べます。" /></p>
                                <p class="text">期間中、ご自宅で学習する教材をお渡しします。くもん書写教材の良さを、ぜひご実感ください。</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- / inquiry_box -->
          </div>
          
          <div class="group m_b45">
            <div class="form_box">
            	<h3 class="h3_title"><img src="../../img/taiken/contact/sub_title02.gif" width="552" height="42" alt="無料体験学習についてメールで問い合わせる" /></h3>
                <div class="box_text">
                    <p>下記の項目をご入力のうえ、「内容確認」ボタンを押してください。<br />
        メールまたはお電話にてお返事させていただきます。</p>
                    <p><a href="#">&gt;&gt;個人情報のお取り扱いについて</a></p>
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
	<th><p>生年月日</p></th>
	<td><p><?php echo $birth; ?></p></td>
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
	<th><p>メールアドレス</p></th>
	<td><p><?php echo $email; ?></p></td>
</tr>
<tr>
	<th><p>ご希望の学習項目</p></th>
	<td><p><?php echo $curriculum; ?></p></td>
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

                <p><img src="../../img/taiken/contact/img_step.gif" width="683" height="41" alt="" /></p>
                <form id="contactForm" name="contactform" action="" method="post">
                    <input type="hidden" name="mode" value="confirm" />
                    <table class="table_01">
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
                                <th>生年月日</th>
                                <td><div>西暦&nbsp;<input class="size size01 input_year js-convertEn" minlength="4" maxlength="4" type="text" name="birth_y" id="birth_y" value="<?php echo $birth_y; ?>">&nbsp;年&nbsp;
<select name="birth_m" id="birth_m"><?php $mon_array = array('' =>'--');
foreach (range(1, 12) as $num) { $num = sprintf("%02d",$num); $mon_array[$num] = $num;}
foreach($mon_array as $key => $value){
if  ($key == $birth_m){ echo "<option value='$key' selected>".$value."</option>"; }
else{ echo "<option value='$key'>".$value."</option>"; }
} ?></select>&nbsp;月&nbsp;
<select name="birth_d" id="birth_d"><?php $day_array = array('' =>'--');
foreach (range(1, 31) as $num) { $num = sprintf("%02d",$num); $day_array[$num] = $num; }
foreach($day_array as $key => $value){
if($key == $birth_d){ echo "<option value='$key' selected>".$value."</option>"; }
else{                 echo "<option value='$key'>".$value."</option>"; }
} ?></select>&nbsp;日</div>
                        <label id="birthError"></label><?php echo $errMsg['birth']; ?></td>
                            </tr>
                            <tr>
                                <th>ご住所</th>
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
                                <th>電話番号</th>
                                <td><div><input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel1" id="tel1" value="<?php echo $tel1; ?>"> -
<input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel2" id="tel2" value="<?php echo $tel2; ?>"> -
<input class="input_tel js-convertEn size size01" maxlength="5" type="text" name="tel3" id="tel3" value="<?php echo $tel3; ?>"></div>
											<label id="telError"></label><?php echo $errMsg['tel']; ?></td>
                            </tr>
                            <tr>
                                <th>メールアドレス<span>(必須)</span></th>
                                <td><div><input class="input_email size size03" type="text" name="email" id="email" value="<?php echo $email; ?>"></div>
                                			<label id="emailError"></label><?php echo $errMsg['email']; ?>
                                    <span>確認のためもう一度、コピーせずに直接入力してください</span>
                                    <div><input class="input_email size size03" type="text" name="confirm_email" id="confirm_email" value="<?php echo $confirm_email; ?>" oncopy="return false" onpaste="return false" oncontextmenu="return false"></div>
                                    		<label id="confirm_emailError"></label><?php echo $errMsg['confirm_email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>ご希望の学習教科</th>
                                <td><div id="curriculumChkBox" class="clearfix">
<div class="pen"     ><label for="check_pen"     ><input type="checkbox" name="check_pen"      id="check_pen"      value="ペン習字" <?php echo setValueChecked('ペン習字',$check_pen); ?>>ペン習字</label></div>
<div class="kakikata"><label for="check_kakikata"><input type="checkbox" name="check_kakikata" id="check_kakikata" value="かきかた"  <?php echo setValueChecked('かきかた',$check_kakikata); ?>>かきかた</label></div>
<div class="fude"    ><label for="check_fude"    ><input type="checkbox" name="check_fude"     id="check_fude"     value="筆ペン"   <?php echo setValueChecked('筆ペン',$check_fude); ?>>筆ペン</label></div>
<div class="mouhitsu"><label for="check_mouhitsu"><input type="checkbox" name="check_mouhitsu" id="check_mouhitsu" value="毛筆"    <?php echo setValueChecked('毛筆',$check_mouhitsu); ?>>毛筆</label></div>
                            </div>
                                    <p class="m_t5">該当する教科をクリックしてお選びください</p>
                                </td>
                            </tr>
                            <tr>
                                <th>お問い合わせ内容</th>
                                <td><textarea name="comment" id="textarea4" cols="10" rows="6"></textarea></td>
                              </tr>
                        </table>
                        <p class="button"><input type="image" src="../../img/common/btn_submit01.gif" width="99" height="34" class="confirmButton" alt="" /></p>
                    </form>
<?php } //入力画面end ?>

             </div>
          </div>
          
          <div class="group">
          	<h3 class="h3_title"><img src="../../img/taiken/phone_title.gif" width="365" height="41" alt="フリーダイヤルで問い合せる" /></h3>
            <div class="phone_box">
            	<div>
                	<p class="title">教室の時間、所在地、連絡先など教室に関する詳細は下記まで、</p>
                    <p><img src="../../img/common/phone_txt.gif" width="374" height="43" alt="0120-410-297" /></p>
                    <p class="m_t20">（月曜日から金曜日の10時〜１７時  祝日を除く）</p>
                </div>
            </div>
          </div>
        </div><!-- / id taiken -->
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
