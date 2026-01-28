<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>서점 등록</title>
  <link rel="stylesheet" href="./style/style.css">
</head>

<body>
  <?php
  require_once './header.php';
  $idx = $_GET["idx"];
  $store = db::fetch("select * from stores where idx = '$idx'");
  ?>

  <main class="form-box">
    <form action="./storeEditAction.php" method="post" enctype="multipart/form-data">
      <h1 class="form-title">서점 정보 수정</h1>
      <input type="hidden" name="idx" value="<?=$store->idx?>">
      <div>
        <img src="<?=$store->img?>" alt="<?=$store->title?>">
        <label for="file">서점 로고</label>
        <input type="file" name="file" id="file" required>
      </div>
      <div>
        <label for="title">서점 이름</label>
        <input type="text" name="title" id="title" value="<?=$store->title?>" placeholder="서점 이름을 입력해주세요" required>
      </div>
      <div>
        <label for="des">한 줄 소개</label>
        <input type="text" name="des" id="des" value="<?=$store->des?>" placeholder="서점 소개를 입력해주세요" required>
      </div>
      <button type="submit">서점 수정</button>
    </form>
  </main>
</body>

</html>