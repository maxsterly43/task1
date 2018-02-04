<html>
    <head>
        <meta charset = "utf-8">
        <link rel = "stylesheet" href = "/style.css">
    </head> 
    <body>
        <?php require "/connectBD.php";?>
        <table>
			<caption>Таблица книг</caption>
			<tr>
			    <?php 
				    $result = mysqli_query($connection,"SHOW COLUMNS FROM books");
					while($column = mysqli_fetch_row($result)){ 
                        ?>
                        <th><?=$column[0]?></th>
						<?php 
						}
                    ?>
                    <form action = "/changeBD.php" method = "POST">
                    <th><input type = "submit" name = "add" value = "добавить"><th>
                    </form>
				</tr>
                    <?php
                        mysqli_free_result($result);
                        $result = mysqli_query($connection,"SELECT * FROM `books`");
                        while($row = mysqli_fetch_row($result)){	
                            ?>
                            <tr>
                                <?php
                                foreach($row as $cell){
                                    ?>
                                    <td><?=$cell?></td>
                                    <?php
                                }
                                $id = $row[0];
                                ?>
                            <form action = "/changeBD.php" method = "POST">
                            <td><input type = "submit" name = "change" value = "Изменить <?=$id?>" ></td>
                            </form>
                            <form action = "/edit.php" method = "POST">
                            <td><input type = "submit" name = "del" value = "Удалить <?=$id?>" ></td>
                            </form>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($result); 
                    ?>
            </table>  
    </body>
</html>