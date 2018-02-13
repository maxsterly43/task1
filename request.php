<?php
 header("Content-Type: text/html; charset=utf-8");

/**
 * Validation of input paramerers
 * This method will call then the server accepts parameters for editing and adding record 
 * For example, adding new book in the table: 
 * 
 * ```php
 *  $ch = check($data);
 *  if($ch!='complete')
 *      return  json_encode($ch);
 *  else    
 *      sending request to database
 * ```
 * 
 * @param array $data to generate a request to database
 * data contains fields:
 * name of book
 * author of book
 * genre of book
 * price of book
 * @return string message which contains error if validation not pass or success if validation passed
 */
function check($data){
    $pattern_price = '#^[0-9]*?.[0-9]*$#';
    $pattern_name = '#^\p{L}+$#u';
    if(!preg_match($pattern_name, $data['name']))
        return 'wrong name';
    if(!preg_match($pattern_name, $data['author']))
        return 'wrong author';
    if(!preg_match($pattern_name, $data['genre']))
        return 'wrong genre';
    if(!preg_match($pattern_price, $data['price']))
        return 'wrong price';
    return 'complete';
}

/**
 * Getting last added book
 * 
 * This method will call then you need to get last book in the table
 * 
 * For examlpe, to get added book (this book have the biggest codeBook)
 * 
 * ```php
 * $last_book = get_last_book($mysqli);
 * ```
 * @param var $mysqli object representing the connection to the MySQL server.
 *  
 * @return array $data last added book
 */
function get_last_book($mysqli){
    $queryrows = "SELECT * FROM books ORDER BY codeBook DESC LIMIT 1";
    $result = $mysqli->query($queryrows) or die("Error".$result->error);
    if($row = $result->fetch_assoc()){
        return $row; 
    }
}

/**
 * Adding record in table of books
 * 
 * This method will call when you nedd to add new book in database
 * 
 * For example:
 * 
 * ```php
 * $data = array('name'=>'Name', 'author'=>'author', 'price'=>'price', 'genre'=>'genre');
 * add($mysqli, $data);
 * ```
 * @param var $mysqli object representing the connection to the MySQL server.
 * @param array $data book fields which you need to add in database
 * 
 * @return  array $res which contains status of operation and last added book 
 */
function add($mysqli, $data){
    $ch = check($data);
    if($ch!='complete')
        return  json_encode($ch);
    $add = "INSERT INTO books(name, author, price, genre) 
    VALUES ('{$data['name']}', '{$data['author']}', '{$data['price']}', '{$data['genre']}')";
    $result = $mysqli->query($add) or die("Error".$mysqli->error); 
    return json_encode(array('status'=>'Success',
                            'book'=>get_last_book($mysqli)));
}

/**
 * Removing record in table of books
 * 
 * This method will call then you need to delete row in table of books
 * 
 * For example:
 * 
 * ```php
 * $data = array('codeBook'=>'codeBook');
 * del($mysqli, $data);
 * ```
 * 
 * @param  var $mysqli object representing the connection to the MySQL server.
 * @param array $data which contains id of the book to remove
 * @return array $res with status of operation and id of deleted element
 */
function del($mysqli, $data){
    $pattern_id = '#^\d*?$#';
    if(!preg_match($pattern_id, $data['codeBook'])) 
        return json_encode('Wrong codeBook!');
    $count = $mysqli->query("SELECT * FROM books WHERE codeBook = '{$data['codeBook']}'");
    if($count->num_rows!=0){
        $result = $mysqli->query("DELETE FROM books WHERE codeBook = '{$data['codeBook']}'");
        return json_encode(array(
            'status'=>'Success',
            'id'=>$data['codeBook'])
        );
    }else{
        return json_encode("record with id = '".$data['codeBook']."' not found!");
    }
}

/**
 * Editing row in table of books
 * 
 * This method will call when you want to change book data in database
 * 
 * For example:
 * 
  * ```php
 * $data = array('codeBook'=>'codeBook',name'=>'new_name', 'author'=>'new_author', 'price'=>'new_price', 'genre'=>'new_genre');
 * add($mysqli, $data);
 * ```
 * 
 * @param var $mysqli object representing the connection to the MySQL server.
 * @param array $data book fields which you changing in the table
 * 
 * @return array $res returns status of request
 */
function edit($mysqli, $data){
    if(!is_int($data['codeBook']))
        return json_encode('Wrong codeBook!');
    $ch = check($data);
    if($ch!='complete')
        return  json_encode(array('status'=>$ch));
    $update = "UPDATE books SET name = '{$data['name']}', author = '{$data['author']}',
    price = '{$data['price']}', genre = '{$data['genre']}' WHERE codeBook = {$data['codeBook']}";
    $result = $mysqli->query($update) or die("Error: ".$result->error);
    return json_encode(array('status'=>'Success'));
}

/**
 * Show table of books
 * 
 * This method returns all records form books table
 * 
 * For example:
 * 
 * ```php
 *   $res = display($mysqli);
 * ```
 * 
 * @param var $mysqli object representing the connection to the MySQL server.
 * @return array $data which contains all records form books table
 */
function display($mysqli){
    $display = "SELECT * FROM books";
    $result = $mysqli->query($display) or die("Error: ".$result->error);
    while($row = $result->fetch_assoc()){
        $data[] = $row; 
    }
    return json_encode($data);
}
?>