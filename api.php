<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/style.css">
    </head>
    <body>
        <?php     
            require_once 'connectBD.php';
            require_once 'request.php';
            $error = json_encode('{
                "status" : "Error",
                "message": "Wrong request!"
            }');
            switch($_REQUEST['action']){
                case 'add':
                    if(!empty($_POST))
                        $ans = add($connection, $_POST);
                    else 
                        $ans = $error;
                    print $ans;
                break;
                case 'read':
                    if(!empty($_GET))
                        $ans = display($connection);
                    else
                        $ans = $error;
                    print $ans;
                break;
                case 'update':
                    if(!empty($_POST))
                        $ans = edit($connection, $_POST);
                    else 
                        $ans = $error;
                    print $ans;
                break;
                case 'delete':
                    if(!empty($_DELETE))
                    $ans = del($connection, $_POST);
                    else 
                    $ans = $error;
                    print $ans;
                break;
                default:
                break;
            }       
        ?>
    </body>
</html>