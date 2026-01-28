<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>책 대여 유저 조회 (표)</title>
  <link rel="stylesheet" href="./style/style.css">
</head>

<body>
  <?php
  require_once './header.php';
  $user = db::fetchAll("select u.*, ub.*, b.title, u.idx as user_id
    from user u inner join user_book ub
    on u.idx = ub.user_idx
    inner join book b on ub.book_idx = b.idx");
  ?>
  <main class="view-box">
    <header>
      <div>
        <h1>책 대여 유저 조회 (표)</h1>
        <p>표로 책 대여 유저를 조회하세요.</p>
      </div>
    </header>
    <div class="btn-box">
      <button onclick="sort('반납됨')" class="white-btn btn">반납됨</button>
      <button onclick="sort('대여중')" class="white-btn btn">대여중</button>
    </div>
    <table class="nomal-table">
      <thead>
        <th>상태</th>
        <th>닉네임</th>
        <th>아이디</th>
        <th>책 이름</th>
        <th>대여일</th>
        <th>반납 기한</th>
        <th>관리</th>
      </thead>
      <tbody>

      </tbody>
    </table>
    <div class="table-control">
      <span class="left white-btn btn">&lt;</span>
      <p class="page-info"></p>
      <span class="right white-btn btn">&gt;</span>
    </div>
  </main>
</body>
<script>
  const userData = <?= json_encode($user) ?>;
  const tableBody = document.querySelector("table tbody");
  const limit = 5;
  const pageInfo = document.querySelector(".page-info");
  const btns = document.querySelectorAll(".btn-box button");

  let pageIndex = 0; // 현재 페이지
  let data = [...userData];

  btns.forEach(btn => {
    btn.addEventListener("click", () => {
      btns.forEach(e => e.classList.add("white-btn"));
      btn.classList.remove("white-btn");
    })
  })

  function sort(val) {
    data = val == "대여중" ? userData.filter(n => n.is_rental == 1) : userData.filter(n => n.is_rental == 0);
    renderUser();
  }

  function renderUser() {
    tableBody.innerHTML = data.slice(pageIndex * limit, (pageIndex + 1) * limit).map(n =>
      `
      <tr>
        <td>
          <span class="user-type" style="background-color: ${n.is_rental == '1' ? "#9cdc12" : "#ff7474"};">${n.is_rental == '1' ? "대여중" : "반납됨"}</span>
        </td>
        <td>${n.name}</td>
        <td>${n.id}</td>
        <td>${n.title}</td>
        <td>${n.rental_date}</td>
        <td>${n.period}일</td>
        <td>
        <a href="profile.php?idx=${n.user_id}" class="btn white-btn">프로필 보기</a>
        </td>
      </tr>
      `).join('');
    const totalPage = Math.ceil(data.length / limit) || 1;
    pageInfo.textContent = `${pageIndex + 1} / ${totalPage}`;
  }

  function changePage(page) {
    const maxPage = Math.ceil(data.length / limit) - 1;
    if ((page < 0 && pageIndex <= 0) || (page > 0 && pageIndex >= maxPage)) return;

    pageIndex += page;
    renderUser();
  }

  document.querySelector(".right").onclick = () => changePage(1);
  document.querySelector(".left").onclick = () => changePage(-1);

  renderUser();
</script>

</html>