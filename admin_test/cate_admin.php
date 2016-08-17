<?
	include_once "./header.php";
?>
  <style>
	#category_list  tr td{
		border-bottom: 1px solid black;
		/*border-right: 1px solid black;*/
	}
	#category_list {
		border-collapse: collapse;
	}  
  </style>
  <body>
    <h2>------------------------ 카테고리 입력 ------------------------</h2>
    <div>
      <table>
        <tr>
          <td>카테고리명</td>
          <td>
            <input type="text" id="cate_name">
          </td>
        </tr>
        <tr>
          <td>1차 카테고리</td>
          <td id="cate1_sel_td" style="display:none;">
            <select id="cate_1">
              <option value="">선택하세요</option>
              <option value=""></option>
            </select> *1차 카테고리를 선택하지 않으면 1차 카테고리에 저장이 됩니다.
          </td>
          <td id="cate1_btn_td">
            <a href="#">추가</a>
          </td>
        </tr>
        <tr>
          <td>2차 카테고리</td>
          <td id="cate2_sel_td" style="display:none;">
            <select id="cate_2">
              <option value="">선택하세요</option>
              <option value=""></option>
            </select> *2차 카테고리를 선택하지 않으면 2차 카테고리에 저장이 됩니다.
          </td>
          <td id="cate2_btn_td">
            <a href="#">추가</a>
          </td>
        </tr>
        <tr>
          <td>3차 카테고리</td>
          <td id="cate3_sel_td" style="display:none;">
            <select id="cate_3">
              <option value="">선택하세요</option>
              <option value=""></option>
            </select> *3차 카테고리를 선택하지 않으면 3차 카테고리에 저장이 됩니다.
          </td>
          <td id="cate3_btn_td">
            <a href="#">추가</a>
          </td>
        </tr>
        <tr>
          <td>PC쇼핑몰 노출여부</td>
          <td>
            <input type="radio" name="cate_pcYN" value="Y">노출함
            <input type="radio" name="cate_pcYN" value="N" checked>노출 안함
          </td>
        </tr>
        <tr>
          <td>모바일 쇼핑몰 노출여부</td>
          <td>
            <input type="radio" name="cate_mobileYN" value="Y">노출함
            <input type="radio" name="cate_mobileYN" value="N" checked>노출 안함
          </td>
        </tr>
        <tr>
          <td>접근 권한</td>
          <td>
            <input type="radio" name="cate_accessYN" value="ALL">전체(회원 + 비회원)
            <input type="radio" name="cate_accessYN" value="MEMBER" checked>회원전용(비회원 제외)
            <input type="radio" name="cate_accessYN" value="SPECIFIC">특정 회원등급
            <select id="access_specific">
              <option value="">선택하세요</option>
            </select>
          </td>
        </tr>
        <tr>
          <td id="submit_btn" colspan="2">
            <a href="#">확인</a>
          </td>
        </tr>
      </table>
    </div>
    <h2>------------------------ 카테고리 수정 ------------------------</h2>
    <div>
      <table id="category_list">
        
      </table>
    </div>
  </body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	// 회원 등급 셀렉트박스
	show_select_grade("access_specific");
	// 1번 카테고리 정보
	show_select_cate1("cate_1");
	// 카테고리 리스트
	show_category_list("category_list");
});
</script>