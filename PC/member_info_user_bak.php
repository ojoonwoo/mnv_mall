<?
include_once "../header.php";
?>
<body>
<? 
  // print_r($_POST);
  $user_id = preg_replace("/\s+/", "", $_POST['userid']);
  $password = preg_replace("/\s+/", "", $_POST['password']);
  $password_Q = $_POST['password_Q'];
  $password_A = trim($_POST['password_A']);
  $username = preg_replace("/\s+/", "", $_POST['username']);
  $zipcode = $_POST['zipcode'];
  $addr1 = $_POST['addr1'];
  $addr2 = trim($_POST['addr2']);
  $tel1 = $_POST['tel1'];
  $tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
  $tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
  $phone1 = $_POST['phone1'];
  $phone2 = preg_replace("/\s+/", "", $_POST['phone2']);
  $phone3 = preg_replace("/\s+/", "", $_POST['phone3']);
  $smsYN = $_POST['smsYN'];
  $email = preg_replace("/\s+/", "", $_POST['email1']);
  $emailYN = $_POST['emailYN'];
  $birthY = preg_replace("/\s+/", "", $_POST['birthY']);
  $birthM = preg_replace("/\s+/", "", $_POST['birthM']);
  $birthD = preg_replace("/\s+/", "", $_POST['birthD']);
  $gender = $_POST['gender'];
  $type = $_POST['type'];

  if($tel2 == '') {
      $tel = '';
  }else{
      $tel = $tel1 . '-' . $tel2 . '-' . $tel3;
  } 

  $phone = $phone1 . '-' . $phone2 . '-' . $phone3;

  if($birthM !== '' && ($birthM < 10 && strlen($birthM) < 2)) {
    $birthM = "/0".$birthM;
  }else{
    $birthM = "/".$birthM;
  }
  if($birthD !== '' && ($birthD < 10 && strlen($birthD) < 2)) {
    $birthD = "/0".$birthD;
  }else{
    $birthD = "/".$birthD;
  }

  $birth = $birthY . $birthM . $birthD;
  // 등급 수정할것
  $grade = "silver";

  if($type=='register') {

    $insert_query    = "INSERT INTO ".$_gl['member_info_table']."(mb_id, mb_password, mb_question, mb_answer, mb_name, mb_birth, mb_gender, mb_address1, mb_address2, mb_zipcode, mb_telphone, mb_handphone, mb_smsYN, mb_email, mb_emailYN, mb_grade, mb_join_date, mb_join_ipaddr) values('".$user_id."','".$password."','".$password_Q."','".$password_A."','".$username."','".$birth."','".$gender."','".$addr1."','".$addr2."','".$zipcode."','".$tel."','".$phone."','".$smsYN."','".$email."','".$emailYN."','".$grade."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
    $insert_result   = mysqli_query($my_db, $insert_query);


    // result - 메일 발송
    if($insert_result) {
      echo "가입 성공!";

  // 메일발송 시작
      // $nameFrom  = "미니버타이징";
      // $mailFrom = "localhost@localhost.com";
      // $nameTo  = "오준우";
      // $mailTo = "ojoonwoo@gmail.com";
      // // $cc = "참조";
      // // $bcc = "숨은참조";
      // $subject = "test";
      // $content = "test";    

      // $charset = "UTF-8";

      // $nameFrom   = "=?$charset?B?".base64_encode($nameFrom)."?=";
      // $nameTo   = "=?$charset?B?".base64_encode($nameTo)."?=";
      // $subject = "=?$charset?B?".base64_encode($subject)."?=";

      // $header  = "Content-Type: text/html; charset=utf-8\r\n";
      // $header .= "MIME-Version: 1.0\r\n";

      // $header .= "Return-Path: <". $mailFrom .">\r\n";
      // $header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
      // $header .= "Reply-To: <". $mailFrom .">\r\n";
      // // if ($cc)  $header .= "Cc: ". $cc ."\r\n";
      // // if ($bcc) $header .= "Bcc: ". $bcc ."\r\n";

      // $mail_result = mail($mailTo, $subject, $content, $header, $mailFrom);
      
      // // $mailto      = "ojoonwoo@gmail.com";
      // // // $to      = $email;
      // // $subject = "test";
      // // $message = "test";

      // // $mail_result = mail($mailto, $subject, $message);

      // if($mail_result){
      //   echo "mail success";
      // }else{
      //   echo "mail fail";
      //   error_log($mailto, 0);  
      // }
      echo "<script>location.href='./member_index.php';</script>";
      
    }else{
      echo "가입 실패";
      echo "<script>location.href='./member_index.php';</script>";
    }

  }else if($type=='modify') {
    $update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_question='".$password_Q."',mb_answer='".$password_A."',mb_name='".$username."',mb_birth='".$birth."',mb_gender='".$gender."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
    $update_result   = mysqli_query($my_db, $update_query);

    if($update_result) {
      echo "수정 성공!";
      echo "<script>location.href='./member_index.php';</script>";
    }else{
      echo "수정 실패";
      echo "<script>location.href='./member_index.php';</script>";
    }
  }




?>
</body>
</html>