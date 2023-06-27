<?php  
include_once("config/database.php");
 
// Fetch all users data from database
// $result = mysqli_query($conn, "SELECT indonesian_singers.*, actors.actor_name
// FROM indonesian_singers
// LEFT JOIN actors ON indonesian_singers.id = actors.film_id;");

$result = 'SELECT * FROM indonesian_singers';
$result = mysqli_query($conn, $result);

if (!$result) {
  die('Error fetching data: ' . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>List Indonesian Singers</title>
</head>
<body>


<div class="container">
    <div class="mt-5 mb-5">
        <h1 class="mb-2 text-center">List Data Penyanyi Indonesia</h1>
        <a href="crud/add.php">Add Singers</a><br/><br/>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Tempat Tanggal Lahir</th>
              <th scope="col">Tahun Debut</th>
              <th scope="col">Genre</th>
              <th scope="col">Lagu</th>
            </tr>
          </thead>
          <tbody>
          <?php  
            while($singers_data = mysqli_fetch_assoc($result)) {         
                echo "<tr>";
                echo "<th>".$singers_data['id']."</th>";
                echo "<th>".$singers_data['name']."</th>";
                echo "<th>".$singers_data['birth']."</th>";
                echo "<th>".$singers_data['debut']."</th>";
                echo "<th>".$singers_data['genre'] ."</th>";    
                echo "<th>".$singers_data['music'] ."</th>";    
                echo "<th><a href='crud/edit.php?id=$singers_data[id]'>Edit</a> | <a href='crud/delete.php?id=$singers_data[id]' ' onclick='return checkDelete()'>Delete</a></td></tr>";        
                    
            }
            ?>
          </tbody>
        </table>
    </div>
</div>
    
</body>
</html>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
<script src="assets/js/bootstrap.bundle.min.js"></script>