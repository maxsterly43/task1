
<html>
    <head>
    <meta charset = "utf-8">
        <title>Редактирование/Добавление</title>
    </head>
    <body>  
        <h1>Редактирование/Добавление</h1>
        <?php
        require "/connectBD.php";
        if($_POST["change"]){
            $id = preg_replace("/[^0-9]/", '', $_POST['change']);
            $query = "SELECT * FROM books WHERE codeBook = ".$id;
            $q = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($q);
            ?>
            <form action = "/edit.php" method = "POST">
            <?php 
            foreach($row as $key => $value){
                if($key != "codeBook"){
                    print "<p>".$key.":<br>"; 
                    print "<input type ='text' name='ch_".$key."' value ='".$value."' on /></p>";
                }
                else {
                    print "<input type ='hidden' name='ch_".$key."' value ='".$value."' on /></p>";
                }
            }
            ?>
            <input type = "submit" name = "changeBT" value = "Изменить" onclick = "edit.php">
            </form>
        <?php
        }
        else if($_POST["add"]){
            $query = "SHOW COLUMNS FROM books";
            $q = mysqli_query($connection, $query) or die("Error".mysqli_error($q));
            ?>
            <form action = "edit.php" method = "POST">
            <?php 
 				while($row = mysqli_fetch_row($q)){ 
                    if($row[0] != "codeBook"){
                        ?>
                        <p><?=$row[0]?><br>
                        <input type ='text' name = "<?=$row[0]?>" /></p>
                        <?php 
                    }
                    }
                ?>
            <input type="submit" class="button" name = "addQ" value = "добавить запись" onclick = "edit.php" >
            </form>
            <?php
        }
        ?>
    </body>
</html>