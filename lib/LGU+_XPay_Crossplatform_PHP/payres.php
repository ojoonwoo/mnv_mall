<?php
	session_save_path($_SERVER['DOCUMENT_ROOT']."/session");
	ini_set("session.cache_expire", 180); // 세션 유효시간 : 분
	ini_set("session.gc_maxlifetime", 180); // 세션 가비지 컬렉션(로그인시 세션지속 시간) :
	session_start();
	header("Content-Type: text/html; charset=UTF-8");

	include_once $_SERVER['DOCUMENT_ROOT']."/include/global.php"; 				//변수정보
	include_once $_SERVER['DOCUMENT_ROOT']."/include/function.php"; 				//함수정보
	include_once $_SERVER['DOCUMENT_ROOT']."/include/dbi.php"; 					//DB 연결정보
	include_once $_SERVER['DOCUMENT_ROOT']."/include/dir.php"; 					//경로정보

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
        
		// (5) DB에 요청 결과 처리
        if( "0000" == $xpay->Response_Code() ) {
			//통신상의 문제가 없을시
         	//최종결제요청 결과 성공 DB처리(LGD_RESPCODE 값에 따라 결제가 성공인지, 실패인지 DB처리)
           	//echo "최종결제요청 결과 성공 DB처리하시기 바랍니다.<br>";

            //최종결제요청 결과를 DB처리합니다. (결제성공 또는 실패 모두 DB처리 가능)
			$pay_query		= "INSERT INTO ".$_gl['payment_info_table']."(LGD_RESPCODE, LGD_RESPMSG, LGD_MID, LGD_OID, LGD_AMOUNT, LGD_TID, LGD_PAYTYPE, LGD_PAYDATE, LGD_HASHDATA, LGD_TIMESTAMP, LGD_BUYER, LGD_PRODUCTINFO, LGD_BUYERID, LGD_BUYERADDRESS, LGD_BUYERPHONE, LGD_BUYEREMAIL, LGD_PRODUCTCODE, LGD_RECEIVER, LGD_RECEIVERPHONE, LGD_DELIVERYINFO, LGD_FINANCECODE, LGD_FINANCENAME, LGD_FINANCEAUTHNUM, LGD_ESCROWYN, LGD_CASHRECEIPTNUM, LGD_CASHRECEIPTSELFYN, LGD_CASHRECEIPTKIND, LGD_CARDNUM, LGD_CARDINSTALLMONTH, LGD_CARDNOINTYN, LGD_AFFILIATECODE, LGD_CARDGUBUN1, LGD_CARDGUBUN2, LGD_CARDACQUIRER, LGD_PCANCELFLAG, LGD_PCANCELSTR, LGD_TRANSAMOUNT, LGD_EXCHANGERATE, LGD_DISCOUNTUSEYN, LGD_DISCOUNTUSEAMOUNT, LGD_ACCOUNTNUM, LGD_ACCOUNTOWNER, LGD_PAYER, LGD_CASTAMOUNT, LGD_CASCAMOUNT, LGD_CASFLAG, LGD_CASSEQNO, LGD_SAOWNER, LGD_TELNO, LGD_OCBAMOUNT, LGD_OCBSAVEPOINT, LGD_OCBTOTALPOINT, LGD_OCBUSABLEPOINT, LGD_OCBTID) values('".$xpay->Response_Code()."','".iconv("EUC-KR","UTF-8",$xpay->Response_Msg())."','".$xpay->Response("LGD_MID",0)."','".$xpay->Response("LGD_OID",0)."','".$xpay->Response("LGD_AMOUNT",0)."','".$xpay->Response("LGD_TID",0)."','".$xpay->Response("LGD_PAYTYPE",0)."','".$xpay->Response("LGD_PAYDATE",0)."','".$xpay->Response("LGD_HASHDATA",0)."','".$xpay->Response("LGD_TIMESTAMP",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYER",0))."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_PRODUCTINFO",0))."','".$xpay->Response("LGD_BUYERID",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYERADDRESS",0))."','".$xpay->Response("LGD_BUYERPHONE",0)."','".$xpay->Response("LGD_BUYEREMAIL",0)."','".$xpay->Response("LGD_PRODUCTCODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_RECEIVER",0))."','".$xpay->Response("LGD_RECEIVERPHONE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_DELIVERYINFO",0))."','".$xpay->Response("LGD_FINANCECODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_FINANCENAME",0))."','".$xpay->Response("LGD_FINANCEAUTHNUM",0)."','".$xpay->Response("LGD_ESCROWYN",0)."','".$xpay->Response("LGD_CASHRECEIPTNUM",0)."','".$xpay->Response("LGD_CASHRECEIPTSELFYN",0)."','".$xpay->Response("LGD_CASHRECEIPTKIND",0)."','".$xpay->Response("LGD_CARDNUM",0)."','".$xpay->Response("LGD_CARDINSTALLMONTH",0)."','".$xpay->Response("LGD_CARDNOINTYN",0)."','".$xpay->Response("LGD_AFFILIATECODE",0)."','".$xpay->Response("LGD_CARDGUBUN1",0)."','".$xpay->Response("LGD_CARDGUBUN2",0)."','".$xpay->Response("LGD_CARDACQUIRER",0)."','".$xpay->Response("LGD_PCANCELFLAG",0)."','".$xpay->Response("LGD_PCANCELSTR",0)."','".$xpay->Response("LGD_TRANSAMOUNT",0)."','".$xpay->Response("LGD_EXCHANGERATE",0)."','".$xpay->Response("LGD_DISCOUNTUSEYN",0)."','".$xpay->Response("LGD_DISCOUNTUSEAMOUNT",0)."','".$xpay->Response("LGD_ACCOUNTNUM",0)."','".$xpay->Response("LGD_ACCOUNTOWNER",0)."','".$xpay->Response("LGD_PAYER",0)."','".$xpay->Response("LGD_CASTAMOUNT",0)."','".$xpay->Response("LGD_CASCAMOUNT",0)."','".$xpay->Response("LGD_CASFLAG",0)."','".$xpay->Response("LGD_CASSEQNO",0)."','".$xpay->Response("LGD_SAOWNER",0)."','".$xpay->Response("LGD_TELNO",0)."','".$xpay->Response("LGD_OCBAMOUNT",0)."','".$xpay->Response("LGD_OCBSAVEPOINT",0)."','".$xpay->Response("LGD_OCBTOTALPOINT",0)."','".$xpay->Response("LGD_OCBUSABLEPOINT",0)."','".$xpay->Response("LGD_OCBTID",0)."')";
			$pay_result 		= mysqli_query($my_db, $pay_query);

print_r($pay_query);

			//상점내 DB에 어떠한 이유로 처리를 하지 못한경우 false로 변경해 주세요.
          	$isDBOK = true; 
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
         	echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.<br>";            	            
        }
    }else {
        //2)API 요청실패 화면처리
        echo "결제요청이 실패하였습니다.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //최종결제요청 결과 실패 DB처리
        echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.<br>";            	                        
    }
?>
