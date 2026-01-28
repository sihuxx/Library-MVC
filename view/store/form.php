<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>서점 등록</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <?php require_once './header.php' ?>
  <main class="form-box">
    <form action="./storeAddAction.php" method="post" enctype="multipart/form-data">
      <h1 class="form-title">서점 등록</h1>
      <div>
        <label for="file">서점 로고</label>
        <input type="file" name="file" id="file" required>
      </div>
      <div>
        <label for="title">서점 이름</label>
        <input type="text" name="title" id="title" placeholder="서점 이름을 입력해주세요" required>
      </div>
      <div>
        <label for="des">한 줄 소개</label>
        <input type="text" name="des" id="des" placeholder="서점 소개를 입력해주세요" required>
      </div>
      <button type="submit">서점 등록</button>
    </form>
  </main>
</body>
</html>