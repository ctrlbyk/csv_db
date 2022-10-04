<?php

$customers = [
    [1,  "CustomerCode CHAR(7)"],
    [2,  "CustomerName TEXT(100)"],
    [3,  "CustomerAddress TEXT(100)"],
    [4,  "CustomerCityStateZip TEXT(70)"],
    [5,  "CustomerPhone TEXT(20)"],
    [6,  "ProduceCategory CHAR(2)"],
    [7,  "CustomerPriceLevel CHAR(2)"],
    [8,  "SalesPersonCode CHAR(3)"],
    [9,  "LocationCode CHAR(2)"],
    [11,  "CustomerAddress2 TEXT(100)"],
    [12,  "City TEXT(20)"],
    [13,  "State CHAR(2)"],
    [14,  "Zipcode TEXT(10)"],
    [15,  "CustomerEmail TEXT(60)"],
    [18,  "SalesCategory CHAR(2)"],
    [19,  "CustomerSegment CHAR(2)"],
    [20,  "ParentCustomer CHAR(6)"]
];
$customersPrimary = "CustomerID SMALLINT";
$customersIndex = "LocationCode SalesCategory ParentCustomer CustomerSegment";

$sales = [
    [1, "CustomerCode CHAR(6)"],
    [2, "LocationCode CHAR(2)"],
    [3, "InvoiceNumber CHAR(9)"],
    [4, "InvoiceDate DATE"],
    [5, "ReceiptType CHAR(13)"],
    [6, "CustomerPONumber INT UNSIGNED"],
    [7, "Ammount FLOAT"],
    [8, "Price FLOAT"],
    [9, "TotalSale FLOAT"],
    [10, "Weight FLOAT"],
    [11, "TotalWeight FLOAT"],
    [12, "PurchaseFOBperUnit FLOAT"],
    [13, "PurchaseDeliverCostperUnit FLOAT"],
    [15, "SalesOrderCode CHAR(30)"],
    [18, "BrokenCaseFlag BOOL"],
    [19, "Route CHAR(5)"],
    [20, "ShipVia CHAR(1)"],
    [22, "PrimarySalesperson CHAR(3)"],
    [23, "OrderEnterBy CHAR(3)"],
    [25, "Cathweight BOOL"],
    [33, "QuantityShipped FLOAT"],
    [34, "TotalWeightOrdered FLOAT"]
];
$salesPrimary = "SalesID INT";
$salesIndex = "CustomerCode LocationCode SalesOrderCode Route PrimarySalesperson OrderEnterBy";
