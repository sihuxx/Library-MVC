<?php
$idx = $_POST["idx"] ?? null;
$store = null;

if($idx) {
  $store = db::fetch("select * from stores where idx = '$idx'");
}

$isEdit = !empty($store);
$url = $isEdit ? "/storeUpdate" : "/storeInsert";
$text = $isEdit ? "서점 수정" : "서점 등록";
$required = $isEdit ? "" : 'required';
?>

<main class="form-box">
  <form action="<?= $url ?>" method="post" enctype="multipart/form-data">
    <h1 class="form-title"><?=$text ?></h1>
    <input type="hidden" name="idx" value="<?= $store->idx ?? '' ?>">
    <div>
      <?php if($isEdit) { ?>
        <img src="<?= $store->img ?? '' ?>" alt="<?= $store->title ?? '' ?>">
      <?php } ?>
      <label for="file">서점 로고</label>
      <input type="file" name="file" id="file" <?=$required?>>
    </div>
    <div>
      <label for="title">서점 이름</label>
      <input type="text" name="title" id="title" value="<?= $store->title ?? '' ?>" placeholder="서점 이름을 입력해주세요" required>
    </div>
    <div>
      <label for="des">한 줄 소개</label>
      <input type="text" name="des" id="des" value="<?= $store->des ?? '' ?>" placeholder="서점 소개를 입력해주세요" required>
    </div>
    <button type="submit"><?=$text ?></button>
  </form>
</main>