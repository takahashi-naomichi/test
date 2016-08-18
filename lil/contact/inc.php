<?php 

define("__ENCODE_TEMPLATE__", "UTF-8");
define("__ENCODE_ORIGINAL__", "UTF-8");
define("__ENCODE_ENT__",      "UTF-8");

define("__EMAIL_TOKYO__"  , "liltokyo@kumon.co.jp");
define("__EMAIL_NAGOYA__" , "lilnagoya@kumon.co.jp");
define("__EMAIL_FUKUOKA__", "lilfukuoka@kumon.co.jp");
define("__EMAIL_OSAKA__"  , "lilosaka@kumon.co.jp");
define("__EMAIL_OMIYA__"  , "lilomiya@kumon.co.jp");

define("__BCC_ADMIN__"    , "");
define("__BCC_USER__"     , "");

date_default_timezone_set('Asia/Tokyo');
mb_internal_encoding(__ENCODE_TEMPLATE__);
mb_regex_encoding(__ENCODE_TEMPLATE__);

	//コンバート
	function convert($src, $encode = __ENCODE_TEMPLATE__, $orgEncode = __ENCODE_ORIGINAL__){
		if(is_null($src) || strlen($src) == 0) return $src;
		return mb_convert_encoding($src, $encode, $orgEncode);
	}
	//1次元配列用
	function convert1dArray($srcArray, $encode = __ENCODE_TEMPLATE__, $orgEncode = __ENCODE_ORIGINAL__){
		if(!is_array($srcArray)) return null;
		$retArray = array();
		foreach($srcArray as $key => $value){
			$retArray[$key] = convert($value, $encode, $orgEncode);
		}
		return $retArray;
	}
	//2次元配列用
	function convert2dArray($srcArray, $encode = __ENCODE_TEMPLATE__, $orgEncode = __ENCODE_ORIGINAL__){
		if(!is_array($srcArray)) return null;
		$retArray = array();
		for($i =0; $i < count($srcArray); $i++){
			$retArray[$i] = convert1dArray($srcArray[$i], $encode, $orgEncode);
		}
		return $retArray;
	}
	//shift-jis用
	function escape($src){
		if (is_null($src)) return $src;
		// magic_quotes_gpcの値がONなら\削除
		if(get_magic_quotes_gpc()) $src = stripslashes($src);
		return $src;
	}

	function escape1dArray($srcArray){
		if(!is_array($srcArray)) return null;
		$retArray = array();
		foreach($srcArray as $key => $value){
			$retArray[$key] = escape($value);
		}
		return $retArray;
	}

	function escapeHtml($src){
		if (is_null($src)) return $src;
		$src = htmlspecialchars($src, ENT_QUOTES);
		return $src;
	}

	function getRadioData($tgt_array, $tgtKey){
		return((isset($tgt_array[$tgtKey])) ? intval($tgt_array[$tgtKey]) : 0);
	}

	function getTextData($tgt_array, $tgtKey){
		return((isset($tgt_array[$tgtKey])) ? $tgt_array[$tgtKey] : "");
	}

	function getArrayData($tgt_array, $tgtKey){
		return((isset($tgt_array[$tgtKey])) ? $tgt_array[$tgtKey] : array());
	}

	function setValueSelected($selectVal, $tgtVal){
		return(($selectVal == $tgtVal)? " selected=\"selected\"" : "");
	}

	function setValueChecked($selectVal, $tgtVal){
		return(($selectVal == $tgtVal)? " checked=\"checked\"" : "");
	}

?>