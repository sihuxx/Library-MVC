<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>책 관리</title>
  <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <?php
    require_once './header.php';
    $user = $_SESSION["ss"];
    $store = db::fetch("select * from stores where admin_idx = '$user->idx'");
    $books = db::fetchAll("select * from book where store_idx = '$store->idx'");
  ?>
  <main class="view-box">
    <header>
      <div>
        <h1><?=$store->title?> 책 관리</h1>
        <p><?=$store->title?>의 책을 조회, 등록, 수정, 삭제하세요.</p>
      </div>
      <a href="./bookAdd.php?idx=<?=$store->idx?>">+ <span>책 등록</span></a>
    </header>
    <div class="books">
      <?php foreach($books as $book) { ?>
        <div class="book">
        <div class="book-img">
          <img src="<?=$book->img?>" alt="<?=$book->title?>">
        </div>
        <div class="book-content">
          <h3 class="book-title"><?=$book->title?></h3>
          <p class="book-des"><?=$book->des?></p>
          <p class="book-stock">재고: <?=$book->count?>/<?=$book->stock?></p>
        </div>
        <div class="book-btns">
          <a href="./bookEdit.php?idx=<?=$book->idx?>" class="btn">수정</a>
          <a href="./bookDeleteAction.php?idx=<?=$book->idx?>" onclick="return confirm('정말 삭제하시겠습니까?')" class="btn red-btn">삭제</a>
        </div>
      </div>
      <?php } ?>
    </div>
  </main>
</body>
</html>