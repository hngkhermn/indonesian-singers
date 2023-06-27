<html>
<head>
    <title>Add Movie</title>
</head>
 
<body>
    <a href="../index.php">Go to Home</a>
    <br/><br/>
 
    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr> 
                <td>Tempat Tanggal Lahir</td>
                <td><input type="text" name="birth"></td>
            </tr>
            <tr> 
                <td>Tahun Debut</td>
                <td><input type="number" name="debut"></td>
            </tr>
            <tr> 
                <td>Genre</td>
                <td><input type="text" name="genre"></td>
            </tr>
            <tr> 
                <td>Lagu</td>
                <td><input type="text" name="music"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    
    <?php
 
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $birth = $_POST['birth'];
        $debut = $_POST['debut'];
        $genre = $_POST['genre'];
        $music = $_POST['music'];
        
        // include database connection file
        include_once("../config/database.php");
                
        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO indonesian_singers(name,birth,debut,genre,music) VALUES('$name','$birth','$debut','$genre','$music')");
        
        // Show message when user added
        echo "Singers added successfully. <a href='../index.php'>View Singers</a>";
    }
    ?>
</body>
</html>