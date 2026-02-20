<?php

function move($uri, $msg = false)
{
  if($msg) {
  echo "<script>alert('$msg')</script>";
  }
  echo "<script>location.href = '$uri'</script>";
}

function views($page, $data=[])
{
  extract($data);
  require_once '../views/template/header.php';
  require_once "../views/$page.php";
  require_once '../views/template/footer.php';
}

function alert($msg) {
  echo "<script>alert('$msg')</script>";
}
function ss() {
  return $_SESSION["ss"] ?? false;
}

function back($msg = false)
{
  if($msg) {
    echo "<script>alert('$msg')</script>";
  }
  echo "<script>history.back()</script>";
}
function hashPsw($psw)
{
  $salt = bin2hex(random_bytes(32));
  $h_psw = hash("sha256", $psw . $salt);
  return [$h_psw, $salt];
}