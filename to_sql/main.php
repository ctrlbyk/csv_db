<?php

require "functions.php";
require "fields.php";

$time_start = microtime(true);
$dbname = "example";
$path_files = "/home/kenet/Descargas/hardies/";

$file = fopen("script.sql", "w");

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

create_database($file, $dbname);

foreach ($entries as $entry) {
    insert_data(
        $file,
        $entry["table"],
        $entry["fieldNames"],
        $path_files . $entry["file_name"],
        $entry["primary"],
        $entry["index"]
    );
}
fwrite($file, "-- Dump completed on " . date("Y-m-d h:i:sa"));
fclose($file);
echo "\nEverithing is Ok. Total Time:" . end_time($time_start) . " mins\n";
