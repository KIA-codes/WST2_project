<?php
session_start();

// Check if admin is logged in before destroying session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    logAdminActivityToXML($username, "Logged out");
}

// Clear session after logging activity
session_unset();
session_destroy();

// Redirect to login page
header("Location: index.html");
exit();

// Function to log admin actions
function logAdminActivityToXML($username, $action) {
     date_default_timezone_set('Asia/Manila');
    $logFile = 'admin_logs.xml';

    // Create the XML file if it doesn't exist
    if (!file_exists($logFile)) {
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $root = $xml->createElement('logs');
        $xml->appendChild($root);
        $xml->save($logFile);
    }

    // Load and append new entry
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->load($logFile);
    $root = $xml->getElementsByTagName('logs')->item(0);

    $entry = $xml->createElement('entry');
    $entry->appendChild($xml->createElement('username', htmlspecialchars($username)));
    $entry->appendChild($xml->createElement('action', $action));
    $entry->appendChild($xml->createElement('timestamp', date('Y-m-d H:i:s')));

    $root->appendChild($entry);
    $xml->save($logFile);
}
?>