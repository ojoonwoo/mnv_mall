<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$post_info	= select_post_info($_REQUEST['idx']);

	$prev_query		= "SELECT * FROM ".$_gl['post_info_table']." WHERE idx < '".$post_info['idx']."' ORDER BY idx LIMIT 1";
	$prev_result	= mysqli_query($my_db, $prev_query);
	$prev_data		= mysqli_fetch_array($prev_result);

	$next_query		= "SELECT * FROM ".$_gl['post_info_table']." WHERE idx > '".$post_info['idx']."' ORDER BY idx LIMIT 1";
	$next_result	= mysqli_query($my_db, $next_query);
	$next_data		= mysqli_fetch_array($next_result);

	print_r("현재글".$post_info['idx']);
	print_r("이전글".$prev_data['idx']);
	print_r("다음글".$next_data['idx']);
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
                <p class="cate_title"><img src="./images/cate_title_magzine&chon.png" alt="매거진&촌"></p>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="block_title_bg">
                <h2><?=$post_info['post_title']?></h2>
                <p>
                  <span>에디터 : </span><span class="editor">촌의 감각 매니저</span>
                  <span class="bar1 short grey"></span>
                  <span>작성일 : </span><span class="current_date"><?=str_replace("-",".",substr($post_info['post_regdate'],0,10))?></span>
                </p>
              </div>
              <div class="admin_editor">
                <?=$post_info['post_contents']?>
              </div>
              <!-- <div class="block_board_btn">
                <input type="button" value="작성하기" class="board_btn">
                <input type="button" value="문의하기" class="board_btn">
              </div> -->
              <div class="branding_area">
                <img src="./images/chon_branding_img.png" alt="촌의 감각">
              </div>
              <table class="pr_view_table">
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single2.png" alt="위로">
                    <span>이전글</span>
                  </td>
                  <td class="subject alignC">
<?
	if ($prev_data['post_title'] == "")
	{
?>
                      게시글이 없습니다.
<?
	}else{
?>
                    <a href="<?=$_mnv_PC_url?>post_detail.php?idx=<?=$prev_data['idx']?>">
                      <?=$prev_data['post_title']?>
                    </a>
<?
	}
?>
                  </td>
                  <td class="date dateTerm"><?=substr($prev_data['post_regdate'],0,10)?></td>
                </tr>
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single.png" alt="아래로">
                    <span>다음글</span>
                  </td>
                  <td class="subject alignC">
<?
	if ($next_data['post_title'] == "")
	{
?>
                      게시글이 없습니다.
<?
	}else{
?>
                    <a href="<?=$_mnv_PC_url?>post_detail.php?idx=<?=$next_data['idx']?>">
                      <?=$next_data['post_title']?>
                    </a>
<?
	}
?>
                  </td>
                  <td class="date dateTerm"><?=substr($next_data['post_regdate'],0,10)?></td>
                </tr>
              </table>
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