<?php

$errMsg = array();
foreach ($param_array as $tmp) {
  $errMsg[$tmp] = "";
}
$errMsg['name'] = "";
$errMsg['kana'] = "";
$errMsg['address'] = "";
$errMsg['tel'] = "";
$errMsg['birth'] = "";

$errFlag = false;


// バリデーション

  // カナチェック
  function chkKana($str){
    $kana_array = array('ア','イ','ウ','エ','オ','カ','キ','ク','ケ','コ','サ','シ','ス','セ','タ','チ','ツ','テ','ト','ナ','ニ','ヌ','ネ','ノ','ハ','ヒ','フ','ヘ','ホ','マ','ミ','ム','メ','モ','ヤ','ユ','ヨ','ラ','リ','ル','レ','ロ','ワ','ヲ','ン','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ','ァ','ィ','ゥ','ェ','ォ','ッ','ャ','ュ','ョ');
    array_push($kana_array, mb_substr("セソタ", 1, 1));
    $tmpMbLen = mb_strlen($str);
    $valid_flg = true;
    for($tmp_i=0;$tmp_i<$tmpMbLen;$tmp_i++){
      $tmpMbChar = mb_substr($str, $tmp_i,1);
      if(!in_array($tmpMbChar, $kana_array)){
        $valid_flg = false;
        break;
      }
    }
    if($valid_flg) return true;
    return false;
  }
  // 半角数字のみ
  function chkNum($str){
    if(preg_match("/^\d+$/",$str)) return true;
    return false;
  }
  // 半角数字のみ(桁数指定あり)
  function chkNumDigits($num1, $num2, $str){
    if(preg_match("/^\d{".$num1.",".$num2."}$/",$str)) return true;
    return false;
  }
  // 郵便番号
  function chkZip($str){
    if(preg_match('/^\d{3}\-?\d{4}$/', $str)) return true;
    return false;
  }
  // 電話番号
  function chkTel($str){
    if(preg_match( "/^\d{2,5}\-?\d{2,4}\-?\d{4}$/",$str)) return true;
    return false;
  }
  // メールアドレス
  function chkEmail($str){
    if(preg_match("/^[._a-zA-Z0-9-]{1,}@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,})$/",$str)) return true;
    return false;
  }
  // 同一比較
  function chkSame($tgt,$str){
    if($tgt == $str) return true;
    return false;
  }

if ($_POST) {


  // 名前
  if($name1 == null || $name2 == null){ $errFlag = true; $errMsg['name']  ="<label class='validError'>名前を入力してください。</label>"; }
  // フリガナ
  if($kana1 == null || $kana2 == null){
    $errFlag = true; $errMsg['kana']  ="<label class='validError'>フリガナを入力してください。</label>";
  }elseif (!chkKana($kana1.$kana2)) {
    $errFlag = true; $errMsg['kana']  ="<label class='validError'>カタカナで入力してください。</label>";
  }
  // 性別
  if($gender == null){ $errFlag = true; $errMsg['gender']  ="<label class='validError'>性別を選択してください。</label>"; }
  // 生年月日
  if (!($birth_y == null || $birth_m == null || $birth_d == null) && (!chkNum($birth_y) || !checkdate($birth_m, $birth_d, $birth_y))) {
    $errFlag = true; $errMsg['birth']  ="<label class='validError'>正しい生年月日を入力してください。</label>";
  }
  // 電話番号
  if(!($tel1 == null || $tel2 == null || $tel3 == null) && !chkTel($tel)){
    $errFlag = true; $errMsg['tel'] = "<label class='validError'>電話番号を正しく入力してください。</label>";
  }
  // 住所
  if ($zipcode1.$zipcode2 != null && !chkZip($zipcode)) {
    $errFlag = true; $errMsg['address']   ="<label class='validError'>郵便番号を正しく入力してください。</label>";
  }
  if ($pref == null || $addr == null) { $errFlag = true; $errMsg['address']   ="<label class='validError'>住所を入力してください。</label>"; }
  // メールアドレス
  if ($email == null) {
    $errFlag = true; $errMsg['email'] ="<label class='validError'>メールアドレスを入力してください。</label>"; 
  }elseif (!chkEmail($email)) {
    $errFlag = true; $errMsg['email'] ="<label class='validError'>メールアドレスを正しく入力してください。</label>";
  }
  // メールアドレス(確認)
  if ($confirm_email == null) {
    $errFlag = true; $errMsg['confirm_email'] ="<label class='validError'>確認のため、メールアドレスを入力してください。</label>";
  }elseif (!chkSame($email,$confirm_email)) {
    $errFlag = true; $errMsg['confirm_email'] ="<label class='validError'>メールアドレスが一致していません。</label>";
  }

}

if($errFlag == true){ $mode = ""; }
?>
