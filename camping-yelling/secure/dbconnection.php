<?php
// Database configuration
$host = 'localhost';
$db   = 'db1';
$user = 'amcmorrow';
$pass = 'McMorrow!984';
$port = '5432'; // Default port for PostgreSQL

// Create connection string
$conn_string = "host=$host port=$port dbname=$db user=$user password=$pass";

// Establish a connection to the PostgreSQL database
$conn = pg_connect($conn_string);

if (!$conn) {
    echo "Error: Unable to open database\n";
    exit;
}