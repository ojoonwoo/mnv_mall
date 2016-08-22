<?
/*
*
*	php function 
*
*/


// 상품 코드 테이블에서 새로운 상품코드 가져오기
function create_goodscode()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT goods_code FROM ".$_gl['goodscode_info_table']." WHERE useYN='N' limit 1";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	$query2		= "UPDATE ".$_gl['goodscode_info_table']." SET useYN='Y' WHERE goods_code='".$data['goods_code']."'";
	$result2		= mysqli_query($my_db, $query2);

	return $data['goods_code'];
}

// 해당 상품정보 가져오기 (goods_code)
function select_goods_info($goodscode)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goodscode."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 해당 카테고리 정보 가져오기 (idx)
function select_category_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

/*
* 메일발송 함수
* $EMAIL : 보내는 사람 메일 주소
* $NAME : 보내는 사람 이름
* $SUBJECT : 메일 제목
* $CONTENT : 메일 내용
* $MAILTO : 받는 사람 메일 주소
* $MAILTONAME : 받는 사람 이름 
*/
function sendMail($EMAIL, $NAME, $SUBJECT, $CONTENT, $MAILTO, $MAILTONAME){
	$mail             = new PHPMailer();
	$body             = $CONTENT;

	$mail->IsSMTP(); // telling the class to use SMTP
	// $mail->Host 	  = "www.coolio.so"; // SMTP server
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->CharSet    = "utf-8";
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "ojoonwoo2@gmail.com";             // GMAIL username
	$mail->Password   = "5wnsdn23";              // GMAIL password

	$mail->SetFrom($EMAIL, $NAME);

	$mail->AddReplyTo($EMAIL, $NAME);

	$mail->Subject    = $SUBJECT;

	$mail->MsgHTML($body);

	$address = $MAILTO;
	$mail->AddAddress($address, $MAILTONAME);

	// if(!$mail->Send()) {
	// 	echo "Mailer Error: " . $mail->ErrorInfo;
	// } else {
	// 	echo "Message sent!";
	// }
	$mail->Send();
}

// 해당 거래처 정보 가져오기 (idx)
function select_purchasing_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['purchasing_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

?>