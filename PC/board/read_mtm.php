<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$idx		= $_GET['idx'];
	$pg 		= $_GET['pg'];

	$board_query	= "SELECT * FROM ".$_gl['board_mtm_table']." WHERE idx='".$idx."'";
	$board_result	= mysqli_query($my_db, $board_query);
	$board_data		= mysqli_fetch_array($board_result);
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
              <p class="cate_title"><img src="../images/cate_title_consult.png" alt="1대1문의"></p>
            </div>
          </div>
          <div class="area_main_middle nopadd">
            <div class="table_block">
              <div class="block_row">
                <div class="block_col head">
                  <p>제목</p>
                </div>
                <div class="block_col">
                  <p><?=$board_data['subject']?></p>
                </div>
              </div>
              <div class="block_row">
                <div class="block_col head">
                  <p>날짜</p>
                </div>
                <div class="block_col">
                  <p><?=substr($board_data['date'],0,10)?></p>
                </div>
              </div>
              <div class="block_row">
                <div class="block_col head">
                  <p>답변여부</p>
                </div>
                <div class="block_col">
                  <p><?=($board_data['answerYN'] == "Y")?"답변완료":"답변대기"?></p>
                </div>
              </div>
            </div>
            <div class="admin_editor pt20 pb20">
              <!-- 에디터 영역 -->
              <?=$board_data['content']?>
              <!-- 에디터 영역 -->
            </div>
            <div class="block_board_btn">
              <input type="button" value="수정하기" class="board_btn" onclick="javascript:location.href='./edit_mtm.php?idx=<?=$idx?>&pg=<?=$pg?>';">
              <input type="button" value="목록으로" class="board_btn" onclick="javascript:location.href='./list_mtm.php?pg=<?=$pg?>';">
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
    <div id="footer">
      <div class="area_infoChon">
        <div class="inner infoC clearfix">
          <div class="box_info">
            <span class="customerC"><img src="../images/customer_center.png" alt="고객센터"></span>
            <span class="telNum">070-000-0000</span>
            <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
            <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
          </div>
          <div class="box_info">
            <span>이메일 : SERVICE@STORE-CHON.COM</span>
            <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
          </div>
          <div class="box_info clearfix">
            <a href="#"><span class="about_chon"><img src="../images/about_chon.png" alt="about 촌의감각"></span></a>
            <a href="#"><span class="sugg"><img src="../images/sugg_store.png" alt="입점문의"></span></a>
            <a href="#"><span class="sugg"><img src="../images/sugg_partnership.png" alt="제휴문의"></span></a>
            <a href="#"><span class="sugg last"><img src="../images/heavy_buying.png" alt="대량구매"></span></a>
          </div>
          <div class="box_info sns clearfix">
            <a href="#"><span>인스타그램</span></a>
            <a href="#"><span>페이스북</span></a>
            <a href="#"><span>블로그</span></a>
          </div>
        </div>
      </div>
      <div class="address">
        <p>company  미니버타이징(주)  address  서울특별시  서초구  방배동  931-9  2F</p>
        <p>owner  양선혜    business  license  114  87  11622   privacy policy | terms of use</p>
        <br>
        <p>@chon all rights reserved</p>
      </div>
    </div>
  </div>
</body>
</html>