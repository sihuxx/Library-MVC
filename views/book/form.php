<?php
$idx = $_GET["idx"] ?? null;
$book = null;

if ($idx) {
  $book = db::fetch("select * from book where idx = '$idx'");
}

$isEdit = !empty($book);
$url = $isEdit ? "/bookEdit" : "/bookAdd";
$text = $isEdit ? "책 수정" : "책 등록";
$required = $isEdit ? "required" : '';
?>
<main class="form-box">
  <form action="<?=$url?>" method="post" enctype="multipart/form-data">
    <h1 class="form-title"><?= $text ?></h1>
    <input type="hidden" name="idx" value="<?= $idx ?>">
    <div>
      <?php if ($isEdit) { ?>
        <img src="<?= $book->img ?? '' ?>" alt="<?= $book->title ?? '' ?>">
      <?php } ?>
      <label for="file">책 이미지</label>
      <input type="file" name="file" id="file" <?=$required?>>
    </div>
    <div>
      <label for="title">책 이름</label>
      <input type="text" value="<?= $book->title ?? '' ?>" name="title" id="title" placeholder="책 이름을 입력해주세요" required>
    </div>
    <div>
      <label for="des">책 소개</label>
      <input type="text" value="<?= $book->des ?? '' ?>" name="des" id="des" placeholder="책 소개를 입력해주세요" required>
    </div>
    <div>
      <label for="stock">책 재고</label>
      <input type="number" value="<?= $book->stock ?? '' ?>" name="stock" id="stock" placeholder="책 재고를 입력해주세요" required>
    </div>
    <button type="submit"><?= $text ?></button>
  </form>
</main>
</body>

</html>