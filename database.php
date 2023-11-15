<?php

require 'vendor/autoload.php';

use Supabase\SupabaseClient;

// Replace 'your-url' and 'your-key' with your Supabase project URL and key
$supabaseUrl = 'postgresql://postgres:buckbeak1901!@db.fuhzxgckcobvsvhkqppo.supabase.co:5432/postgres';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZ1aHp4Z2NrY29idnN2aGtxcHBvIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTY5OTk1MTAzMSwiZXhwIjoyMDE1NTI3MDMxfQ.Ylb53-giqsKDbD0iswLSryZM3KzMiKShYaBNowdYnzk';

$supabase = new SupabaseClient($supabaseUrl, $supabaseKey);

// Example query
$result = $supabase->from('your-table')->select('*')->get();

// Handle the result
if ($result->error) {
    // Handle the error
    echo 'Error: ' . $result->error->message;
} else {
    // Process the data
    $data = $result->data;
    // Do something with the data
}

?>
