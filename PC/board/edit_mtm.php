<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$user_id			= $_SESSION['ss_chon_id'];
	$idx 				= $_REQUEST['idx'];
	$pg					= $_REQUEST['pg'];

	$s_query = "SELECT * FROM ".$_gl['board_mtm_table']." WHERE idx='".$idx."'";
	$result = @mysqli_query($my_db, $s_query);
	$data = @mysqli_fetch_array($result);
	$og_cont = $data['content'];

	echo "<script> var og_content = '$og_cont' </script>";

?>
<body>
  <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
    <div id="wrap_content">
      <div class="contents l2 clearfix">
        <div class="section main">
          <div class="area_main_top nopadd">
            <div class="block_title">
              <p class="cate_title"><img src="../images/cate_title_consult.png" alt="1대1 문의"></p>
            </div>
          </div>
          <div class="area_main_middle nopadd">
            <div class="table_block">
              <div class="block_row">
                <div class="block_col head">
                  <p>질문유형</p>
                </div>
                <div class="block_col">
                  <div class="selectbox">
                    <label for="qType">질문유형을 선택해주세요.</label>
                    <select id="qType" name="qType">
                      <option value="none">질문유형을 선택해주세요.</option>
                      <option value="shipping" <? if($data['question_type'] == "shipping") echo 'selected' ?> >배송문의</option>
                      <option value="payment" <? if($data['question_type'] == "payment") echo 'selected' ?> >결제문의</option>
                      <option value="other" <? if($data['question_type'] == "other") echo 'selected' ?> >기타</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="block_row">
                <div class="block_col head">
                  <p>제목</p>
                </div>
                <div class="block_col">
                  <input class="inputT" type="text" size="70" id="subjectMTM" value="<?=$data['subject']?>">
                </div>
              </div>
              <div class="block_row">
                <div class="block_col head">
                  <p>메일로 답변받기</p>
                </div>
                <div class="block_col">
                  <input class="inputT" type="text" size="30" name="emailMTM" id="emailMTM" value="<?=$data['user_email']?>" disabled>
                  <div class="checks">
                    <input type="checkbox" id="emailChk" <? if($data['user_email'] != '') echo 'checked'; ?> >
                    <label for="emailChk">답변받기</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="insert_editor">
              <textarea name="content"  id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea>
            </div>
            <div class="block_btn mt30">
              <input type="button" class="button_default mr10" value="취소">
              <input type="button" class="button_default onColor" id="edit_mtm" value="수정완료">
            </div>
          </div>
          <div class="area_main_bottom">

          </div>
        </div>
        <div class="section side">
          <div class="side_full_img">
            <img src="../images/side_full_img1.jpg">
          </div>
        </div>
      </div>
    </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </div>
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
			oEditors.getById['content'].setIR(og_content);
		},
		fCreator: "createSEditor2"
	});

	$(document).ready(function(){
		var emailChk = $('#emailChk');
		var email    = $('#emailMTM');
		var select_name = $('#qType').children("option:selected").text();
		$('#qType').siblings("label").text(select_name);
		
		emailChk.on('click', function(){
			if(emailChk.is(':checked')){
				email.attr('disabled', false);
				email.focus();
			}else{
				email.val('');
				email.attr('disabled', true);
			}
		});

		var select = $("select#qType");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});
	});

	$('#edit_mtm').on('click', function(){

		var user_id			= "<?=$user_id?>";
		//		var goods_code = $('#goods_code').val();
		var question_type	= $('#qType option:selected').val();
		var subject 		= $('#subjectMTM').val();
		var user_email			= $('#emailMTM').val();
		var content 		= oEditors.getById['content'].getIR();

		if(question_type == 'none'){
			alert("질문유형을 선택해주세요.");
			return;
		}
		if(subject == ''){
			alert("제목을 입력해주세요.");
			return;
		}
		if(content == ''){
			alert("내용을 입력해주세요.");
			return;
		}

		$.ajax({
			method: 'POST',
			url: '../../main_exec.php',
			data: {
				exec          : "edit_mtm",
				user_id       : user_id,
				user_email    : user_email,
				question_type : question_type,
				subject       : subject,
				content       : content,
				idx           : "<?=$idx?>"
			},
			success: function(res){
				console.log(res);
				if(res == "Y")
				{
					alert("문의가 수정되었습니다.");
					//location.href="list_review.php";
					history.back();
				}else{
					alert("문의 수정 실패");
					location.reload();
				}
			}
		})
	});
</script>
</body>
</html>