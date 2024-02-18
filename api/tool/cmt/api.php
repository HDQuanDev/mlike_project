<?
$hdq = "ok";
$page = 'cmt_fb';
require_once('../../../_System/config.php');
require_once('../../../_System/db.php');
$gia = $gia1;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
$array = [];
switch ($_GET['act']) {
    case 'getlist':
        if (isset($_POST['token']) && isset($_POST['limit'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $sort = mysqli_real_escape_string($db, $_POST['sort']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `rule` = '99' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $quan = [];
                if ($sort == 'desc') {
                    $result1 = mysqli_query($db, "SELECT * FROM `dv_cmt` WHERE `trangthai` = '1' ORDER BY id DESC LIMIT $limit");
                } elseif ($sort == 'asc') {
                    $result1 = mysqli_query($db, "SELECT * FROM `dv_cmt` WHERE `trangthai` = '1' ORDER BY id ASC LIMIT $limit");
                } else {
                    $result1 = mysqli_query($db, "SELECT * FROM `dv_cmt` WHERE `trangthai` = '1' ORDER BY id DESC LIMIT $limit");
                }
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['profile'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['server'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $cmt = $ro['cmt'];
                    $cmt = preg_replace("/\r\n|\r|\n/", "|", $cmt);
                    $quan["id"] = "$id";
                    $quan["number"] = "$sl";
                    $quan["done"] = "$done";
                    $quan["server"] = "$sv";
                    $quan["user"] = "$user";
                    $quan["cmt"] = "$cmt";
                    $quan["time"] = "$t";
                    $quan["status"] = "$tt";
                    $quan["id_order"] = $ro['id'];
                    $array["data"][] = $quan;
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;
    case 'updatedata':
        if (isset($_POST['token']) && isset($_POST['id_order'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $id_order = mysqli_real_escape_string($db, $_POST['id_order']);
            $done = mysqli_real_escape_string($db, $_POST['done']);
            $status = mysqli_real_escape_string($db, $_POST['status']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `rule` = '99' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $check = mysqli_query($db, "SELECT * FROM `dv_cmt` WHERE `id` = '$id_order'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $array["status"] = 'success';
                    mysqli_query($db, "UPDATE `dv_cmt` SET `done` = '$done', `trangthai` = '$status' WHERE `id` = '$id_order'");
                    $array["msg"] = 'Update thành công!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại!';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;
}
