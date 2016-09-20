<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$goods_code	= $_REQUEST['goods_code'];
	$goods_info	= select_goods_info($goods_code);
	$goods_info['goods_img_url']		= str_replace("../../","../",$goods_info['goods_img_url']);
	$current_cnt	= $goods_info['goods_stock'] - $goods_info['goods_sales_cnt'];
	if ($goods_info['goods_optionYN'] == "Y")
	{
		$goods_option_arr	= explode("||",$goods_info['goods_option_txt']);
	}

	// 리뷰 리스트
	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}
	$page_size = 10;  // 한 페이지에 나타날 개수
	$block_size = 10; // 한 화면에 나타낼 페이지 번호 개수

	print_r($_SESSION);
?>
<body>
  <div id="header_area">
    <a href="http://localhost/mnv_mall/PC/index.php">촌의 감각</a>
<?
	if ($_SESSION['ss_chon_id'])
	{
?>
    <a href="#" id="mb_logout">로그아웃</a>
    <a href="http://localhost/mnv_mall/PC/member/modify_form.php">정보수정</a>
<?
	}else{
?>
    <a href="http://localhost/mnv_mall/PC/member/member_login.php">로그인</a>
    <a href="http://localhost/mnv_mall/PC/member/join_form.php">회원가입</a>
<?
	}
?>
    <a href="#">마이페이지</a>
    <a href="#">장바구니</a>
    <a href="#">주문조회</a>
    <a href="#">매거진 촌</a>
    <a href="#">인스타그램</a>
  </div>
<?
	// 상단 카테고리 영역
	include_once "../cate_navi.php";
?>
<input type="hidden" id="hd_sales_price" value="<?=$goods_info['sales_price']?>">
<input type="hidden" id="goods_idx" value="<?=$goods_info['idx']?>">
썸네일 : <img src="<?=$goods_info['goods_img_url']?>" style="width:200px"><br />
제품명 : <?=$goods_info['goods_name']?><br />
판매가 : <?=$goods_info['sales_price']?><br />
상품요약 : <?=$goods_info['goods_small_desc']?><br />
코드 : <?=$goods_info['goods_code']?><br />
<?
	if ($current_cnt < 1)
	{
?>
수량 : 품절 <a href="#">재입고요청</a> 
<?
	}else{
?>
수량 : <input type="text" value="1" id="buy_cnt"><input type="button" value="+" id="cnt_plus"><input type="button" value="-" id="cnt_minus"><br />
<?
	}
?>
<?
	if ($goods_info['goods_optionYN'] == "Y")
	{
		foreach($goods_option_arr as $key => $val)
		{
			$final_option_arr			= explode("|+|",$val);
			$final_option__sel_arr	= explode(";",$final_option_arr[1]);
?>
  <?=$final_option_arr[0]?> : 
  <select>
<?
			foreach($final_option__sel_arr as $key2 => $val2)
			{
?>
    <option><?=$val2?></option>
<?
			}
?>
  </select>
  <br />
<?
		}
	}
?>
  -----------------------------------------------------------------------------------
  <br />
  총 상품금액(수량) <span id="total_price"><?=number_format($goods_info['sales_price'])?></span>원 (<span id="total_cnt">1</span>개) <br />
  <a href="#">구매하기</a> <a href="#" id="mycart_link">장바구니</a> <a href="#" id="wish_link">위시리스트</a>

  <h1>리뷰 게시판</h1>
  <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
    <input type="hidden" name="pg" value="<?=$pg?>">
  </form>
  <table id="review_list" class="table table-hover">
    <thead>
      <tr>
        <th>No.</th>
        <th>subject</th>
        <th>date/writer</th>
        <th>hit</th>
      </tr>
    </thead>
    <tbody>
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_review_table']." WHERE goods_code='".$goods_code."'";

	list($buyer_count) = mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));

	//$buyer_count 여부
	if ($buyer_count > 0)
	{
		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
		$buyer_list_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 AND goods_code='".$goods_code."' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data; 
		}
		foreach($buyer_info as $key => $val)
		{
?>
      <tr>
        <td><?=$PAGE_UNCOUNT--?></td> <!-- No. 하나씩 감소 -->
          <td>
          <? if($buyer_info[$key]['depth']>0) { ?>
            <img height=1 width="<?=$buyer_info[$key]['depth']*7?>">
          <? } ?>
            <a href="http://localhost/mnv_mall/PC/board/read_review.php?idx=<?=$buyer_info[$key]['idx']?>&mb_id=<?=$buyer_info[$key]['user_id']?>&goods_code=<?=$buyer_info[$key]['goods_code']?>&pg=<?=$pg?>">
            <?=$buyer_info[$key]['subject']?>
            </a>
        </td>
        <td><?=$buyer_info[$key]['date']?><br>
          <?=$buyer_info[$key]['user_id']?>
        </td>
        <td><?=$buyer_info[$key]['hit']?></td>
      </tr>
<?
	}
?>
      <tr>
        <td colspan="4"><div class="pageing"><?php echo $BLOCK_LIST?></div></td>
      </tr>
      <tr>
        <td colspan="4">
          <a href="http://localhost/mnv_mall/PC/board/write_review.php?goods_code=<?=$goods_code?>">WRITE</a>
          /<a href="http://localhost/mnv_mall/PC/board/view_all_review.php"> VIEW ALL</a>
        </td>
      </tr>
<?
	}else{
?>
      <tr>
        <td colspan="4">게시글이 없습니다.</td>
      </tr>
      <tr>
        <td colspan="4" align="right">
          <a href="http://localhost/mnv_mall/PC/board/write_review.php?goods_code=<?=$goods_code?>">WRITE</a>
          /<a href="http://localhost/mnv_mall/PC/board/view_all_review.php"> VIEW ALL</a>
        </td>
      </tr>
<?
	}
?>
    </tbody>
  </table>

</body>
</html>
<script type="text/javascript">
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}
</script>