<?php 
    require 'connectBD.php' ;  
    require 'request.php';
    if($_POST['editReady'] == 'true'){
        header('Location: http://host1/index.php');
        edit($connection, $_POST);
    }else if($_POST['addReady'] == 'true'){
        header('Location: http://host1/index.php');
        add($connection, $_POST);
    }else if($_POST['del']){
        header('Location: http://host1/index.php');
        del($connection, $_POST);
    }
?>

<html>
    <head>
    <meta charset = 'utf-8'>
        <title>Редактирование/Добавление</title>
    </head>
    <body>  
        <h1>Редактирование/Добавление</h1>
        <?php
        if($_POST["edit"]){
            $id = preg_replace("/[^0-9]/", '', $_POST['edit']);
            $query = "SELECT * FROM books WHERE codeBook = ".$id;
            $q = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($q);
            ?>
            <form action = "/handle.php" method = "POST">
            <?php 
            foreach($row as $key => $value){
                if($key != "codeBook"){
                    print "<p>${key}:<br>"; 
                    print "<input type ='text' name = ${key} value = '".$value."'></p>";
                }
                else print "<input type ='hidden' name = ${key} value = ${value}></p>";
                
            }
            ?>
            <input type = 'hidden' name = 'editReady' value = 'true'></p>
            <input type = "submit" name = "edit" value = "Изменить">
            </form>
        <?php
        }
        else if($_POST["add"]){
            $query = "SHOW COLUMNS FROM books";
            $q = mysqli_query($connection, $query) or die("Error".mysqli_error($q));
            ?>
            <form action = "handle.php" method = "POST">
            <?php 
 				while($row = mysqli_fetch_row($q)){ 
                    if($row[0] != "codeBook"){
                        ?>
                        <p><?=$row[0]?><br>
                        <input type ='text' name = "<?=$row[0]?>"></p>
                        <?php 
                    }
                }
                ?>
            <input type = 'hidden' name = 'addReady' value = 'true'></p>
            <input type = 'submit' name = 'add' value = 'добавить запись' >
            </form>
            <?php
        }
        ?>
    </body>
</html>