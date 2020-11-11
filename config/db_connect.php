<?php

// connect to DB
$conn = mysqli_connect('localhost', 'jeff', 'test1234', 'jeff_pizza');

if (!$conn) {
    echo 'Connection error: '.mysqli_connect_error();
}
