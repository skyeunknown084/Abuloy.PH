<?php

session_start();
session_unset();
session_destroy();
// redirect back to login
header("Location: /login");

?>