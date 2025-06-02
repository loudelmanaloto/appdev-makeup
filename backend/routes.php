<?php

header("Access-Control-Allow-Origin: *");

include_once("./models/get.php");
include_once("./models/post.php");

include_once("./config/database.php");

$db = new Connection();
$pdo = $db->connect();
$get = new Get($pdo);
$post = new Post($pdo);


// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $segments = explode('/', $uri);
// $projectIndex = array_search('routes.php', $segments);
// if ($projectIndex !== false && $projectIndex < count($segments) - 1) {
//     $request = array_slice($segments, $projectIndex + 1);

// }


$request = explode("/", $_REQUEST['request']);

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case "GET":

        switch ($request[0]) {
            case 'getstudents':
                echo json_encode($get->getStudents());
                break;
            case 'getcourses':
                echo json_encode($get->getCourses());
                break;
            case 'getgrades':
                echo json_encode($get->getGrades());
                break;
            default:
                echo "Invalid endpoint.";
                break;
        }

        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));

        switch ($request[0]) {
            case 'addstudent':
                echo json_encode($post->addStudent($data));
                break;
            case 'editstudent':
                echo json_encode($post->editStudent($data));
                break;

            case 'deletestudent':
                echo json_encode($post->deleteStudent($data));
                break;

            case 'addcourse':
                //  echo json_encode($get->getCourses());
                break;
            case 'addgrade':
                //  echo json_encode($get->getGrades());
                break;
            default:
                echo "Invalid endpoint.";
                break;
        }

        break;
    default:
        echo "Invalid Method";
        break;
}








// switch($request_method){
//     case "GET":

//         switch($request[0]){
//             case "getstudents":
//                 // echo json_encode($get->getStudents());
//             break;
//             case "getgrades":
//                 // echo json_encode($get->getGrades());
//             break;
//             case "getcourses":
//                 echo json_encode($get->getCourses());
//             break;
//         }

//     break;






//     case "POST":
//     break;

//     default:
//     break;
// }

$pdo = null;
