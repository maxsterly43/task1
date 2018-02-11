$(document).ready(function(){
    load();
    }
)

$("#add").click(function(){
    $.post(
		"api.php",
		{
            action: "add",
            name: $('input[id=name]').val(),
			author: $('input[id=author]').val(),
			price: $('input[id=price]').val(),
            genre: $('input[id=genre]').val(),
        },
        function(data) {
            console.log(data);
            if(data=='Success'){
                $('#name').val(null);
                $('#author').val(null);
                $('#price').val(null);
                $('#genre').val(null);
            }
            $('span').text(data);    
            load();
        },"json"
	);
})

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
            load();
        },"json"
	);
})

$(document).delegate(".read","keyup", function(){
    var count = $(this).val().length;
    $(this).width(count*9);
})

$(document).delegate(".read","dblclick",function(){
    $(this).removeAttr("readonly");
})

$(document).delegate(".read","focusout",function(){

    $(this).attr('readonly', true);
});

$(document).delegate("#del","click",function(){
    $.post(
		"api.php",
		{
            action: "delete",
            codeBook:$(this).attr("name")
        },
        function(data) {
            load();
        });
})

function load(){
        $.get(
        "api.php",
        {
            action:"read"
        },
        function(data){
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
                $('#myTable').append('<tr></tr>');
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
                $(this).width($(this).val().length*9);
            })    
        },"json"
    );
}


