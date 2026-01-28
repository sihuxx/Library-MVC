<?php

function move($uri)
{
  echo "<script>location.href = '$uri'</script>";
}

function views($page)
{
  require_once '../views/template/header.php';
  require_once "../views/$page.php";
  require_once '../views/template/footer.php';
}

function alert($msg)
{
  echo "<script>alert('$msg')</script>";
}