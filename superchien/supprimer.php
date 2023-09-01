<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv = "refresh" content = "0; url = http://localhost/web3-2023/superchien/index.php" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$id =$_GET["id"];
$servername = "localhost";
$username = "root";
$password = "root";
$db = "bdtest";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "DELETE FROM jeuxvideo WHERE id = $id";

if(mysqli_query($conn, $sql)){
    echo "Supprimé";
}else{
    echo "Error: ". $sql . "<br>".mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>