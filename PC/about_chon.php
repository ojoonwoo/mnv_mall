<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
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
              <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_aboutchon.png" alt="촌의감각"></p>
            </div>

          </div>
          <div class="area_main_middle nopadd">

          </div>
          <div class="area_main_bottom">

          </div>
        </div>
        <div class="section side">
          <div class="side_full_img">
            <img src="<?=$_mnv_PC_images_url?>side_full_img1.jpg">
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