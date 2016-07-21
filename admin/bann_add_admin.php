<?
    include_once "./header.php";
?>
  <body>
  <h1>배너 등록</h1>
  <hr>
  <h3>기본 설정</h3>
  <div>
    <table class="table table-bordered">
      <tr>
        <td class="active">기기 구분</td>
        <td>
          <select id="device_distinct">
            <option value="PC">PC</option>
            <option value="MOBILE">MOBILE</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="active">배너 제목</td>
        <td><input id="banner_title" type="text" size="30"></td>
      </tr>
      <tr>
        <td class="active">배너 구분</td>
        <td>
          <select id="banner_type">
            <option value="move_main">메인 슬라이드</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="active">노출 여부</td>
        <td>
          <input type="radio" name="banner_show" value="show" checked>노출
          <input type="radio" name="banner_show" value="hide">미노출
        </td>
      </tr>
      <tr>
        <td class="active">슬라이드 노출 순서</td>
        <td>
          <select id="banner_show_order">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="active">전환 속도 선택</td>
        <td>
          <select id="slide_speed">
            <option value="normal">보통</option>
            <option value="fast">빠르게</option>
            <option value="slow">느리게</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="active">전환시간 설정</td>
        <td>
          <select id="slide_interval">
            <option value="1">1초</option>
            <option value="2">2초</option>
            <option value="3"selected>3초</option>
            <option value="4">4초</option>
            <option value="5">5초</option>
            <option value="6">6초</option>
            <option value="7">7초</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="active">효과 선택</td>
        <td>
          <input type="radio" name="slide_effect" value="slide" checked>슬라이드
          <input type="radio" name="slide_effect" value="fade">페이드
        </td>
      </tr>
    </table>
  </div>
  <div>
  <br/>
  <h3>이미지 설정</h3>
    <table class="table table-bordered">
      <tr>
        <td class="active">이미지</td>
        <td>
          <input type="file"><br/>
          링크 주소 <input type="text" size="20">
          <select id="link_ref">
            <option value="self">현재창</option>
            <option value="blank">새창</option>
          </select>
          <br/>
          이미지 설명 <input id="slide_img_alt" type="text" size="20">
        </td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input id="banner_submit" type="button" value="등록">
    </div>
  </div>
  </body>
</html>


