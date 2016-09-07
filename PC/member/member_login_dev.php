<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";
?>
<body>
  <h2>LOGIN</h2>
  ID : <input type="text" id="mb_id"><br />
  PASS : <input type="password" id="mb_password"><br />
  <a href="#" id="mb_login">로그인</a><br />
  <a href="#">아이디찾기</a>
  <a href="#">비밀번호찾기</a>
  <a href="#">회원가입</a>

  <h2>비회원 조회</h2>
  이름 : <input type="text" id="nmb_id"><br />
  주문번호 : <input type="password" id="nmb_password"><br />
  <a href="#">로그인</a>

</body>
</html>