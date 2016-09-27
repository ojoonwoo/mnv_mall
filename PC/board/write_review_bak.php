<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
	$user_id			= $_SESSION['ss_chon_id'];
	$goods_code	= $_GET['goods_code'];
?>
<body>
  <form id="write_review">
    아이디 <input type="text" size="10" name="user_id" id="user_id" value="<?=$user_id?>" readonly>
    상품코드 <input type="text" name="goods_code" id="goods_code" value="<?=$goods_code?>" readonly>
    제목 <input type="text" size="30" name="subject" id="subject"><br>  
    <textarea name="content"  id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea><br>
    <input type="button" id="write_rev" value="등록">
  </form>
<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	var oEditors    = [];
	var m_oEditors  = [];

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "content",
		sSkinURI: "../../lib/smarteditor/SmartEditor2Skin.html",  
		htParams : {
			bUseToolbar : true,       // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,   // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,     // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,   // 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

	$('#write_rev').on('click', function(){

		var user_id = $('#user_id').val();
		var goods_code = $('#goods_code').val();
		var subject = $('#subject').val();
		var content = oEditors.getById['content'].getIR();

		if(subject == ''){
			alert("제목을 입력해주세요.")
			return;
		}
		if(content == ''){
			alert("내용을 입력해주세요.")
			return;
		}

		$.ajax({
			method: 'POST',
			url: '../../main_exec.php',
			data: {
				exec        : "write_review",
				user_id     : user_id,
				goods_code  : goods_code,
				subject     : subject,
				content     : content
			},
			success: function(res){
				console.log(res);
				if(res == "Y")
				{
					alert("리뷰가 등록되었습니다.");
					//location.href="list_review.php";
					history.back();
				}else{
					alert("리뷰 등록 실패");
					location.reload();
				}
			}
		})
	});
</script>
</body>
</html>