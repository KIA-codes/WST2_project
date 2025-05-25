<?php
if (isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    $xml = new DOMDocument();
    $xml->load('students.xml');

    $students = $xml->getElementsByTagName('students');
    $parent = $xml->getElementsByTagName('Students')->item(0);

    foreach ($students as $student) {
        $id = $student->getElementsByTagName('id')->item(0)->nodeValue;

        if ($id == $idToDelete) {
            $parent->removeChild($student);
            $xml->save('students.xml');
            echo "<script>alert('Student with ID $idToDelete deleted successfully.'); window.location.href='index.php';</script>";
            exit;
        }
    }

    echo "<script>alert('Student not found.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('No ID provided.'); window.location.href='index.php';</script>";
}
?>
