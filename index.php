<!DOCTYPE html>
<?php $software_version="1.0.0"
include('config.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>The Blog</title>
</head>
<body>
    <h1>The Blog</h1>
    <br>
    	
    	<br>
        <br>
        <hr>
    	    <form action="/index.php" method="get" autocomplete="off">
            
            <input type="text" name="ctitle" placeholder="TITLE" id="ctitle"><br><br>
            <textarea name="ctext" cols="40" rows="5"></textarea>
            <br><br>
            <input type="text" name="cauthor" placeholder="[author]" id="cauthor">
            <br>
            <input type="password" name="pwd" placeholder="Password" id="pwd">
            <input class="lbutton" type="submit" value="CREATE POST">

            </form>
            <hr>
        <br>
        <br>
    <div>
        <h2>Posts</h2>
        <div class="posts">
        <?php 
        $servername = $config['DB_HOST'];
        $username = $config['DB_UN'];
        $password = $config['DB_PWD'];
        $db = $config['DB_DB'];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password,$db);
        $typeArray = array();
        $query = "select * from posts ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "#" . $row["id"]. "|  <b>" . $row["title"]. "    </b>" . $row["text"]. "  <br/> ~ <b>" . $row['poster'] . "</b><br/><hr><br/>";
            }
          } else {
            echo "0 results";
          }
        
        
        
        ?>
        </div>
    </div>


    <div class="footer">



    <small>v:<?php echo($software_version)?></small>
    </div>
    <?php 
    if(isset($_GET['pwd'])){
    
    $ctitle=$_GET['ctitle'];
    $cauthor=$_GET['cauthor'];
    $ctext=$_GET['ctext'];
    $usercreatepostpassword=$_GET['pwd'];
    if(
        $usercreatepostpassword==$config['BLOG_PWD'];
    ){
        if($ctitle=="del"){
            $queryforpostcreation="DELETE FROM `posts` WHERE `posts`.`id` = ".$ctext;
        }else{
        $queryforpostcreation="INSERT INTO `posts` (`poster`, `title`, `text`, `time`, `id`) VALUES ('".$cauthor."', '".$ctitle."', '".$ctext."', current_timestamp(), NULL);";
        
        }
        $conn->query($queryforpostcreation);
    }

}
$conn->close();


?>
</body>
</html>



<!-- 
//by ClientCrash
https://github.com/clientcrash
-->