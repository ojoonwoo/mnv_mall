<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$event_info			= select_event_info($_REQUEST['idx']);
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
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single2.png" alt="위로">
                    <span>이전글</span>
                  </td>
<?
	if ($prev_event_info)
	{
?>
                  <td class="subject alignC"><a href="<?=$_mnv_PC_url?>event_detail.php?idx=<?=$prev_event_info['idx']?>"><?=$prev_event_info['event_title']?></a></td>
<?
	}else{
?>
                  <td class="subject alignC">게시글이 없습니다.</td>
<?
	}
?>
                  <td class="date dateTerm"><?=str_replace("-",".",substr($prev_event_info['event_startdate'],0,10))?> ~ <?=str_replace("-",".",substr($prev_event_info['event_enddate'],0,10))?></td>
                </tr>
                <tr>
                  <td class="num">
                    <img src="./images/polygon_single.png" alt="아래로">
                    <span>다음글</span>
                  </td>
<?
	if ($next_event_info)
	{
?>
                  <td class="subject alignC"><a href="<?=$_mnv_PC_url?>event_detail.php?idx=<?=$next_event_info['idx']?>"><?=$next_event_info['event_title']?></a></td>
<?
	}else{
?>
                  <td class="subject alignC">게시글이 없습니다.</td>
<?
	}
?>
                  <td class="date dateTerm"><?=str_replace("-",".",substr($next_event_info['event_startdate'],0,10))?> ~ <?=str_replace("-",".",substr($next_event_info['event_enddate'],0,10))?></td>
                </tr>
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
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
</html>