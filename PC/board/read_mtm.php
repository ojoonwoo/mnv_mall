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
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </div>
</body>
</html>