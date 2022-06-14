<?php
    function createAccount ($newDomain = "", $newUser = "", $newPass = "", $newPlan = "", $newEmail = "") {
        $whm_user = "vuottt";
        $whm_pass = "vinahost@888";
        $whm_host = "em.vinahost.vn";

        $newDomain = fixData($newDomain);
        $newUser = fixData($newUser);
        $newPlan = fixData($newPlan);

        If (!empty($newUser)) {
            // Get new session ID
            $sessID = newSession($whm_host, $whm_user, $whm_pass);

            $script = "https://www." . $whm_host . ":2087" . $sessID . "/scripts/wwwacct";
            $sData = "?plan={$newPlan}&domain={$newDomain}&username={$newUser}&password={$newPass}&contactemail={$newEmail}";

            // Authenticate User for WHM access
            $context = stream_context_create(array(
                'http' => array(
                    'header' => "Authorization: Basic " . base64_encode("{$whm_user}:{$whm_pass}"),
                ),
            ));

            // Get result
            $result = file_get_contents($script.$sData, false, $context);
            //Echo "URL: " . $script.$sData . "<br /><br />";
            // Echo "Result: " . $result;

        } Else {
            Echo "Error: Username is empty!";
        }
    }


    
    function newSession($nHost, $nUser, $nPass) {
        $ip = $nHost;
        $cp_user = $nUser;
        $cp_pwd = $nPass;
        $url = "https://$ip:2087/login";

        // Create new curl handle
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$cp_user&pass=$cp_pwd");
        curl_setopt($ch, CURLOPT_TIMEOUT, 100020);

        // Execute the curl handle and fetch info then close streams.
        $f = curl_exec($ch);
        $h = curl_getinfo($ch);
        curl_close($ch);

        // If we had no issues then try to fetch the cpsess
        if ($f == true and strpos($h['url'],"cpsess"))
        {
            // Get the cpsess part of the url
            $pattern="/.*?(\/cpsess.*?)\/.*?/is";
            $preg_res=preg_match($pattern,$h['url'],$cpsess);
        }

        // If we have a session then return it otherwise return empty string
        return (isset($cpsess[1])) ? $cpsess[1] : "";
    }

    function fixData($data) {
        $data = str_replace("-","%2D",$data);
        $data = str_replace(".","%2E",$data);
        $data = str_replace(" ","%20",$data);

        return $data;
    }

    function returnData($data) {
        $data = str_replace("%2D","-",$data);
        $data = str_replace("%2E",".",$data);
        $data = str_replace("%20"," ",$data);

        return $data;
    }
    header('Location: https://www.example.com/users');
?>
