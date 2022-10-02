<?php

require "functions.php";
require "fields.php";

$time_start = microtime(true);
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "example";

$conn = new mysqli($servername, $username, $password);
create_database($conn, $dbname);

$entries = [
    [
        "table" => "customers",
        "fieldNames" => $customers,
        "file_name" => "HARDIES_DATAWAREHOUSE_AUCUSTMRS.CSV",
        "primary" => $customersPrimary,
        "index" => $customersIndex,
    ],
    [
        "table" => "customers",
        "fieldNames" => $customers,
        "file_name" => "HARDIES_DATAWAREHOUSE_DACUSTMRS.CSV",
        "primary" => "",
        "index" => "",
    ],
    [
        "table" => "customers",
        "fieldNames" => $customers,
        "file_name" => "HARDIES_DATAWAREHOUSE_HOCUSTMRS.CSV",
        "primary" => "",
        "index" => "",
    ],
    [
        "table" => "sales",
        "fieldNames" => $sales,
        "file_name" => "HARDIES_DATAWHSE_SALESORDRS220928.CSV",
        "primary" => $salesPrimary,
        "index" => $salesIndex,
    ],
];

foreach ($entries as $entry) {
    insert_data(
        $conn,
        $entry["table"],
        $entry["fieldNames"],
        $entry["file_name"],
        $entry["primary"],
        $entry["index"]
    );
}

$conn->close();
echo "\nEverithing is Ok. Total Time:" . end_time($time_start) . " mins\n";
