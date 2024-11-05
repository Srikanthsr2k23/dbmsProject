<?php
$conn = mysqli_connect("localhost", "root", "", "assignment");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CALL IncreaseLikeCount()";
if (mysqli_query($conn, $sql)) {
    echo "Like count increased successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
