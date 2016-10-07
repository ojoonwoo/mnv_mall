<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

	/*
     * [최종결제요청 페이지(STEP2-2)]
	 *
	 * 매뉴얼 "5.1. XPay 결제 요청 페이지 개발"의 "단계 5. 최종 결제 요청 및 요청 결과 처리" 참조
     *
     * LG유플러스으로 부터 내려받은 LGD_PAYKEY(인증Key)를 가지고 최종 결제요청.(파라미터 전달시 POST를 사용하세요)
     */

	$configPath = $_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom"; //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf,/conf/mall.conf") 위치 지정. 

    /*
     *************************************************
     * 1.최종결제 요청 - BEGIN
     *  (단, 최종 금액체크를 원하시는 경우 금액체크 부분 주석을 제거 하시면 됩니다.)
     *************************************************
     */
    $CST_PLATFORM               = $_POST["CST_PLATFORM"];
    $CST_MID                    = $_POST["CST_MID"];
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
    $LGD_PAYKEY                 = $_POST["LGD_PAYKEY"];

    require_once($_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom/XPayClient.php");

	// (1) XpayClient의 사용을 위한 xpay 객체 생성
	// (2) Init: XPayClient 초기화(환경설정 파일 로드) 
	// configPath: 설정파일
	// CST_PLATFORM: - test, service 값에 따라 lgdacom.conf의 test_url(test) 또는 url(srvice) 사용
	//				- test, service 값에 따라 테스트용 또는 서비스용 아이디 생성
    $xpay = &new XPayClient($configPath, $CST_PLATFORM);
	
	// (3) Init_TX: 메모리에 mall.conf, lgdacom.conf 할당 및 트랜잭션의 고유한 키 TXID 생성
	$xpay->Init_TX($LGD_MID);    
    $xpay->Set("LGD_TXNAME", "PaymentByKey");
    $xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);
    
    //금액을 체크하시기 원하는 경우 아래 주석을 풀어서 이용하십시요.
	//$DB_AMOUNT = "DB나 세션에서 가져온 금액"; //반드시 위변조가 불가능한 곳(DB나 세션)에서 금액을 가져오십시요.
	//$xpay->Set("LGD_AMOUNTCHECKYN", "Y");
	//$xpay->Set("LGD_AMOUNT", $DB_AMOUNT);
	    
    /*
     *************************************************
     * 1.최종결제 요청(수정하지 마세요) - END
     *************************************************
     */

    /*
     * 2. 최종결제 요청 결과처리
     *
     * 최종 결제요청 결과 리턴 파라미터는 연동메뉴얼을 참고하시기 바랍니다.
     */
	// (4) TX: lgdacom.conf에 설정된 URL로 소켓 통신하여 최종 인증요청, 결과값으로 true, false 리턴
    if ($xpay->TX()) {
        //1)결제결과 화면처리(성공,실패 결과 처리를 하시기 바랍니다.)
/*
        echo "결제요청이 완료되었습니다.  <br>";
        echo "TX 통신 응답코드 = " . $xpay->Response_Code() . "<br>";		//통신 응답코드("0000" 일 때 통신 성공)
        echo "TX 통신 응답메시지 = " . $xpay->Response_Msg() . "<p>";
            
        echo "거래번호 : " . $xpay->Response("LGD_TID",0) . "<br>";
        echo "상점아이디 : " . $xpay->Response("LGD_MID",0) . "<br>";
        echo "상점주문번호 : " . $xpay->Response("LGD_OID",0) . "<br>";
        echo "결제금액 : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
        echo "결과코드 : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";	//LGD_RESPCODE 가 반드시 "0000" 일때만 결제 성공, 그 외는 모두 실패
        echo "결과메세지 : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
            
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        echo "<p>";
*/
        
		// (5) DB에 요청 결과 처리
        if( "0000" == $xpay->Response_Code() ) {
			//통신상의 문제가 없을시
         	//최종결제요청 결과 성공 DB처리(LGD_RESPCODE 값에 따라 결제가 성공인지, 실패인지 DB처리)
           	//echo "최종결제요청 결과 성공 DB처리하시기 바랍니다.<br>";

            //최종결제요청 결과를 DB처리합니다. (결제성공 또는 실패 모두 DB처리 가능)
			$pay_query		= "INSERT INTO ".$_gl['payment_info_table']."(LGD_RESPCODE, LGD_RESPMSG, LGD_MID, LGD_OID, LGD_AMOUNT, LGD_TID, LGD_PAYTYPE, LGD_PAYDATE, LGD_HASHDATA, LGD_TIMESTAMP, LGD_BUYER, LGD_PRODUCTINFO, LGD_BUYERID, LGD_BUYERADDRESS, LGD_BUYERPHONE, LGD_BUYEREMAIL, LGD_PRODUCTCODE, LGD_RECEIVER, LGD_RECEIVERPHONE, LGD_DELIVERYINFO, LGD_FINANCECODE, LGD_FINANCENAME, LGD_FINANCEAUTHNUM, LGD_ESCROWYN, LGD_CASHRECEIPTNUM, LGD_CASHRECEIPTSELFYN, LGD_CASHRECEIPTKIND, LGD_CARDNUM, LGD_CARDINSTALLMONTH, LGD_CARDNOINTYN, LGD_AFFILIATECODE, LGD_CARDGUBUN1, LGD_CARDGUBUN2, LGD_CARDACQUIRER, LGD_PCANCELFLAG, LGD_PCANCELSTR, LGD_TRANSAMOUNT, LGD_EXCHANGERATE, LGD_DISCOUNTUSEYN, LGD_DISCOUNTUSEAMOUNT, LGD_ACCOUNTNUM, LGD_ACCOUNTOWNER, LGD_PAYER, LGD_CASTAMOUNT, LGD_CASCAMOUNT, LGD_CASFLAG, LGD_CASSEQNO, LGD_SAOWNER, LGD_TELNO, LGD_OCBAMOUNT, LGD_OCBSAVEPOINT, LGD_OCBTOTALPOINT, LGD_OCBUSABLEPOINT, LGD_OCBTID) values('".$xpay->Response_Code()."','".iconv("EUC-KR","UTF-8",$xpay->Response_Msg())."','".$xpay->Response("LGD_MID",0)."','".$xpay->Response("LGD_OID",0)."','".$xpay->Response("LGD_AMOUNT",0)."','".$xpay->Response("LGD_TID",0)."','".$xpay->Response("LGD_PAYTYPE",0)."','".$xpay->Response("LGD_PAYDATE",0)."','".$xpay->Response("LGD_HASHDATA",0)."','".$xpay->Response("LGD_TIMESTAMP",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYER",0))."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_PRODUCTINFO",0))."','".$xpay->Response("LGD_BUYERID",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYERADDRESS",0))."','".$xpay->Response("LGD_BUYERPHONE",0)."','".$xpay->Response("LGD_BUYEREMAIL",0)."','".$xpay->Response("LGD_PRODUCTCODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_RECEIVER",0))."','".$xpay->Response("LGD_RECEIVERPHONE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_DELIVERYINFO",0))."','".$xpay->Response("LGD_FINANCECODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_FINANCENAME",0))."','".$xpay->Response("LGD_FINANCEAUTHNUM",0)."','".$xpay->Response("LGD_ESCROWYN",0)."','".$xpay->Response("LGD_CASHRECEIPTNUM",0)."','".$xpay->Response("LGD_CASHRECEIPTSELFYN",0)."','".$xpay->Response("LGD_CASHRECEIPTKIND",0)."','".$xpay->Response("LGD_CARDNUM",0)."','".$xpay->Response("LGD_CARDINSTALLMONTH",0)."','".$xpay->Response("LGD_CARDNOINTYN",0)."','".$xpay->Response("LGD_AFFILIATECODE",0)."','".$xpay->Response("LGD_CARDGUBUN1",0)."','".$xpay->Response("LGD_CARDGUBUN2",0)."','".$xpay->Response("LGD_CARDACQUIRER",0)."','".$xpay->Response("LGD_PCANCELFLAG",0)."','".$xpay->Response("LGD_PCANCELSTR",0)."','".$xpay->Response("LGD_TRANSAMOUNT",0)."','".$xpay->Response("LGD_EXCHANGERATE",0)."','".$xpay->Response("LGD_DISCOUNTUSEYN",0)."','".$xpay->Response("LGD_DISCOUNTUSEAMOUNT",0)."','".$xpay->Response("LGD_ACCOUNTNUM",0)."','".$xpay->Response("LGD_ACCOUNTOWNER",0)."','".$xpay->Response("LGD_PAYER",0)."','".$xpay->Response("LGD_CASTAMOUNT",0)."','".$xpay->Response("LGD_CASCAMOUNT",0)."','".$xpay->Response("LGD_CASFLAG",0)."','".$xpay->Response("LGD_CASSEQNO",0)."','".$xpay->Response("LGD_SAOWNER",0)."','".$xpay->Response("LGD_TELNO",0)."','".$xpay->Response("LGD_OCBAMOUNT",0)."','".$xpay->Response("LGD_OCBSAVEPOINT",0)."','".$xpay->Response("LGD_OCBTOTALPOINT",0)."','".$xpay->Response("LGD_OCBUSABLEPOINT",0)."','".$xpay->Response("LGD_OCBTID",0)."')";
			$pay_result 		= mysqli_query($my_db, $pay_query);

			if ($pay_result)
			{
				//상점내 DB에 어떠한 이유로 처리를 하지 못한경우 false로 변경해 주세요.
				$isDBOK = true; 
			}else{
				$isDBOK = false; 
			}
          	if( !$isDBOK ) {
           		echo "<p>";
           		$xpay->Rollback("상점 DB처리 실패로 인하여 Rollback 처리 [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
            		
                echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br>";
                echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
            		
                if( "0000" == $xpay->Response_Code() ) {
                  	echo "자동취소가 정상적으로 완료 되었습니다.<br>";
                }else{
          			echo "자동취소가 정상적으로 처리되지 않았습니다.<br>";
                }
          	}            	
        }else{
          	//통신상의 문제 발생(최종결제요청 결과 실패 DB처리)
         	echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.111<br>";            	            
        }
    }else {
        //2)API 요청실패 화면처리
        echo "결제요청이 실패하였습니다.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //최종결제요청 결과 실패 DB처리
        echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.222<br>";            	                        
    }
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
                <p class="cate_title"><img src="images/cate_title_orderC.png" alt="주문완료"></p>
              </div>
              <div class="block_title alignC">
                <h3>고객님의 주문이 정상적으로 접수되었습니다.</h3>
                <p><?=iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYER",0))?>님께서 주문하신 제품이 접수되었습니다. 주문내역 및 배송정보는 <span>주문/배송조회</span>에서 확인할 수 있습니다.</p>
              </div>
            </div>
            <div class="area_main_middle nopadd noborder">
              <div class="form_header clearfix">
                <div class="lt_float">
                  <h2>주문자 정보</h2>
                </div>
              </div>
              <div class="table_block custom">
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문번호</p>
                  </div>
                  <div class="block_col">
                    <p>12323234234</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문하신분</p>
                  </div>
                  <div class="block_col">
                    <p>양선혜</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>휴대폰</p>
                  </div>
                  <div class="block_col">
                    <p>010-2515-4373</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제방법</p>
                  </div>
                  <div class="block_col">
                    <p>신용카드</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제금액</p>
                  </div>
                  <div class="block_col">
                    <p>12,000원</p>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>배송 정보</h2>
                  </div>
                </div>
                <div class="table_block custom">
                  <div class="block_row">
                    <div class="block_col head">
                      <p>받으시는분</p>
                    </div>
                    <div class="block_col">
                      <p>양선혜</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>주소</p>
                    </div>
                    <div class="block_col">
                      <p>[137-844] 서울특별시 서초구 방배동 931-9 2층</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>휴대폰</p>
                    </div>
                    <div class="block_col">
                      <p>010-2515-4373</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>배송메시지</p>
                    </div>
                    <div class="block_col">
                      <p>경비실에 맡겨주세요</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table_block mt75 borderT">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th>상품정보</th>
                      <th>판매가격</th>
                      <th>수량</th>
                      <th>합계</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="./images/order_list_img1.png" alt="주문상품1">
                        </div>
                        <div class="info_txt">
                          <h3>실용적인 사이즈의 머그컵</h3>
                          <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                        </div>
                      </td>
                      <td class="price">20,000</td>
                      <td class="count">
                        <input type="text" name="select_amount" id="buy_cnt" value="1">
                        <span class="amount_btn">
                          <img src="./images/polygon_double.png" usemap="#amount">
                          <map name="amount" id="amount">
                            <area shape="rect" coords="0,0,9,9" href="#" onclick="amount_change('up');return false;";>
                            <area shape="rect" coords="0,10,9,19" href="#" onclick="amount_change('down');return false;";>
                          </map>
                        </span>
                      </td>
                      <td class="total">20,000</td>
                    </tr>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="./images/order_list_img1.png" alt="주문상품1">
                        </div>
                        <div class="info_txt">
                          <h3>실용적인 사이즈의 머그컵</h3>
                          <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                        </div>
                      </td>
                      <td class="price">20,000</td>
                      <td class="count">
                        <input type="text" name="select_amount" id="buy_cnt" value="1">
                        <span class="amount_btn">
                          <img src="./images/polygon_double.png" usemap="#amount">
                          <map name="amount" id="amount">
                            <area shape="rect" coords="0,0,9,9" href="#" onclick="amount_change('up');return false;";>
                            <area shape="rect" coords="0,10,9,19" href="#" onclick="amount_change('down');return false;";>
                          </map>
                        </span>
                      </td>
                      <td class="total">20,000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="block_order_price">
                <div class="inner clearfix">
                  <div class="price_block">
                    <h2>총 주문 금액</h2>
                  </div>
                  <div class="charImg">
                    <span class="bar1 long"></span>
                  </div>
                  <div class="price_block">
                    <h3>총 주문금액</h3>
                    <h3 class="total_order">80,000원</h3>
                  </div>
                  <div class="charImg">
                    <img src="./images/spec_plus.png">
                  </div>
                  <div class="price_block">
                    <h3>배송비</h3>
                    <h3 class="shipping">2,500원</h3>
                  </div>
                  <div class="charImg">
                    <img src="./images/spec_equal.png">
                  </div>
                  <div class="price_block">
                    <h3>총 결제금액</h3>
                    <h3 class="total_payment">82,500원</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="area_main_bottom">

            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="./images/side_full_img1.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC"><img src="./images/customer_center.png" alt="고객센터"></span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon"><img src="./images/about_chon.png" alt="about 촌의감각"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_store.png" alt="입점문의"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_partnership.png" alt="제휴문의"></span></a>
              <a href="#"><span class="sugg last"><img src="./images/heavy_buying.png" alt="대량구매"></span></a>
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
  </body>
</html>
