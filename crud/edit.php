<?php
// include database connection file
include_once("../config/database.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    $birth = $_POST['birth'];
    $debut = $_POST['debut'];
    $genre = $_POST['genre'];
    $music = $_POST['music'];
        
    // update user data
    $result = mysqli_query($conn, "UPDATE indonesian_singers SET name='$name',birth='$birth',debut='$debut',genre='$genre',music='$music' WHERE id=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: ../index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM indonesian_singers WHERE id=$id");
 
while($user_data = mysqli_fetch_array($result))
{
    $name = $user_data['name'];
    $birth = $user_data['birth'];
    $debut = $user_data['debut'];
    $genre = $user_data['genre'];
    $music = $user_data['music'];
}
?>
<html>
<head>	
    <title>Edit User Data</title>
</head>
 
<body>
    <a href="../index.php">Home</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="name" value=<?php echo $name;?>></td>
            </tr>
            <tr> 
                <td>Tempat Tanggal Lahir</td>
                <td><input type="text" name="birth" value=<?php echo $birth;?> style="width:200px;"></td>
            </tr>
            <tr> 
                <td>Tahun Debut</td>
                <td><input type="number" name="debut" value=<?php echo $debut;?>></td>
            </tr>
            <tr> 
                <td>Genre</td>
                <td><input type="text" name="genre" value=<?php echo $genre;?>></td>
            </tr>
            <tr> 
                <td>Lagu</td>
                <td><input type="text" name="music" value=<?php echo $music;?> style="width:200px;"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>