<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$cate_no	= $_REQUEST['cate_no'];
	$sub_cate_info	= sub_category_info($cate_no);
	$ref_sub_cate_no = $_REQUEST['sub_cate_no'];
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
            <div class="area_main_top pb20">
              <div class="block_title">
                <p class="cate_title"><img src="../images/cate_title_plate.png" alt="그릇"></p>
              </div>
              <div class="area_list_title left">
                <span class="list_title pr_head"><img src="../images/left_title_best.png" alt="베스트"></span>
              </div>
              <div class="list_product clearfix">
<?
	$best_goods_info		= select_cate_best_goods_info($cate_no, $site_option['best_goods_flag'],4);
	$i	= 0;
	foreach ($best_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
?>
                <div class="product n4">
                  <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>"></a>
                  <div class="prd_info"><span class="prd_name"><?=$val['goods_name']?></span></div>
                </div>
<?
	}
?>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="detail_menu">
                <div class="nav clearfix">
                  <div class="left_cate">
<?
	$i = 1;
	$sub_cate_num	= count($sub_cate_info);
	foreach($sub_cate_info as $key => $val)
	{
		$sub_cate_arr	= explode("||",$val);
?>
                    <a href="#" onclick="show_sub_cate('<?=$sub_cate_arr[0]?>','<?=$sub_cate_arr[1]?>');return false;">
                      <span class="cate_name"><?=$sub_cate_arr[2]?><span class="cate_amount">(<?=$sub_cate_arr[3]?>)</span></span>
                    </a>
<?
		if ($i != $sub_cate_num)
		{
?>
                    <span class="bar3"></span>
<?
		}
		$i++;
	}
?>
                  </div>
                  <div class="right_cate">
                    <a href="#" onclick="show_sub_cate_sort('sales_price asc');return false;">
                      <span class="cate_name">LOW PRICE</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#" onclick="show_sub_cate_sort('sales_price desc');return false;">
                      <span class="cate_name">HIGH PRICE</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#" onclick="show_sub_cate_sort('goods_name asc');return false;">
                      <span class="cate_name">NAME</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#" onclick="show_sub_cate_sort('goods_regdate desc');return false;">
                      <span class="cate_name">NEW</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#" onclick="show_sub_cate_sort('sales_price desc');return false;">
                      <span class="cate_name">REVIEW</span>
                    </a>
                  </div>
                </div>
              </div>
              <div id="sort_goods_area">
                <div class="list_product clearfix">
                  <div class="product n4">
                    <a href="#"><img src="../images/product_n4_default.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">제품명</span>
                      <span class="prd_price">2,500</span>
                      <span class="prd_sale">2,500</span>
                      <span class="sale_pctg"></span>
                      <span class="prd_desc">디저트접시로, 앞접시로, 반찬접시로  전천후로 활용가능한 접시에요.  테두리에 홈이 파진 모양새가</span>
                    </div>
                  </div>
                  <div class="product n4">
                    <a href="#"><img src="../images/product_n4_default.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">제품명</span>
                      <span class="prd_price">2,500</span>
                      <span class="prd_sale">2,500</span>
                      <span class="sale_pctg"></span>
                      <span class="prd_desc">디저트접시로, 앞접시로, 반찬접시로  전천후로 활용가능한 접시에요.  테두리에 홈이 파진 모양새가</span>
                    </div>
                  </div>
                  <div class="product n4">
                    <a href="#"><img src="../images/product_n4_default.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">제품명</span>
                      <span class="prd_price">2,500</span>
                      <span class="prd_sale">2,500</span>
                      <span class="sale_pctg"></span>
                      <span class="prd_desc">디저트접시로, 앞접시로, 반찬접시로  전천후로 활용가능한 접시에요.  테두리에 홈이 파진 모양새가</span>
                    </div>
                  </div>
                  <div class="product n4">
                    <a href="#"><img src="../images/product_n4_default.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">제품명</span>
                      <span class="prd_price">2,500</span>
                      <span class="prd_sale">2,500</span>
                      <span class="sale_pctg"></span>
                      <span class="prd_desc">디저트접시로, 앞접시로, 반찬접시로  전천후로 활용가능한 접시에요.  테두리에 홈이 파진 모양새가</span>
                    </div>
                  </div>
                </div> <!-- 여기 까지 -->
              </div>
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
  </body>
</html>
<script type="text/javascript">
var sub_cate1	= null;
var sub_cate2	= null;
var ref_sub_cate_no = '<?=$ref_sub_cate_no?>';

$(document).ready(function(){
	if(ref_sub_cate_no == ''){
		show_sub_cate('<?=$cate_no?>','0');
	}else {
		show_sub_cate('<?=$cate_no?>',ref_sub_cate_no);
	}
});
</script>