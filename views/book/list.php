<?php
$user = $_SESSION["ss"];
$store = db::fetch("select * from stores where admin_idx = '$user->idx'");
$books = db::fetchAll("select * from book where store_idx = '$store->idx'");
?>
<main class="view-box">
  <header>
    <div>
      <h1><?= $store->title ?> 책 관리</h1>
      <p><?= $store->title ?>의 책을 조회, 등록, 수정, 삭제하세요.</p>
    </div>
    <form action="/bookAdd" method="post">
      <input type="hidden" name="store_idx" value="<?= $store->idx ?>">
      <button class="btn">+ <span>책 등록</span></button>
    </form>
  </header>
  <div class="books">
    <?php foreach ($books as $book) { ?>
      <div class="book">
        <div class="book-img">
          <img src="<?= $book->img ?>" alt="<?= $book->title ?>">
        </div>
        <div class="book-content">
          <h3 class="book-title"><?= $book->title ?></h3>
          <p class="book-des"><?= $book->des ?></p>
          <p class="book-stock">재고: <?= $book->count ?>/<?= $book->stock ?></p>
        </div>
        <form class="book-btns" method="post">
          <input type="hidden" name="idx" value="<?= $book->idx ?>">
          <button formaction="/bookEdit" class="btn">수정</button>
          <button onclick="return confirm('정말 삭제하시겠습니까?')" class="red-btn btn" formaction="/bookDelete">삭제</button>
        </form>
      </div>
      <?php } ?>
  </div>
</main>