<?php
if (isset($_GET['username'])) {
    $idToDelete = $_GET['username'];

    $xml = new DOMDocument();
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->load('login.xml');

    $parent = $xml->getElementsByTagName('users')->item(0);
    $users = $xml->getElementsByTagName('user');
    $found = false;

    foreach ($users as $user) {
        $username = $user->getElementsByTagName('username')->item(0)->nodeValue;

        if ($username === $idToDelete) {
            $parent->removeChild($user);
            $xml->save('login.xml');
            $found = true;
            echo "<script>alert('User \"$idToDelete\" deleted successfully.'); window.location.href='index.php';</script>";
            break;
        }
    }

    if (!$found) {
        echo "<script>alert('User not found.'); window.location.href='admin.php';</script>";
    }
} else {
    echo "<script>alert('No username provided.'); window.location.href='admin.php';</script>";
}
?>