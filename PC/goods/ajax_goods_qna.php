<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
?>
                <p class="head_txt">상품문의</p>
<?
	$goods_code	= $_REQUEST['goods_code'];
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_qna_table']." WHERE goods_code='".$goods_code."'";

	list($buyer_count) = @mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));


	// 상품문의 리스트
	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}

	if ($buyer_count < 4)
		$page_size = $buyer_count;  // 한 페이지에 나타날 개수
	else
		$page_size = 4;  // 한 페이지에 나타날 개수

	$block_size = 1; // 한 화면에 나타낼 페이지 번호 개수

	//$buyer_count 여부
	if ($buyer_count > 0)
	{
?>
                <table class="pr_view_table">
<?
		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList8();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
		$buyer_list_query = "SELECT * FROM ".$_gl['board_qna_table']." WHERE 1 AND goods_code='".$goods_code."' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data;
		}
		foreach($buyer_info as $key => $val)
		{
?>
                  <tr class="visible_board">
                    <td class="num"><?=$PAGE_UNCOUNT--;?></td>
                    <td class="subject">
<?
	if($buyer_info[$key]['depth']>0)
	{
?>
                      <img height=1 width="<?=$buyer_info[$key]['depth']*7?>">
<?
	}
?>
                      <a href="javascript:void(0);" class="open_board">
						<?=$buyer_info[$key]['subject']?>
                      </a>
                    </td>
                    <td class="writer"><?=$buyer_info[$key]['user_id']?></td>
                    <td class="date"><?=substr($buyer_info[$key]['date'],0,10)?></td>
                  </tr>
                  <!--                  본문 영역 hide                  -->
                  <tr class="hidden_board" style="display:none;">
                    <td class="open_content" colspan="4">
                      <?=$buyer_info[$key]['content']?>
                      <div style="text-align:right;">
                        <input type="button" value="수정하기" class="board_btn" onclick="edit_qna('<?=$buyer_info[$key]['user_id']?>','<?=$buyer_info[$key]['idx']?>','<?=$buyer_info[$key]['goods_code']?>');">
                      </div>
                    </td>
                  </tr>
                  <!--                  본문 영역 hide                  -->
<?
		}
		unset($buyer_info);
?>
                </table>
<?
	}else{
?>
                <table class="pr_view_table board_empty">
                  <tr>
                    <td>게시물이 없습니다</td>
                  </tr>
                </table>
<?
	}
?>
                <div class="block_board_btn">
<?
	if ($login_id == "")
	{
?>
                  <a href="#" onclick="alert('로그인 후 이용해 주세요.');location.href='<?=$_mnv_PC_member_url?>member_login.php';"><input type="button" value="작성하기" class="board_btn" id="write_qna"></a>
<?
	}else{
?>
                  <a href="<?=$_mnv_PC_board_url?>write_qna.php?goods_code=<?=$goods_code?>"><input type="button" value="작성하기" class="board_btn" id="write_qna"></a>
<?
	}
?>
                  <a href="<?=$_mnv_PC_board_url?>list_qna.php"><input type="button" value="목록으로" class="board_btn" id="list_qna"></a>
                </div>
                <div class="block_board_pager">
                  <div class="pageing"><?php echo $BLOCK_LIST?></div>
                </div>
