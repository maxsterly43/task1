<?php header("Location: http://host1");?>
<html>
    <head>
    <meta charset = "utf-8">
    </head>
    <body>  
        <?php
        require "/connectBD.php";
            if($_POST["changeBT"]){
                $update = "UPDATE books SET name ='{$_POST['ch_name']}', author ='{$_POST['ch_author']}',
                price ='{$_POST['ch_price']}', genre ='{$_POST['ch_genre']}'
                WHERE codeBook ='{$_POST['ch_codeBook']}'";
                $q = mysqli_query($connection, $update) or die("Error".mysqli_error($q));
            }
            else if($_POST['del']){
                $codeBook = preg_replace("/[^0-9]/", '', $_POST['del']);
                $del = "DELETE FROM books WHERE codeBook = ".$codeBook;
                $q = mysqli_query($connection, $del) or die("Error".mysqli_error($q));
            }else if($_POST['addQ']){
                $codeBook = 'NULL';
                $name = $_POST['name'];
                $author = $_POST['author'];
                $price = $_POST['price'];
                $genre = $_POST['genre'];
                $q = "INSERT INTO books (codeBook, name, author, price, genre)
                VALUES (".$codeBook.", '".$name."', '".$author."', '".$price."', '".$genre."');";
                mysqli_query($connection, $q) or die("Error".mysqli_error($q));  
            }
            exit();
        ?>
    </body>
</html>