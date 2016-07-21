<?
	include_once "../header.php";
?>
  <body>
    <div class="slide_banner">
      <div class="slide"><img id="slide_img_url1" src="./images/img1.jpg"></div>
      <div class="slide"><img id="slide_img_url2" src="./images/img2.jpg"></div>
      <div class="slide"><img id="slide_img_url3" src="./images/img3.jpg"></div>
    </div>

    <script>
      $(document).ready(function() {
        $.ajax({
            type   : "POST",
            async  : false,
            url    : "../init.php",
            data:{

            },
            success:function(res){
              var res_array = res.split("||");
              $('#slide_img_url1').attr('src', res_array[0]);
              $('#slide_img_url2').attr('src', res_array[1]);
              $('#slide_img_url3').attr('src', res_array[2]);
              $('.slide_banner').bxSlider({
                pager: true,
                slideWidth: 1300,
                autoControls: true,
                auto: true,
                infiniteLoop: true
              })
            }
          });
      });
    </script>
  </body>
</html>