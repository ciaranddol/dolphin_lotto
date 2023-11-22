<?php

$dbHost = "user-prod-us-east-2-1.cluster-cfi5vnucvv3w.us-east-2.rds.amazonaws.com";
$dbPort = 5432;
$dbName = "dolphinlotto-main-db-0cd5578f30379b183";
$dbUser = "dolphinlotto-main-db-0cd5578f30379b183";
$dbPassword = "kjTnmzvBwEsStGfC3FE3V3Gqc6xzqs";

$pgsqlConnection = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword sslmode=disable");

if (!$pgsqlConnection) {
    die("Connection failed: " . pg_last_error($pgsqlConnection));
}

return $pgsqlConnection;
