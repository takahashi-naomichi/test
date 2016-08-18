$(function(){
  $('#zipcode1').zip2addr({
		zip2:'#zipcode2',
		pref:'#pref',
		addr:'#addr'
	});
	$('[placeholder]').ahPlaceholder({
		placeholderColor : 'silver',
		placeholderAttr : 'placeholder',
		likeApple : false
	});

	$('.js-convertEn').on('change', function(){
		var txt  = $(this).val();
		var En = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});
		$(this).val(En);
	});

	$("[type=checkbox]").each(function(){
		var isl = $(this).attr("id");
		if ($(this).is(":checked")) { $("label[for="+isl+"]").addClass("checked"); }; });
	$("[type=checkbox]").on('change',function(){
		var isl = $(this).attr("id");
		if($(this).is(":checked")){ $("label[for="+isl+"]").addClass("checked"); }else{ $("label[for="+isl+"]").removeClass("checked"); }
	});



jQuery.validator.addMethod("kana", function(value, element) {
	return this.optional(element) || /^([ァ-ヶー]+)$/.test(value);
	}, "カタカナで入力してください"
);
jQuery.validator.addMethod(
    "birth", function(value, element) {
    		var y = $('#birth_y').val();
    		var m = $('#birth_m').val();
    		var d = $('#birth_d').val();
    		var value = m +'/'+ d +'/'+ y;
        var check = false;
        var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
        if( re.test(value)){
            var adata = value.split('/');
            var mm = parseInt(adata[0],10);
            var dd = parseInt(adata[1],10);
            var yyyy = parseInt(adata[2],10);
            var xdata = new Date(yyyy,mm-1,dd);
            if ( ( xdata.getFullYear() == yyyy ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == dd ) )
                check = true;
            else
                check = false;
        } else
            check = false;
        return this.optional(element) || check;
    },
    "すべての生年月日を入力してください"
);


  $("#contactForm").validate({
  	groups  : {
			checkcategory  :"document entering",
			name  :"name1 name2",
			kana  :"kana1 kana2",
			birth : "birth_y birth_m birth_d",
			tel   : "tel1 tel2 tel3",
			address : "pref addr zipcode1 zipcode2"
  	},
  	errorPlacement: function(error, element) {
		if (element.attr("name") == "document" || element.attr("name") == "entering")
			error.insertAfter("#checkcategoryError");
		if (element.attr("name") == "name1" || element.attr("name") == "name2")
			error.insertAfter("#nameError");
		if (element.attr("name") == "kana1" || element.attr("name") == "kana2")
			error.insertAfter("#kanaError");
		if (element.attr("name") == "birth_y" || element.attr("name") == "birth_m" || element.attr("name") == "birth_d")
			error.insertAfter("#birthError");
		if (element.attr("name") == "pref" || element.attr("name") == "addr" || element.attr("name") == "zipcode1" || element.attr("name") == "zipcode2")
			error.insertAfter("#addrError");
		if (element.attr("name") == "tel1" || element.attr("name") == "tel2" || element.attr("name") == "tel3")
			error.insertAfter("#telError");
		else
			error.insertAfter($('#' + element.attr('name') + 'Error'));
		},
    rules: {
      checkcategory : { required: true, minlength: 1 },

      name1 : { required: true },
      name2 : { required: true },

      kana1 : { required: true , kana : true},
      kana2 : { required: true , kana : true},

      gender : { required: true },

      birth_y : { number : true, birth: true , minlength: true},
      birth_m : { number : true, birth: true  },
      birth_d : { number : true, birth: true  },

      zipcode1 : { number: true },
      zipcode2 : { number: true },

      pref : { required: true },
      addr : { required: true },

      tel1  : { number : true },
      tel2  : { number : true },
      tel3  : { number : true },

      email : { required: true, email: true },
      confirm_email : { required: true, equalTo: "#email" }
    },
    messages: {
			checkcategory  : { required: "ご希望の項目にチェックして下さい" },

			name1  : { required: "名前を入力して下さい" },
			name2  : { required: "名前を入力して下さい" },

			kana1  : { required: "フリガナを入力して下さい" },
			kana2  : { required: "フリガナを入力して下さい" },

			gender : {　required: "性別を選択して下さい" },

			birth_y : { number : "正しい生年月日を入力してください" , minlength: "正しい生年月日を入力してください" },
			birth_m : { number : "正しい生年月日を入力してください" },
			birth_d : { number : "正しい生年月日を入力してください" },

			zipcode1 : { number: "郵便番号を正しく入力してください。" },
			zipcode2 : { number: "郵便番号を正しく入力してください。" },

			pref   : { required: "都道府県を選択してください。" },
			addr   : { required: "住所を入力して下さい" },

			tel1   : { number : "電話番号を正しく入力して下さい" },
			tel2   : { number : "電話番号を正しく入力して下さい" },
			tel3   : { number : "電話番号を正しく入力して下さい" },

			email  : { required: "メールアドレスを入力して下さい",
								 email   : "メールアドレスを正しく入力して下さい。"},
			confirm_email : {
								 required: "確認のため、もう一度メールアドレスを入力して下さい",
								 equalTo : "メールアドレスが一致していません。"
        }
    },
    errorClass: "validError",
    errorElement: "label"

  });







});