<?php
    include '../Essential Kits/php/conn.php';
    include "../Essential Kits/php/session.php";
    check_session();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Books</title>
</head>
<body>
	<script src="../Essential Kits/js/document-loader-script.js"></script>
    
</body>
</html>
<?php
    $conn->close();
?>