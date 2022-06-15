<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$whm_user   = "vuottt";      
$whm_pass   = "vinahost@888"; 
// Lay data

$json = file_get_contents('php://input');

$data = json_decode($json);

//

$whm_host   = $_SERVER['HTTP_HOST'];

// function getVar($name, $def = '') {
//   // if (isset($_REQUEST[$name]))
//   //   return $_REQUEST[$name];
//   // else
//     return $data[name]
//     // return $def;
// }

if (!isset($user_domain)) {
  // $user_domain = getVar('domain');
  $user_domain = $data[domain];
}

if (!isset($user_name)) {
  // $user_name = getVar('user');
  $user_name = $data[user]
}

if (!isset($user_pass)) {
  // $user_pass = getVar('password');
  $user_pass = $data[password];
}

if (!isset($user_plan)) {
  // $user_plan = getVar('package');
  $user_plan = $data[plan];
}

if (!isset($user_email)) {
  // $user_email = getVar('email');
  $user_email = $data[email];
}

if (!empty($user_name)) {

  // create account on the cPanel server
  $script = "http://{$whm_user}:{$whm_pass}@{$whm_host}:2086/scripts/wwwacct";
  $params = "?plan={$user_plan}&domain={$user_domain}&username={$user_name}&password={$user_pass}&contactemail={$user_email}";
  $result = file_get_contents($script.$params);

  // output result
  echo "RESULT: " . $result;
}
// otherwise show input form
else {
// $frm = <<<EOD
// <html>
// <head>
//   <title>cPanel/WHM Account Creator</title>
//   <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
//   <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
// </head>
// <body>
//   <style>
//     input { border: 1px solid black; }
//   </style>
// <form method="post">
// <h3>cPanel/WHM Account Creator</h3>
// <table border="0">
// <tr><td>Domain:</td><td><input name="domain" size="30"></td><td>Subdomain or domain, without www</td></tr>
// <tr><td>Username:</td><td><input name="user" size="30"></td><td>Username to be created</td></tr>
// <tr><td>Password:</td><td><input name="password" size="30"></td><td></td></tr>
// <tr><td>Package:</td><td><input name="package" size="30"></td><td>Package (hosting plan) name. Make sure you cpecify existing package</td></tr>
// <tr><td>Contact Email:</td><td><input name="email" size="30"></td><td></td></tr>
// <tr><td colspan="3"><br /><input type="submit" value="Create Account"></td></tr>
// </table>
// </form>
// </body>
// </html>
// EOD;
// echo $frm;
}

?>