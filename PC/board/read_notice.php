<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$idx		= $_GET['idx'];
	$pg 		= $_GET['pg'];

	$board_query	= "SELECT * FROM ".$_gl['board_notice_table']." WHERE idx='".$idx."'";
	$board_result	= mysqli_query($my_db, $board_query);
	$board_data		= mysqli_fetch_array($board_result);

	$prev_query		= "SELECT * FROM ".$_gl['board_notice_table']." WHERE idx < '".$idx."' AND depth=0 ORDER BY idx LIMIT 1";
	$prev_result	= mysqli_query($my_db, $prev_query);
	$prev_data		= mysqli_fetch_array($prev_result);

	$next_query		= "SELECT * FROM ".$_gl['board_notice_table']." WHERE idx > '".$idx."' AND depth=0 ORDER BY idx LIMIT 1";
	$next_result	= mysqli_query($my_db, $next_query);
	$next_data		= mysqli_fetch_array($next_result);
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
                <p class="cate_title"><img src="../images/cate_title_notice.png" alt="알려드립니다"></p>
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
                    <p>글쓴이</p>
                  </div>
                  <div class="block_col">
                    <p><?=$board_data['user_id']?></p>
                  </div>
                </div>
              </div>
              <div class="admin_editor">
                <!-- 에디터 영역 -->
					<?=$board_data['content']?>
                <!-- 에디터 영역 -->
              </div>
              <table class="pr_view_table">
                <tr>
                  <td class="num">
                    <img src="../images/polygon_single2.png" alt="위로">
                    <span>이전글</span>
                  </td>
                  <td class="subject alignC">
                    <a href="<?=$_mnv_PC_board_url?>read_notice.php?idx=<?=$prev_data['idx']?>&pg=<?=$pg?>">
                      <?=$prev_data['subject']?>
                    </a>
                  </td>
                  <td class="date dateTerm"><?=substr($prev_data['date'],0,10)?></td>
                </tr>
                <tr>
                  <td class="num">
                    <img src="../images/polygon_single.png" alt="아래로">
                    <span>다음글</span>
                  </td>
                  <td class="subject alignC">
                    <a href="<?=$_mnv_PC_board_url?>read_notice.php?idx=<?=$next_data['idx']?>&pg=<?=$pg?>">
                      <?=$next_data['subject']?>
                    </a>
                  </td>
                  <td class="date dateTerm"><?=substr($next_data['date'],0,10)?></td>
                </tr>
              </table>
              <div class="block_board_btn">
                <input type="button" value="문의하기" class="board_btn">
                <input type="button" value="목록으로" class="board_btn" onclick="javascript:location.href='./list_notice.php?pg=<?=$pg?>';">
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