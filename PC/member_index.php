<?
include_once "../header.php";
?>
<body>
<script type="text/javascript">
    function go_page(action, mb_data){
        if(action=='register') {
            location.href="./join_form.php";
        }else if(action=='modify'){
            // console.log(mb_data);
            var mb_addr_preV = mb_data['mb_address1'];
            var form = $('<form></form>');
            form.attr('action', './modify_form.php');
            form.attr('method', 'post');
            form.appendTo('#dataHouse');
            var mb_id = $("<input type='hidden' value="+mb_data['mb_id']+" name='mb_id'>");
            var mb_name = $("<input type='hidden' value="+mb_data['mb_name']+" name='mb_name'>");
            var mb_question = $("<input type='hidden' value="+mb_data['mb_question']+" name='mb_question'>");
            var mb_answer = $("<input type='hidden' value="+mb_data['mb_answer']+" name='mb_answer'>");
            var mb_handphone = $("<input type='hidden' value="+mb_data['mb_handphone']+" name='mb_handphone'>");
            var mb_telphone = $("<input type='hidden' value="+mb_data['mb_telphone']+" name='mb_telphone'>");
            var mb_smsYN = $("<input type='hidden' value="+mb_data['mb_smsYN']+" name='mb_smsYN'>");
            var mb_email = $("<input type='hidden' value="+mb_data['mb_email']+" name='mb_email'>");
            var mb_emailYN = $("<input type='hidden' value="+mb_data['mb_emailYN']+" name='mb_emailYN'>");
            var mb_address1 = $("<input type='hidden' name='mb_address1'>");
            var mb_addr_tmp = $(mb_address1).attr('value', mb_addr_preV);
            var mb_address2 = $("<input type='hidden' value="+mb_data['mb_address2']+" name='mb_address2'>");
            var mb_zipcode = $("<input type='hidden' value="+mb_data['mb_zipcode']+" name='mb_zipcode'>");
            var mb_birth = $("<input type='hidden' value="+mb_data['mb_birth']+" name='mb_birth'>");
            var mb_gender = $("<input type='hidden' value="+mb_data['mb_gender']+" name='mb_gender'>");
            form.append(mb_id);
            form.append(mb_name);
            form.append(mb_question);
            form.append(mb_answer);
            form.append(mb_handphone);
            form.append(mb_telphone);
            form.append(mb_smsYN);
            form.append(mb_email);
            form.append(mb_emailYN);
            form.append(mb_addr_tmp);
            form.append(mb_address2);
            form.append(mb_zipcode);
            form.append(mb_birth);
            form.append(mb_gender);
            form.submit();
        }else{
            alert("미구현");
        }
    }
    function check_member() {
        var m_id = $('#userid');
        var m_pw = $('#password');

        $.ajax({
            method: 'POST',
            url: '../main_exec.php',
            data: {
            exec            : "member_check",
            m_id            : m_id.val(),
            m_pw            : m_pw.val()
            },
            success: function(res){
                var info_array = $.parseJSON(res);
                if(info_array['mb_id']){ // 정보 확인 완료
                    alert("확인 완료");
                    go_page('modify', info_array);
                }else if(info_array=='P'){ // 비밀번호가 틀림
                    alert("비밀번호가 맞지않습니다.");
                    m_pw.val('').focus();
                }else if(info_array=='N'){ // 없는 아이디일 경우
                    alert("등록되지 않은 아이디입니다.");
                    m_id.val('').focus();
                }else{
                    alert("오류입니다. 다시 시도해주세요.");
                }
            }
        });
    }
</script>
<h3>회원 가입</h3>
<button type="button" onclick="go_page('register');return false;">가입</button>
<br><br>
<h3>회원 정보 수정</h3>
<strong>아이디 :</strong> <input type="text" id="userid" name="userid">
<br><br>
<strong>비밀번호 :</strong> <input type="password" id="password" name="password">
<br><br>
<button type="button" onclick="check_member();return false;">수정</button>
</body>
</html>