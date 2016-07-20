<?
	include_once "./header.php";
?>
  <body>
    <h2>카테고리 입력/수정</h2>
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
            </select>
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
            </select>
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
            </select>
          </td>
          <td id="cate3_btn_td">
            <a href="#">추가</a>
          </td>
        </tr>
        <tr>
          <td>PC쇼핑몰 노출여부</td>
          <td>
            <input type="radio" name="cate_pcYN" value="PC_Y">노출함
            <input type="radio" name="cate_pcYN" value="PC_N">노출 안함
          </td>
        </tr>
        <tr>
          <td>모바일 쇼핑몰 노출여부</td>
          <td>
            <input type="radio" name="cate_mobileYN" value="MOBILE_Y">노출함
            <input type="radio" name="cate_mobileYN" value="MOBILE_N">노출 안함
          </td>
        </tr>
        <tr>
          <td>접근 권한</td>
          <td>
            <input type="radio" name="cate_accessYN" value="ACCESS_ALL">전체(회원 + 비회원)
            <input type="radio" name="cate_accessYN" value="ACCESS_MEMBER">회원전용(비회원 제외)
            <input type="radio" name="cate_accessYN" value="ACCESS_SPECIFIC">특정 회원등급
          </td>
        </tr>
        <tr>
          <td id="submit_btn" colspan="2">
            <a href="#">확인</a>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
