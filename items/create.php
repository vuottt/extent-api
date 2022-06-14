<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Items.php';
include_once '../class/CpanelClass.php';
include_once '../class/CpanelItems.php';

// $database = new Database();
// $db = $database->getConnection();
 
// $items = new Items($db);
 
$data = json_decode(file_get_contents("php://input"));
print_r($data);
// if(!empty($data->name) && !empty($data->description) &&
// !empty($data->price) && !empty($data->category_id) &&
// !empty($data->created)){    

//     $items->name = $data->name;
//     $items->description = $data->description;
//     $items->price = $data->price;
//     $items->category_id = $data->category_id;	
//     $items->created = date('Y-m-d H:i:s'); 
    
//     if($items->create()){         
//         http_response_code(201);         
//         echo json_encode(array("message" => "Item was created."));
//     } else{         
//         http_response_code(503);        
//         echo json_encode(array("message" => "Unable to create item."));
//     }
// }else{    
//     http_response_code(400);    
//     echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
// }
if(!empty($data->newDomain) && !empty($data->newUser) && !empty($data->newPass) && !empty($data->newPlan) && !empty($data->newEmail)) {

    $domain = $data->newDomain;
    $user = $data->newUser;
    $pasword = $data->newPass;
    $plan = $data->newPlan;
    $email = $data->newEmail;
    createAccount ($newDomain = "$domain", $newUser = "$user", $newPass = "$pasword", $newPlan = "$plan", $newEmail = "$email");
}
else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
?>