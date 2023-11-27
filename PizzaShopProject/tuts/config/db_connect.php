<?php

$conn = mysqli_connect('localhost', 'Admin', 'testtest', 'opencode_pizza', 3306);

if (!$conn) {
    echo 'Connection Error ' . mysqli_connect_error();
}

?>