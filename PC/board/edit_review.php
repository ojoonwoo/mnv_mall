<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$idx = $_GET['idx'];

	$s_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
	$result = @mysqli_query($my_db, $s_query);
	$data = @mysqli_fetch_array($result);
	$og_cont = $data['content'];

	echo "<script> var og_content = '$og_cont' </script>";
?>
<body>
  <form id="edit_review">
    아이디 <input type="text" size="10" name="user_id" id="user_id" value="<?=$data['user_id']?>" readonly>
    상품코드 <input type="text" name="goods_code" id="goods_code" value="<?=$data['goods_code']?>" readonly>
    제목 <input type="text" size="30" name="subject" id="subject" value="<?=$data['subject']?>"><br>  
    <textarea name="content"  id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea><br>
    <input type="button" id="edit_rev" value="수정하기">
    <input type="button" onclick="history.back();" value="뒤로가기">
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
			// oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
			oEditors.getById['content'].setIR(og_content);
		},
		fCreator: "createSEditor2"
	});

	$('#edit_rev').on('click', function(){
		$.ajax({
			method: 'POST',
			url: '../../main_exec.php',
			data: {
				exec        : "edit_review",
				user_id     : $('#user_id').val(),
				idx         : <?=$idx?>,
				goods_code  : $('#goods_code').val(),
				subject     : $('#subject').val(),
				content     : oEditors.getById['content'].getIR()
			},
			success: function(res){
				if(res == "Y")
				{
					alert("리뷰가 수정되었습니다.");
					location.href="read_review.php?idx=<?=$idx?>";
				}else{
					alert("리뷰 수정 실패");
					location.reload();
				}
			}
		})
	});
</script>
</body>
</html>