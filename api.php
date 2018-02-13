<?php     
    header("Content-Type: text/html; charset=utf-8");
    require_once 'connectBD.php';
    require_once 'request.php';
    $error = json_encode('{
        "status" : "Error",
        "message": "Wrong request!"
    }');

    switch($_REQUEST['action']){
        case 'add':
            if(!empty($_POST))
                $ans = add($mysqli, $_POST);
            else 
                $ans = $error;
            print $ans;
        break;
        case 'read':
            if(!empty($_GET))
                $ans = display($mysqli);
            else
                $ans = $error;
            print $ans;
        break;
        case 'update':
            if(!empty($_POST))
                $ans = edit($mysqli, $_POST);
            else 
                $ans = $error;
            print $ans;
        break;
        case 'delete':
            if(!empty($_POST))
            $ans = del($mysqli, $_POST);
            else 
            $ans = $error;
            print $ans;
        break;
        default:
        break;
    }       
?>