<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$event_info	= select_event_info($_REQUEST['idx']);
	$prev_event_info	= select_event_info($_REQUEST['idx'] - 1);
	$next_event_info	= select_event_info($_REQUEST['idx'] + 1);
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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_event.png" alt="이벤트"></p>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
                <div class="block_row">
                  <div class="block_col head">
                    <p>제목</p>
                  </div>
                  <div class="block_col">
                    <p><?=$event_info['event_title']?></p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>작성일</p>
                  </div>
                  <div class="block_col">
                    <p><?=str_replace("-",".",substr($event_info['event_regdate'],0,10))?></p>
                  </div>
                </div>
              </div>
              <div class="admin_editor">
                <?=$event_info['event_contents']?>
              </div>
              <table class="pr_view_table">
<?
	if ($prev_event_info)
	{
?>
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single2.png" alt="위로">
                    <span>이전글</span>
                  </td>
                  <td class="subject alignC"><a href="<?=$_mnv_PC_url?>event_detail.php?idx=<?=$prev_event_info['idx']?>"><?=$prev_event_info['event_title']?></a></td>
                  <td class="date dateTerm"><?=str_replace("-",".",substr($prev_event_info['event_startdate'],0,10))?> ~ <?=str_replace("-",".",substr($prev_event_info['event_enddate'],0,10))?></td>
                </tr>
<?
	}

	if ($next_event_info)
	{
?>
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single.png" alt="아래로">
                    <span>다음글</span>
                  </td>
                  <td class="subject alignC"><a href="<?=$_mnv_PC_url?>event_detail.php?idx=<?=$next_event_info['idx']?>"><?=$next_event_info['event_title']?></a></td>
                  <td class="date dateTerm"><?=str_replace("-",".",substr($next_event_info['event_startdate'],0,10))?> ~ <?=str_replace("-",".",substr($next_event_info['event_enddate'],0,10))?></td>
                </tr>
<?
	}
?>
              </table>
                <!-- 게시물 없을 때
<table class="pr_view_table board_empty" style="display:none">
<tr>
<td>게시물이 없습니다</td>
</tr>
</table>
-->
              <div class="block_board_btn">
                <a href="<?=$_mnv_PC_url?>event_list.php"><input type="button" value="목록" class="board_btn"></a>
              </div>
            </div>
            <div class="area_main_bottom">
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="./images/side_full_img1.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC"><img src="./images/customer_center.png" alt="고객센터"></span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon"><img src="./images/about_chon.png" alt="about 촌의감각"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_store.png" alt="입점문의"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_partnership.png" alt="제휴문의"></span></a>
              <a href="#"><span class="sugg last"><img src="./images/heavy_buying.png" alt="대량구매"></span></a>
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