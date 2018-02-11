<?php
function checkEmpty($data){
    return (empty($data['name']) || empty($data['author']) || empty($data['price']) || empty($data['genre'])) ? true : false;
}

function add($connection, $data){
    if(checkEmpty($data))
        return json_encode('Write all the fields!');
    $add = "INSERT INTO books(name, author, price, genre) 
    VALUES ('{$data['name']}', '{$data['author']}', '{$data['price']}', '{$data['genre']}')";
    mysqli_query($connection, $add) or die("Error".mysqli_error($q));  
    return json_encode('Success');
}

function del($connection, $data){
    $count = mysqli_query($connection,"SELECT * FROM books WHERE codeBook = '{$data['codeBook']}'");
    if(mysqli_num_rows($count)!=0){
        $q = mysqli_query($connection, "DELETE FROM books WHERE codeBook = '{$data['codeBook']}'");
        return json_encode('Success');
    }else{
        return json_encode("record with id = '".$data['codeBook']."' not found!");
    }
}

function edit($connection, $data){
    if(checkEmpty($data))
        return 'Write all the fields!';
    $update = "UPDATE books SET name = '{$data['name']}', author = '{$data['author']}',
    price = '{$data['price']}', genre = '{$data['genre']}' WHERE codeBook = {$data['codeBook']}";
    $q = mysqli_query($connection, $update) or die("Error".mysqli_error($q));
    return 'Seccess';
}

function display($connection){
    $display = "SELECT * FROM books";
    $q = mysqli_query($connection, $display) or die("Error".mysqli_error($q));
    while($row = mysqli_fetch_assoc($q)){
        $data[] = $row; 
    }
    return json_encode($data);
}
?>