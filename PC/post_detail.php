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
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
</html>