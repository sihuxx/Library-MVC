<?php
get('/', function () {
  views('home');
});
get("/login", function () {
  views("auth/login");
});
get("/reg", function () {
  views("auth/reg");
});
get('/logout', function () {
  session_destroy();
  alert("로그아웃 성공");
  move("/");
});
get('/bookAdmin', function () {
  views("book/list");
});
get('/rentalAdmin', function () {
  views("rental/list");
});
get('/storeAdmin', function () {
  views("store/adminList");
});
get('/userAdmin', function () {
  views("user/list");
});
get('/storeList', function () {
  views("store/list");
});
post('/profile', function () {
  views("user/profile");
});
get('/myProfile', function () {
  views("user/profile");
});
post("/store", function () {
  views("store/store");
});
post("/bookForm", function () {
  views("book/form");
});
post("/calendar", function () {
  views("rental/calendar");
});
post("/table", function () {
  views("rental/table");
});
get("/storeAdd", function () {
  views("store/form");
});
post("/storeEdit", function () {
  views("store/form");
});
post("/rental", function () {
  $user = $_SESSION['ss'];
  $book_idx = $_POST["book_idx"];
  $book = db::fetch("select * from book where idx = '$book_idx'");
  $store_idx = $_POST["store_idx"];
  $userBook = db::fetchAll("select * from user_book where book_idx = $book->idx and is_rental = '1'");
  if ($book->stock - count($userBook) < 1) {
    alert("재고가 없는 책입니다.");
    return;
  }
  if (db::fetch("select * from user_book where user_idx = '$user->idx' and book_idx = '$book_idx' and is_rental = '1'")) {
    move("/storeList", "이미 대여 중인 책입니다");
  } else {
    db::exec("insert into user_book(user_idx, book_idx, store_idx, period, is_rental) values ('$user->idx', '$book_idx', '$store_idx', '7', '1')");
    move("/myProfile", "책 대여가 완료되었습니다");
  }
});
post("/return", function () {
  $book_idx = $_POST["book_idx"];
  $user = $_SESSION["ss"];
  db::exec("update user_book set is_rental = '0' where user_idx = '$user->idx' and book_idx = '$book_idx'");
  move("/myProfile", "책 반납이 완료되었습니다");
});
post("/signUp", function () {
  extract($_POST);
  if (db::fetch("select * from user where id = '$id'")) {
    back("이미 존재하는 아이디입니다");
  } else {
    [$h_psw, $salt] = hashPsw($psw);
    db::exec("insert into user(id, psw, email, name, salt) values('$id', '$h_psw', '$email', '$name', '$salt')");
    move("/login", "회원가입 성공");
  }
});
post("/signIn", function () {
  extract($_POST);
  $user = db::fetch("select * from user where id = '$id'");
  if ($user) {
    $input_h_psw = hash("sha256", $psw . $user->salt);
    if ($input_h_psw == $user->psw) {
      $_SESSION["ss"] = $user;
      move("/", "로그인 성공");
    } else {
      back("비밀번호가 일치하지 않습니다");
    }
  } else {
    back("아이디가 일치하지 않습니다");
  }
});
post("/quit", function () {
  $idx = $_POST["idx"];
  db::exec("delete from user where idx = '$idx'");
  move('/', "탈퇴 처리 되었습니다");
});
post("/bookDel", function () {
  $idx = $_GET["idx"];
  db::exec("delete from book where idx = '$idx'");
  move("/bookAdmin", "책이 삭제되었습니다");
});
post("/bookInsert", function () {
  extract($_POST);
  $file = $_FILES["file"];
  $path = './images/books/' . $file["name"];
  if (move_uploaded_file($file["tmp_name"], $path)) {
    db::exec("insert into book(title, des, img, stock, store_idx) values('$title', '$des', '$path', '$stock', '$store_idx')");
    move("/bookAdmin", "책이 등록되었습니다");
  } else {
    back("파일 업로드에 실패했습니다");
  }
});
post("/bookUpdate", function () {
  extract($_POST);
  $file = $_FILES["file"];
  $path = './images/books/' . $file['name'];
  if (move_uploaded_file($file['tmp_name'], $path)) {
    db::exec("update book set title = '$title', des = '$des', img ='$path', stock = '$stock' where idx = '$idx'");
    move("/bookAdmin", "책 정보가 수정되었습니다");
  } else {
    db::exec("update book set title = '$title', des = '$des', stock = '$stock' where idx = '$idx'");
    move("/bookAdmin", "책 정보가 수정되었습니다");
  }
});

post("/userDelete", function () {
  $idx = $_POST["idx"];
  db::exec("delete from user where idx = '$idx'");
  back("탈퇴 처리 되었습니다");
});
post("/userDeleteAdmin", function () {
  $user_idx = $_POST["idx"];
  $store = db::fetch("select * from stores where admin_idx = '$user_idx'");
  db::exec("update stores set admin_idx = null where idx = '$store->idx'");
  db::exec("update user set admin = '0' where idx = '$user_idx'");
  move("/userAdmin", "서점 관리자가 삭제되었습니다");
});
post("/userAddAdmin", function () {
  views("user/addAdmin");
});
post("/userInsertAdmin", function () {
  extract($_POST);
  if (db::fetch("select * from stores where idx = '$store_idx' and admin_idx is null")) {
    db::exec("update stores set admin_idx = '$user_idx' where idx = '$store_idx'");
    db::exec("update user set admin = '1' where idx = '$user_idx'");
    move("/userAdmin", "서점 관리자가 추가되었습니다");
  } else {
    move("/userAdmin", "이미 서점 관리자가 존재하는 서점입니다");
  }
});
post("/storeDel", function () {
  $idx = $_POST["idx"];
  db::exec("delete from stores where idx = '$idx'");
  alert(("서점이 삭제되었습니다"));
  move("/storeAdmin");
});
post("/storeUpdate", function () {
  extract($_POST);
  $file = $_FILES['file'];
  $path = './images/stores/' . $file["name"];
  if (move_uploaded_file($file["tmp_name"], $path)) {
    db::exec("update stores set title = '$title', des = '$des', img = '$path' where idx = '$idx'");
    move('/storeAdmin', "서점 정보가 수정되었습니다");
  } else {
    db::exec("update stores set title = '$title', des = '$des' where idx = '$idx'");
    move('/storeAdmin', "서점 정보가 수정되었습니다");
  }
});
post("/storeInsert", function () {
  extract(($_POST));
  $file = $_FILES['file'];
  $path = './images/stores/' . $file['name'];
  if (move_uploaded_file($file["tmp_name"], $path)) {
    db::exec("insert into stores(title, des, img) values('$title', '$des', '$path')");
    move('/storeAdmin', "서점이 등록되었습니다");
  } else {
    back("파일 업로드에 실패했습니다");
  }
});