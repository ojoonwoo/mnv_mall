<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
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
        <div class="contents">
<?
	// 배너 영역
	include_once $_mnv_PC_dir."banner_area.php";

	// 베스트셀러 상품 영역
	include_once $_mnv_PC_dir."best_goods_area.php";

	// 신 상품 영역
	include_once $_mnv_PC_dir."new_goods_area.php";

	// 기획 상품 영역
	include_once $_mnv_PC_dir."plan_goods_area.php";
?>
          <div class="area_list_title">
            <span class="list_title no_line"><img src="./images/title_instagram.png" alt="인스타그램 피드영역"></span>
          </div>
          <div class="area_insta">
            <div class="inner insta clearfix" id="instaPics">
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
<script>
	$('.banner_slide').bxSlider({
		mode:"horizontal",
		pager: false,
		controls:false,
		//slideWidth: 500,
		autoControls: false,
		auto: true,
		infiniteLoop: true
	});

  jQuery(function($) {  
        var tocken = "3651287267.5598e45.7a65d1a07b714cfbba24222d22917d33"; /* Access Tocken 입력 */  
        var count = "5";  
        $.ajax({  
            type: "GET",  
            dataType: "jsonp",  
            cache: false,  
            url: "https://api.instagram.com/v1/users/self/media/recent/?access_token=" + tocken + "&count=" + count,  
            success: function(response) {  
             if ( response.data.length > 0 ) {  
                  for(var i = 0; i < response.data.length; i++) {  
                       var insta = '<div class="insta_box">';  
                       insta += "<a target='_blank' href='" + response.data[i].link + "'>";  
                       insta += "<div class'image-layer'>";  
                       //insta += "<img src='" + response.data[i].images.thumbnail.url + "'>";  
                       insta += '<img src="' + response.data[i].images.thumbnail.url + '">';  
                       insta += "</div>";  
                       //console.log(response.data[i].caption.text);  
                       insta += "</a>";  
                       insta += "</div>";  
                       $("#instaPics").append(insta);  
                  }  
             }  
             $(".insta-box").hover(function(){  
                  $(this).find(".caption-layer").css({"backbround" : "rgba(255,255,255,0.7)", "display":"block"});  
             }, function(){  
                  $(this).find(".caption-layer").css({"display":"none"});  
             });  
            }  
           });  
   });
</script>
