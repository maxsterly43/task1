/**
 * this method use when DOM is fully started
 * This function send request to server
 * Method "get" sending request to database
 * 
 * @param url:"api.php" A string containing the URL to which the request is sent
 * @param array={action=>"read"} A plain object or string that is sent to the server with the request
 * @param callback function(data)
 *      
 */
$(document).ready(function(){
    $.get(
        "api.php",
        {
            action:"read"
        },
        function(data){
            load(data);
        },"json"
    );
})
/**
 * this delegate install event key up to "inputs" which has class 'read' to change their width
 */
$(document).delegate(".read","keyup", function(){
    var count = $(this).val().length;
    $(this).width(count*11);
})

/**
 * this delegate install event double click to "inputs" which has class 'read' to delete "readonly" attribute
 */
$(document).delegate(".read","dblclick",function(){
    $(this).removeAttr("readonly");
})
/**
 * this delegate install event focus out to "inputs" which has class 'read' to add "readonly" attribute
 */
$(document).delegate(".read","focusout",function(){

    $(this).attr('readonly', true);
});

/**
 * This function displays table of books on webpage
 * 
 * @param array data records from table books
 */
function load(data){
    $("#myTable tr").remove();
    
    for(let item of data){
        $('#myTable').append('<tr></tr>');
        for(key in item)
        {
            $('#myTable > tbody > tr:last').append('<th>'+key+'</th>');
        }
        $('#myTable > tbody > tr:last').append('<th>Изменить</th>');
        $('#myTable > tbody > tr:last').append('<th>Удалить</th>');
        break;
    }
    for(let item of data){
        $('#myTable').append('<tr id = '+item['codeBook']+'></tr>');
        for(key in item)
        {
            if(key == 'codeBook'){
                $('#myTable > tbody > tr:last').append('<td>'+item[key]+'</td>');
            }else{
            $('#myTable > tbody > tr:last').append('<td><input class = "read" id = '+key+item['codeBook']+' type = "text" value='+item[key]+' readonly></td>');
            }
        }
        $('#myTable > tbody > tr:last').append('<td><button name = '+ item['codeBook'] + ' id = "ch">изменить</button></td>');
        $('#myTable > tbody > tr:last').append('<td><button name = '+ item['codeBook'] + ' id = "del">удалить</button></td>');       
    }
    $('.read').each(function(){
        $(this).width($(this).val().length*11);
    })    
}


/**
 * Install event click on button "add" to add record in table of books
 * Method "post" sending request to database
 * 
 * @param url:"api.php" A string containing the URL to which the request is sent
 * @param array={'action'=>'add', 'name'=>'Name', 'author'=>'author', 'price'=>'price', 'genre'=>'genre'} 
 * A plain object or string that is sent to the server with the request
 * @param callback function(data) A callback function that is executed if the request succeeds. 
 * @param array data Answer of the server. Contains status of operation and added book
 * @param string DataType The type of data expected from the server.
 */
$("#add").click(function(){
    $.post(
		"api.php",
		{
            action: "add",
            name: $('input[id=name]').val(),
			author: $('input[id=author]').val(),
			price: $('input[id=price]').val(),
            genre: $('input[id=genre]').val()
        },
        function(data) {
            if(data['status']=='Success'){
                $('#name').val(null);
                $('#author').val(null);
                $('#price').val(null);
                $('#genre').val(null);
                var item = data["book"];
                $("#myTable").append("<tr id = " + item['codeBook'] + "></tr>");
                for(key in item)
                {
                    if(key == 'codeBook'){
                        $('#myTable > tbody > tr:last').append('<td>'+item[key]+'</td>');
                    }else{
                    $('#myTable > tbody > tr:last').append('<td><input class = "read" id = '+key+item['codeBook']+' type = "text" value='+item[key]+' readonly></td>');
                    $("#"+key+item['codeBook']+"").width($("#"+key+item['codeBook']+"").val().length*11);
                    }
                }
                $('#myTable > tbody > tr:last').append('<td><button name = '+ item['codeBook'] + ' id = "ch">изменить</button></td>');
                $('#myTable > tbody > tr:last').append('<td><button name = '+ item['codeBook'] + ' id = "del">удалить</button></td>');      
            }
            $('span').text(data);    
        },"json"
	);
})

/**
 * This delegate install event click on button "ch"
 * Method "post" sending request to database to change record in table of books
 * 
 * @param url:"api.php" A string containing the URL to which the request is sent
 * @param array={'action'=>'update', 'codeBook'=>'codeBook', 'name'=>'Name', 'author'=>'author', 'price'=>'price', 'genre'=>'genre'} 
 * A plain object or string that is sent to the server with the request.
 * @param callback function(data) A callback function that is executed if the request succeeds.Output status of opertation.
 * @param array data Answer of the server. Contains status of operation
 * @param string DataType The type of data expected from the server.
 */
$(document).delegate("#ch","click",function(){
    $.post(
		"api.php",
		{
            action: "update",
            codeBook: $(this).attr("name"),
            name: $('input[id=name'+ $(this).attr("name") +']').val(),
			author: $('input[id=author'+ $(this).attr("name") +']').val(),
			price: $('input[id=price'+ $(this).attr("name") +']').val(),
            genre: $('input[id=genre'+ $(this).attr("name") +']').val(),
        },
        function(data) {
            $('span').text(data);
        },"json"
	);
})

/**
 * This delegate install event click on button "del"
 * Method "post" sending request to database to delete record in table of books
 * 
 * @param url:"api.php" A string containing the URL to which the request is sent
 * @param array={'action'=>'update', 'codeBook'=>'codeBook'} A plain object or string that is sent to the server with the request
 * @param callback function(data) A callback function that is executed if the request succeeds. Refreshing table of books and 
 * output status of opertation.
 * @param array data Answer of the server. Contains status of operation
 * @param string DataType The type of data expected from the server.
 */
$(document).delegate("#del","click",function(){
    $.post(
		"api.php",
		{
            action: "delete",
            codeBook:$(this).attr("name")
        },
        function(data) {
            if((data['status'])=='Success')
                $("#myTable").find('#'+data['id'] +'').remove();
            $('span').text(data);
        },"json"
    );
})