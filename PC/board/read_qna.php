<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$idx		= $_GET['idx'];
	$goods_code = $_GET['goods_code'];
	$pg 		= $_GET['pg'];

	$goods_info = select_goods_info($goods_code);

	$goods_info['goods_img_url'] = str_replace("../../","../",$goods_info['goods_img_url']);

	$board_query	= "SELECT * FROM ".$_gl['board_qna_table']." WHERE idx='".$idx."'";
	$board_result	= mysqli_query($my_db, $board_query);
	$board_data		= mysqli_fetch_array($board_result);

	$prev_query		= "SELECT * FROM ".$_gl['board_qna_table']." WHERE idx < '".$idx."' AND depth=0 ORDER BY idx LIMIT 1";
	$prev_result	= mysqli_query($my_db, $prev_query);
	$prev_data		= mysqli_fetch_array($prev_result);

	$next_query		= "SELECT * FROM ".$_gl['board_qna_table']." WHERE idx > '".$idx."' AND depth=0 ORDER BY idx LIMIT 1";
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
              <p class="cate_title"><img src="../images/cate_title_review.png" alt="리뷰"></p>
            </div>
            <div class="product_modBox mb20">
              <div class="inner clearfix">
                <div class="box img"><img src="<?=$goods_info['goods_img_url']?>"></div>
                <div class="box txt">
                  <div class="boxHead">
                    <p class="name"><?=$goods_info['goods_name']?></p>
                    <p class="price"><?=$goods_info['sales_price']?>￦</p>
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
                  <p>작성자</p>
                </div>
                <div class="block_col">
                  <p><?=substr_replace($board_data['user_id'],'***',-3)?></p>
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
                  <a href="<?=$_mnv_PC_board_url?>read_qna.php?idx=<?=$prev_data['idx']?>&goods_code=<?=$prev_data['goods_code']?>&pg=<?=$pg?>">
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
                  <a href="<?=$_mnv_PC_board_url?>read_qna.php?idx=<?=$next_data['idx']?>&goods_code=<?=$next_data['goods_code']?>&pg=<?=$pg?>">
                    <?=$next_data['subject']?>
                  </a>
                </td>
                <td class="date dateTerm"><?=substr($next_data['date'],0,10)?></td>
              </tr>
            </table>
            <div class="block_board_btn">
              <input type="button" value="목록으로" class="board_btn" onclick="javascript:location.href='./list_qna.php?pg=<?=$pg?>';">
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