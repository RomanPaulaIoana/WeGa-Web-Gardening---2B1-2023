<?php

$conn = mysqli_connect("localhost", "root", "", "plant_palooza");

if (!$conn) {
    echo "Connection Failed";
}