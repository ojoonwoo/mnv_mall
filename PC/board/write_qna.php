<?
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once $_mnv_PC_dir."header.php";

$user_id			= $_SESSION['ss_chon_id'];
$goods_code	= $_REQUEST['goods_code'];
$goods_info = select_goods_info($goods_code);

if ($goods_info['discount_price'] == 0)
  $real_price	= $goods_info['sales_price'];
else
  $real_price	= $goods_info['discount_price'];

// 현재 남은 갯수
$current_cnt	= $goods_info['goods_stock'] - $goods_info['goods_sales_cnt'];

$goods_info['goods_img_url']	= str_replace("../../","../",$goods_info['goods_img_url']);
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
              <p class="cate_title"><img src="../images/cate_title_qna.png" alt="상품문의"></p>
            </div>
            <div class="product_modBox mb20">
              <div class="inner clearfix">
                <div class="box img"><img src="<?=$goods_info['goods_img_url']?>"></div>
                <div class="box txt">
                  <div class="boxHead">
                    <p class="name"><?=$goods_info['goods_name']?></p>
                    <p class="price">￦<?=number_format($goods_info['sales_price'])?></p>
                  </div>
                  <div class="boxTail">
                    <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$goods_info['goods_code']?>"><span class="span_btn">상품 상세보기<span class="arrow"></span></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="area_main_middle nopadd">
            <div class="table_block">
              <div class="block_row">
                <div class="block_col head">
                  <p>제목</p>
                </div>
                <div class="block_col">
                  <input class="inputT" type="text" size="70" placeholder="제목" name="subject" id="subject">
                </div>
              </div>
              <div class="block_row">
                <div class="block_col head">
                  <p>작성자</p>
                </div>
                <div class="block_col">
                  <input class="inputT" type="text" size="15" name="user_id" id="user_id" value="<?=$user_id?>" readonly>
                </div>
              </div>
            </div>
            <div class="admin_editor" style="text-align:left;padding-top:0;">
              <!-- 사용자 에디터 삽입 영역 -->
              <textarea name="content" id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea>
              <!-- 사용자 에디터 삽입 영역 -->
            </div>
            <div class="block_btn mt30">
              <input type="button" class="button_default onColor mr10" id="write_qna" value="작성완료">
              <input type="button" class="button_default" value="취소">
            </div>
          </div>
          <div class="area_main_bottom">
          </div>
        </div>
        <div class="section side">
          <div class="side_full_img">
            <img src="../images/side_full.jpg">
          </div>
        </div>
      </div>
    </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
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
		},
		fCreator: "createSEditor2"
	});

	$('#write_qna').on('click', function(){

		var user_id = $('#user_id').val();
		//		var goods_code = $('#goods_code').val();
		var goods_code = "<?=$goods_info['goods_code']?>";
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
				exec        : "write_qna",
				user_id     : user_id,
				goods_code  : goods_code,
				subject     : subject,
				content     : content
			},
			success: function(res){
				if(res == "Y")
				{
					alert("문의가 등록되었습니다.");
					//location.href="list_review.php";
					history.back();
				}else{
					alert("문의 등록에 실패했습니다.");
					location.reload();
				}
			}
		})
	});
</script>
</body>
</html>