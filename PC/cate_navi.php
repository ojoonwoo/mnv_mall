            <div class="left_cate">
              <a href="#">
                <span class="cate_name"><img src="./images/navi_plate.png" alt="그릇"></span>
              </a>
              <span class="bar1"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_cooking_tools.png" alt="조리도구"></span>
              </a>
              <span class="bar1"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_props.png" alt="소품"></span>
              </a>
              <span class="bar1"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_set.png" alt="세트"></span>
              </a>
              <span class="bar1"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_special.png" alt="스페셜"></span>
              </a>
            </div>
            <div class="right_cate">
              <a href="#">
                <span class="cate_name"><img src="./images/navi_magazine&chon.png" alt="매거진&촌"></span>
              </a>
              <span class="bar2"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_event.png" alt="이벤트"></span>
              </a>
              <span class="bar2"></span>
              <a href="#">
                <span class="cate_name"><img src="./images/navi_ask_partnership.png" alt="제휴문의"></span>
              </a>
            </div>

<!--
            <div class="left_cate">
<?
	$category_info	= select_all_category_info("main");
	$category_cnt	= count($category_info);
	$i = 1;
	foreach($category_info as $key => $val)
	{
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>"><span class="cate_name"><?=$val['cate_name']?></span></a>
<?
		if ($i < $category_cnt)
		{
?>
              <span class="bar1"></span>
<?
		}
		$i++;
	}
?>
            </div>
            <div class="right_cate">
              <a href="<?=$_mnv_PC_url?>post_list.php">
                <span class="cate_name">매거진, 촌</span>
              </a>
              <span class="bar2"></span>
              <a href="<?=$_mnv_PC_url?>event_list.php">
                <span class="cate_name">이벤트</span>
              </a>
              <span class="bar2"></span>
              <a href="#">
                <span class="cate_name">제휴문의</span>
              </a>
            </div>
-->