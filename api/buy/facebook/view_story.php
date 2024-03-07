<?
$hdq = "ok";
$page = 'view_story';
require_once('../../../_System/db.php');
include('../../../module/tds.php');
$gia = $gia1;
$min = '50';
$max = '10000';
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
switch ($_GET['act']) {
    case 'history':
        if (isset($_POST['token']) && isset($_POST['limit'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_viewstory' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    if ($_GET['type'] == 'id_order') {
                        $id = $ro['id'];
                    } else {
                        $id = $ro['profile'];
                    }
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["$id"]["id"] = "$profile";
                    $array["data"]["$id"]["number"] = "$sl";
                    $array["data"]["$id"]["done"] = "$done";
                    $array["data"]["$id"]["server"] = "$sv";
                    $array["data"]["$id"]["user"] = "$user";
                    $array["data"]["$id"]["time"] = "$t";
                    $array["data"]["$id"]["status"] = "$tt";
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
    case 'history_id':
        if (isset($_POST['token']) && isset($_POST['limit']) && isset($_POST['id'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_viewstory' AND `id` = '$id' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    if ($_GET['type'] == 'id_order') {
                        $id = $ro['id'];
                    } else {
                        $id = $ro['profile'];
                    }
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["id"] = "$profile";
                    $array["data"]["number"] = "$sl";
                    $array["data"]["done"] = "$done";
                    $array["data"]["server"] = "$sv";
                    $array["data"]["user"] = "$user";
                    $array["data"]["time"] = "$t";
                    $array["data"]["status"] = "$tt";
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
    case 'cancel_order':
        if (isset($_POST['token']) && isset($_POST['id_order'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $id_order = mysqli_real_escape_string($db, $_POST['id_order']);
            $done = mysqli_real_escape_string($db, $_POST['done']);
            $status = mysqli_real_escape_string($db, $_POST['status']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $check = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv`='fb_viewstory' AND `id` = '$id_order' AND `user` = '$login' AND `trangthai` = '7' AND `nse` = 'Server View Story 2'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $sotien = $get["sotien"];
                    $time = time();
                    $dd = $row['vnd'];
                    $nd1 = 'Hoàn tiền mua view story facebook ID (' . $id_order . '):';
                    $gtls = '+';
                    $bd = $sotien;
                    $array["status"] = 'success';
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '8' WHERE `id` = '$id_order' AND `dv` = 'fb_viewstory'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$sotien' WHERE `username` = '$login'");
                    $array["msg"] = 'Hủy và hoàn tiền đơn hàng ' . $id_order . ' thành công!';
                    $array["sotien"] = $bd;
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại, hoặc trạng thái đơn không hợp lệ để hủy!';
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
    default:
        if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv'])) {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $sl = mysqli_real_escape_string($db, $_POST['sl']);
            $cd = mysqli_real_escape_string($db, $_POST['gift']);
            $sv = mysqli_real_escape_string($db, $_POST['sv']);
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if (isset($cd)) {
                    if (isset($cd)) {
                        $gt = time();
                        $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
                        $tko = mysqli_num_rows($tko);
                        if ($tko == 1) {
                            $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                            $u = mysqli_fetch_assoc($u);
                            $dis = $u['dis'];
                            if ($sv == 1) {
                                $tongtien = ($sl * $gia1) - (($sl * $gia1) / 100 * $dis);
                                $nse = 'Server View Story 1';
                                $min = '1000';
                                $max = '100000';
                            } elseif ($sv == 2) {
                                $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                                $nse = 'Server View Story 2';
                                $min = '1000';
                                $max = '20000';
                            }
                        } else {
                            if ($sv == 1) {
                                $tongtien = $sl * $gia1;
                                $nse = 'Server View Story 1';
                                $min = '100';
                                $max = '20000';
                            } elseif ($sv == 2) {
                                $tongtien = $sl * $gia2;
                                $nse = 'Server View Story 2';
                                $min = '1000';
                                $max = '20000';
                            }
                        }
                    }
                }
                if (empty($id)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số ID Story Facebook!';
                } elseif (empty($sl)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số lượng View!';
                } elseif ($sl < $min) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
                } elseif ($sl > $max) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng tối đa ' . $max . '!';
                } elseif ($row['vnd'] < $tongtien) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Bạn không đủ tiền!';
                } else {
                    if ($sv == 1) {
                        $nd1 = 'Tăng View Story ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(' . $nse . ') ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $user = $s['user'];
                        $pass = $s['pass'];
                        $login_tds = json_decode(login($user, urlencode($pass)));
                        if ($login_tds->success == 'true') {
                            $date_create =  date("Y-m-d H:i:s");
                            $send_api = send_tds_story(trim($id), trim($sl), '', $date_create);
                            usleep(1000);
                            if (strpos($send_api, 'nh công') !== false) {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_viewstory',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Lỗi Link story, vui lòng thử lại!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Lỗi Server, vui lòng đợi ít phút và thửu lại!';
                        }
                    } elseif ($sv == 2) {
                        $nd1 = 'Tăng View Story ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(' . $nse . ') ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $tach = explode("/", $id);
                        $id = $tach[5];
                        if (empty($id)) {
                            $array["status"] = 'error';
                            $array["msg"] = 'Link story không hợp lệ!';
                        } else {
                            $check_id = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `nse` = 'Server View Story 2'");
                            $check_id = mysqli_num_rows($check_id);
                            if ($check_id == 0) {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_viewstory',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'ID Story đã được mua trước đó, mỗi ID chỉ được mua 1 lần!';
                            }
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng chọn server!';
                    }
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
