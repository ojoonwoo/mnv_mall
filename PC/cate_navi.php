            <div class="left_cate">
<?
	$category_info	= select_all_category_info("main");
	$category_cnt	= count($category_info);
	$i = 1;

	foreach($category_info as $key => $val)
	{
?>
<?
		if ($i == 1)
		{
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_plate.png" alt="그릇"></span>
              </a>
<?
		}
?>
<?
		if ($i == 2)
		{
//			$i++;
//			continue;
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_cooking_tools.png" alt="조리도구"></span>
              </a>
<?
		}
?>
<?
		if ($i == 3)
		{
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_props.png" alt="소품"></span>
              </a>
<?
		}
?>
<?
		if ($i == 4)
		{
//			$i++;
//			continue;
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_set.png" alt="세트"></span>
              </a>
<?
		}
?>
<?
		if ($i == 5)
		{
//			$i++;
//			continue;
?>
              <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$val['idx']?>">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_special.png" alt="스페셜"></span>
              </a>
<?
		}
?>
<?
		if ($i < $category_cnt)
//		if ($i < 2)
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
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_magazine&chon.png" alt="매거진&촌"></span>
              </a>
              <span class="bar2"></span>
              <a href="<?=$_mnv_PC_url?>event_list.php">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_event.png" alt="이벤트"></span>
              </a>
              <span class="bar2"></span>
              <a href="<?=$_mnv_PC_url?>partnership.php">
                <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_ask_partnership.png" alt="제휴문의"></span>
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