<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$idx = $_GET['idx'];
	$parent_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
	$parent_result = @mysqli_query($my_db, $parent_query);
	$parent_data = @mysqli_fetch_array($parent_result);

	$parent_thread = $parent_data['thread'];
	$parent_depth = $parent_data['depth'];
	$parent_gID = $parent_data['group_id'];

	$parent_subject = "RE:" . $parent_data['subject'];
	$parent_content = $parent_data['content'];
	echo "<script> var og_content = '<br><br><br><br>[ Original Message ]<br>'+'$parent_content'+'<br>' </script>";

?>
<body>
  <form id="reply_review">
    아이디 <input type="text" size="10" name="user_id" id="user_id">
    상품코드 <input type="text" name="goods_code" id="goods_code" value="<?=$parent_data['goods_code']?>" readonly>
    제목 <input type="text" size="30" name="subject" id="subject" value="<?=$parent_subject?>"><br>  
    <textarea name="content"  id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea><br>
    <input type="button" id="reply_rev" value="답변 달기">
    <input type="button" onclick="history.back();" value="뒤로가기">
  </form>
<script type="text/javascript" src="../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	var oEditors    = [];
	var m_oEditors  = [];


	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "content",
		sSkinURI: "../lib/smarteditor/SmartEditor2Skin.html",  
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
			oEditors.getById['content'].setIR(og_content);
		},
		fCreator: "createSEditor2"
	});

	$('#reply_rev').on('click', function(){

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
			url: '../main_exec.php',
			data: {
				exec        : "reply_review",
				user_id     : user_id,
				goods_code  : goods_code,
				subject     : subject,
				p_thread    : <?=$parent_thread?>,
				p_depth     : <?=$parent_depth?>,
				parent_gID    : <?=$parent_gID?>,
				content     : content
			},
			success: function(res){
				if(res=="Y")
				{
					alert("답글이 등록되었습니다.");
					location.href="list_review.php";
				}else{
					alert("답글 등록실패");
					location.reload();
				}
			}
		})
	});
</script>
</body>
</html>