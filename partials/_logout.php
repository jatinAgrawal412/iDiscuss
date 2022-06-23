<?php

echo "You are loged out";
session_start();
session_unset();
session_destroy();
header("Location: ../")

?>