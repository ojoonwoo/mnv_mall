<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
?>
<body>
      <div id="wrap_page">
        <div id="header">
          <div class="area_top">
            <div class="head_bar clearfix">
              <ul class="user_status">
                <li><a href="#"><span>로그인</span></a></li>
                <li><a href="#"><span>회원가입</span></a></li>
                <li><a href="#"><span>마이페이지</span></a></li>
                <li><a href="#"><span>장바구니</span></a></li>
                <li><a href="#"><span>주문조회</span></a></li>
              </ul>
            </div>
          </div>
          <div class="logo_area">
            <a href="#"><img src="<?=$_mnv_PC_images_url?>logo.png"></a>
          </div>
          <div class="area_nav">
            <div class="nav clearfix">
              <div class="left_cate">
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_plate.png" alt="그릇"></span>
                </a>
                <span class="bar1"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_cooking_tools.png" alt="조리도구"></span>
                </a>
                <span class="bar1"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_props.png" alt="소품"></span>
                </a>
                <span class="bar1"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_set.png" alt="세트"></span>
                </a>
                <span class="bar1"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_special.png" alt="스페셜"></span>
                </a>
              </div>
              <div class="right_cate">
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_magazine&chon.png" alt="매거진&촌"></span>
                </a>
                <span class="bar2"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_event.png" alt="이벤트"></span>
                </a>
                <span class="bar2"></span>
                <a href="#">
                  <span class="cate_name"><img src="<?=$_mnv_PC_images_url?>navi_ask_partnership.png" alt="제휴문의"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div id="wrap_content">
          <div class="contents l2 clearfix">
            <div class="section main">
              <div class="area_main_top nopadd">
                <div class="block_title">
                  <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_join.png" alt="회원가입"></p>
                </div>
              </div>
              <div class="area_main_middle nopadd noborder">
                <form id="join_form">
                  <div class="block_bg">
                    <div class="block_copy">
                      <div class="block_line clearfix">
                        <span class="input_guide">아이디<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" id="user_id" name="user_id" onblur="dupli_chk(this.value);return false;">
                          <span>(영문소문자/숫자 6 - 12자)</span>
                          <span id="check_alert1" style="color:#b88b5b;letter-spacing:-1px;"></span>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">비밀번호<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="password" class="inputT" id="password" name="password">
                          <span>(영문대소문자/숫자/특수문자 6 - 12자)</span>
                        </div>
                      </div>
                      <div class="block_line clearfix pb20">
                        <span class="input_guide">비밀번호확인<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="password" class="inputT" id="passchk" onblur="pass_chk(this.value);return false;">
                          <span id="check_alert2" style="color:#b88b5b;letter-spacing:-1px;"></span>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">이름<span class="fontColor">*</span></span>
                        <div class="input_block"><input type="text" class="inputT" id="username" name="username" style="ime-mode:active"></div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">휴대전화<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="4" id="phone1" name="phone1">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="phone2" name="phone2">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="phone3" name="phone3">
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">주소</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="7" name="zipcode" id="zipcode" placeholder="우편번호" readonly="true">
                          <input type="button" class="board_btn" value="우편번호" id="find_addr" value="주소검색">
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide blind">주소2</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="50" name="addr1" id="addr1" placeholder="기본주소" readonly="true"><span>기본주소</span>
                        </div>
                      </div>
                      <div class="block_line clearfix pb20 addr">
                        <span class="input_guide blind">주소3</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="50" name="addr2" id="addr2" placeholder="나머지주소"><span>나머지주소(직접입력)</span>
                          <p>미리 입력해두면 주문/배송시 더 간편해집니다.</p>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">이메일<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="15" id="email1" name="email1">
                          <span class="fontColor mrl1" style="font-size:15px;">@</span>
                          <input type="text" class="inputT" size="15" id="email2" name="email2">
                          <div class="selectbox email">
                            <label for="email3">직접입력</label>
                            <select id="email3" name="email3">
                              <option value="direct" selected>직접입력</option>
                              <option value="naver.com">naver.com</option>
                              <option value="gmail.com">gmail.com</option>
                              <option value="hanmail.net">hanmail.net</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="block_line clearfix" style="height:42px;">
                        <span class="input_guide" style="line-height:normal;">이메일<br>수신여부<span class="fontColor">*</span></span>
                        <div class="input_block" style="line-height:normal;">
                          <span class="rd_txt">수신함</span><input type="radio" name="emailYN" value="Y" checked><span class="rd_txt">수신안함</span><input type="radio" name="emailYN" value="N">
                          <p>쇼핑몰에서 제공하는 제품 및 이벤트 소식을 이메일로 받으실 수 있어요.</p>
                        </div>
                      </div>
                      <div class="block_line clearfix" style="height:42px;">
                        <span class="input_guide" style="line-height:normal;">문자<br>수신여부<span class="fontColor">*</span></span>
                        <div class="input_block" style="line-height:normal;">
                          <span class="rd_txt">수신함</span><input type="radio" name="smsYN" value="Y" checked><span class="rd_txt">수신안함</span><input type="radio" name="smsYN" value="N">
                          <p>임시 텍스트영역</p>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">생년월일</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="7" name="birthY" id="birthY" placeholder="년">
                          <input type="text" class="inputT" size="7" name="birthM" id="birthM" placeholder="월">
                          <input type="text" class="inputT" size="7" name="birthD" id="birthD" placeholder="일">
                          <p>생일에 특별한 쿠폰을 드립니다</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="block_btn mt30">
                    <input type="button" class="button_default onColor" id="submit" value="작성완료">
                  </div>
                </form>
              </div>
              <div class="area_main_bottom">

              </div>
            </div>
            <div class="section side">
              <div class="side_full_img">
                <img src="<?=$_mnv_PC_images_url?>side_full.jpg">
              </div>
            </div>
          </div>
        </div>
        <div id="footer">
          <div class="area_infoChon">
            <div class="inner infoC clearfix">
              <div class="box_info">
                <span class="customerC"><img src="<?=$_mnv_PC_images_url?>customer_center.png" alt="고객센터"></span>
                <span class="telNum">070-000-0000</span>
                <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
                <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
              </div>
              <div class="box_info">
                <span>이메일 : SERVICE@STORE-CHON.COM</span>
                <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
              </div>
              <div class="box_info clearfix">
                <a href="#"><span class="about_chon"><img src="<?=$_mnv_PC_images_url?>about_chon.png" alt="about 촌의감각"></span></a>
                <a href="#"><span class="sugg"><img src="<?=$_mnv_PC_images_url?>sugg_store.png" alt="입점문의"></span></a>
                <a href="#"><span class="sugg"><img src="<?=$_mnv_PC_images_url?>sugg_partnership.png" alt="제휴문의"></span></a>
                <a href="#"><span class="sugg last"><img src="<?=$_mnv_PC_images_url?>heavy_buying.png" alt="대량구매"></span></a>
              </div>
              <div class="box_info sns clearfix">
                <a href="#"><span>인스타그램</span></a>
                <a href="#"><span>페이스북</span></a>
                <a href="#"><span>블로그</span></a>
              </div>
            </div>
          </div>
          <div class="address">
            <p>company  미니버타이징(주)  address  서울특별시  서초구  방배동  931-9  2F</p>
            <p>owner  양선혜    business  license  114  87  11622   privacy policy | terms of use</p>
            <br>
            <p>@chon all rights reserved</p>
          </div>
        </div>
      </div>

<script type="text/javascript">
var val_check;
var id_check;
$('#find_addr').on('click', function() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;
			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById('addr1').value = fullAddr;

			// 커서를 상세주소 필드로 이동한다.
			document.getElementById('addr2').focus();
		}
	}).open();
});

$(document).ready(function() {
	var select = $("select#email3");

	select.change(function(){
		var select_name = $(this).children("option:selected").text();
		$(this).siblings("label").text(select_name);
		
		$('#email2').attr('disabled', false);
		var mail = $('#email3').val();
		if(mail=="direct") {
			$('#email2').val('').focus();
		}else{
			$('#email2').val('').val(mail);
			$('#email2').attr('disabled', true);
		}
	});
});


$('#submit').on('click', function(){
	if(id_check == 'Y'){
		val_check = validate('join');
	}else{
		alert("아이디를 다시 입력해주세요.");
		$('#user_id').val('').focus;
		return;
	}

	if(val_check){
		$.ajax({
			method: 'POST',
			url: '../../main_exec.php',
			data: {
				exec		: "member_join",
				user_id		: user_id.value,
				password	: password.value,
				username	: username.value,
				zipcode		: zipcode.value,
				addr1		: addr1.value,
				addr2		: addr2.value,
				email1		: email1.value,
				email2		: email2.value,
				emailYN		: $(':radio[name="emailYN"]:checked').val(),
				tel1		: tel1.value,
				tel2		: tel2.value,
				tel3		: tel3.value,
				phone1		: phone1.value,
				phone2		: phone2.value,
				phone3		: phone3.value,
				smsYN		: $(':radio[name="smsYN"]:checked').val(),
				phone2		: phone2.value,
				birthY		: $('#birthY').val(),
				birthM		: $('#birthM').val(),
				birthD		: $('#birthD').val()
			},
			success: function(res){
				if(res=='Y'){
					alert("가입 성공");
					location.href='./member_index.php';;
				}else{
					alert("가입 실패");
				}
			}
		});
	}
});

function dupli_chk(input) {
	if(input == ""){
		$('#check_alert1').text("아이디를 입력해주세요.");
		return;
	}

	$.ajax({
		method: 'POST',
		url: '../../main_exec.php',
		data: {
			exec   : "duplicate_check",
			input  : input
		},
		success: function(res){
			var regExp1 = /^[a-z]{1}[a-z0-9]{5,11}$/;
			if(res == 'Y' && regExp1.test(input) == true){
				id_check = 'Y';
				$('#check_alert1').text("사용가능한 아이디입니다.");
			}else if(res == 'Y' && regExp1.test(input) == false){
				id_check = 'N';
				$('#check_alert1').text("사용불가능한 아이디입니다.");
			}else{
				id_check = 'D';
				$('#check_alert1').text("중복된 아이디입니다.");
			}
		}
	});
}
function pass_chk(input) {
	var pass = $('#password').val();
	if(input != pass){
		$('#check_alert2').text("비밀번호가 맞지 않습니다.");
	}else if(input == ''){
		$('#check_alert2').text("비밀번호를 입력해주세요.");
	}else{
		$('#check_alert2').text('');
	}
}
</script>
</body>
</html>

