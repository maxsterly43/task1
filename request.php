<?php
function checkEmpty($data){
    return (empty($data['name']) || empty($data['author']) || empty($data['price']) || empty($data['genre'])) ? true : false;
}

function add($connection, $data){
    if(checkEmpty($data))
        return 'Write all the fields!';
    $add = "INSERT INTO books (codeBook, name, author, price, genre) 
    VALUES (NULL, ${data['name']}, ${data['author']}, ${data['price']}, ${data['genre']})";
    mysqli_query($connection, $add) or die("Error".mysqli_error($q));  
    return 'Seccess';
}

function del($connection, $data){
    $codeBook = preg_replace("/[^0-9]/", '', $data['del']);
    $del = "DELETE FROM books WHERE codeBook = ${codeBook}";
    $q = mysqli_query($connection, $del) or die("Error".mysqli_error($q));
    return 'Seccess';
}

function edit($connection, $data){
    if(checkEmpty($data))
        return 'Write all the fields!';
    $update = "UPDATE books SET name = '${data['name']}', author = '${data['author']}',
    price = '${data['price']}', genre = '${data['genre']}' WHERE codeBook = ${data['codeBook']}";
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