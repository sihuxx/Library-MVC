<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>책 수정</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <?php 
  require_once './header.php';
  $idx = $_GET["idx"];
  $book = db::fetch("select * from book where idx = '$idx'");
   ?>
  <main class="form-box">
    <form action="./bookEditAction.php" method="post" enctype="multipart/form-data">
      <h1 class="form-title">책 수정</h1>
      <div>
        <img src="<?=$book->img?>" alt="<?=$book->title?>">
        <label for="file">책 이미지</label>
        <input type="file" name="file" id="file" required>
      </div>
      <div>
        <label for="title">책 이름</label>
        <input type="text" value="<?=$book->title?>" name="title" id="title" placeholder="책 이름을 입력해주세요" required>
      </div>
      <div>
        <label for="des">책 소개</label>
        <input type="text" value="<?=$book->des?>" name="des" id="des" placeholder="책 소개를 입력해주세요" required>
      </div>
      <div>
        <label for="stock">책 재고</label>
        <input type="number" value="<?=$book->stock?>" name="stock" id="stock" placeholder="책 재고를 입력해주세요" required>
      </div>
      <button type="submit">책 수정</button>
    </form>
  </main>
</body>
</html>