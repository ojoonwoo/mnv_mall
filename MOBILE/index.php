<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";
?>
<style>
.swiper-container {
    width: 100%;
	height: 100px
}
</style>
<body>
  <div id="wrap">
    <aside id="aside">
      <div class="inner">
        <div class="block_btn">
          <input type="button" value="로그인">
          <input type="button" value="회원가입">
        </div>
        <div class="block_line n2">
          <a href="#">장바구니</a>
          <span class="bar"></span>
          <a href="#">관심상품</a>
        </div>
        <div class="block_line cate">
          <a href="#">그릇</a>
        </div>
        <div class="block_line cate">
          <a href="#">조리도구</a>
        </div>
        <div class="block_line cate">
          <a href="#">소품</a>
        </div>
        <div class="block_line cate">
          <a href="#">세트</a>
        </div>
        <div class="block_line cate">
          <a href="#">스페셜</a>
        </div>
        <div class="linkBtn">
          <a href="#">매거진, 촌</a>
          <a href="#">이벤트</a>
          <a href="#">제휴문의</a>
        </div>
        <div class="block_line n2 sns">
          <a href="#">
            <img src="./images/instagram.png" alt="인스타그램">
          </a>
          <span class="bar"></span>
          <a href="#">
            <img src="./images/blog.png" alt="블로그" class="blog">
          </a>
        </div>
      </div>
    </aside>
    <div class="container">
      <header id="header">
        <div class="topArea">
            <a href="#" class="btnImg cart">장바구니</a>
            <a href="#" class="btnImg menu">메뉴</a>
        </div>
        <div class="logoArea">
          <h1 class="logo">
            <a href="#"><img src="./images/logo.png" alt="촌의감각"></a>
          </h1>
        </div>
        <div class="navi">
          <ul>
            <li><a href="#">그릇</a></li>
            <li><a href="#">조리도구</a></li>
            <li><a href="#">소품</a></li>
            <li><a href="#">스페셜</a></li>
          </ul>
        </div>
      </header>
<?
	// 배너 영역
	include_once $_mnv_MOBILE_dir."banner_area.php";

	// 베스트셀러 상품 영역
	//include_once $_mnv_PC_dir."best_goods_area.php";

	// 신 상품 영역
	//include_once $_mnv_PC_dir."new_goods_area.php";

	// 기획 상품 영역
	//include_once $_mnv_PC_dir."plan_goods_area.php";
?>
      <div class="contents main">
        <div class="prHead_list">
          <div class="centerTxtBox">
            <p>
              <img src="./images/title_best.png" alt="베스트">
            </p>
          </div>
        </div>
        <div class="prList">
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
          </a>
        </div>
        <div class="prHead_list">
          <div class="centerTxtBox">
            <p>
              <img src="./images/title_new.png" alt="신제품">
            </p>
          </div>
        </div>
        <div class="prList">
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
        </div>
        <div class="prHead_list">
          <div class="centerTxtBox">
            <p>
              <img src="./images/title_special.png" alt="스페셜">
            </p>
          </div>
        </div>
        <div class="prList">
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
          <a href="#">
            <img src="./images/default_product.png" alt="상품">
            <p>제품명</p>
            <p class="price">2,500</p>
            <p class="sale">2,500</p>
          </a>
        </div>
        <div class="prHead_list insta">
          <div class="centerTxtBox">
            <p>
              <img src="./images/title_insta.png" alt="인스타그램">
            </p>
          </div>
        </div>
        <div class="prList">
          <a href="#">
            <img src="./images/default_insta.png" alt="피드1">
          </a>
          <a href="#">
            <img src="./images/default_insta.png" alt="피드2">
          </a>
          <a href="#">
            <img src="./images/default_insta.png" alt="피드3">
          </a>
          <a href="#">
            <img src="./images/default_insta.png" alt="피드4">
          </a>
        </div>
      </div>
      <footer id="footer">
        <div class="background">
          <div class="customerArea">
            <p class="center">고객센터</p>
            <p class="call">070-000-0000</p>
            <p>운영시간 10:30~18:00 / 점심시간 13:00~2:30</p>
            <p>신한은행 11-111-11111 예금주 미니버타이징(주)</p>
            <p>이메일 : SERVICE@STORE-CHON.COM</p>
            <p>토/일 법정공휴일, 임시공휴일 전화상담 휴무</p>
            <p>Q&A 게시판을 이용해주세요</p>
          </div>
          <div class="linkArea">
            <a href="#" class="aboutChon">촌의 감각을 소개합니다</a>
            <a href="#">입점문의</a>
            <a href="#">제휴문의</a>
            <a href="#">대량주문</a>
          </div>
          <div class="snsArea">
            <a href="#">
              <img src="./images/instagram.png" alt="인스타그램" class="insta">
            </a>
            <span class="bar"></span>
            <a href="#">
              <img src="./images/facebook.png" alt="페이스북">
            </a>
            <span class="bar"></span>
            <a href="#">
              <img src="./images/blog.png" alt="블로그">
            </a>
          </div>
        </div>
        <address id="address">
          <p>COMPANY 미니버타이징(주)</p>
          <p>ADDRESS 서울특별시 서초구 방배동 931-9 2F</p>
          <p>OWNER 양선혜</p>
          <p>BUSINESS LICENSE  114 87 11622</p>
          <p>PRIVACY POLICY | TERMS OF USE</p>
          <p class="copy">COPYRIGHT@CHON. ALL RIGHTS RESERVED.</p>
        </address>
      </footer>
    </div>
  </div>
</body>
</html>
<script>
/*
	$('.banner_slide').bxSlider({
		mode:"horizontal",
		//pager: false,
		controls:false,
		//slideWidth: 500,
		autoControls: false,
		auto: true,
		infiniteLoop: true,
		pagerCustom: '.bx-pager'
	});
*/
  $(document).ready(function () {
    //initialize swiper when document ready  
    var mySwiper = new Swiper ('.swiper-container', {
      // Optional parameters
      direction: 'vertical',
      loop: true
    })        
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
