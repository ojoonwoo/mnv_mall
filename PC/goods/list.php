<?
	include_once "../../config.php";
	include_once "../header.php";

	$cate_no	= $_REQUEST['cate_no'];
	$cate_info	= select_category_info($cate_no);
	select_cate_best_goods_info($cate_no, $site_option['cate_goods_flag'], 4)
?>
<body>
<?
	// 상단 카테고리 영역
	include_once "../cate_navi.php";
	// 베스트셀러 상품 영역
	include_once "./best_cate_goods_area.php";
?>
  <h1><?=$cate_info['cate_name']?></h1>
</body>
</html>