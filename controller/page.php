<?php
get('/', function() {
  views('home');
});
get("/login", function() {
  views("auth/login");
});
get("/reg", function() {
  views("auth/reg");
});
