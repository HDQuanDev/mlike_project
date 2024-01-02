<?
$hdq = "ok";
$page = 'share_fb';
require_once('../../../_System/db.php');
require_once('../../../_System/config.php');
require_once('../../../module/tds.php');
require_once('../../../module/telegram.php');
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
switch ($_GET["act"]) {
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
                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Share' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['id'];
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
                    $array["data"]["$id"]["id_order"] = $ro['id'];
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
                $check = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv`='Share' AND `id` = '$id_order' AND `user` = '$login' AND `trangthai` = '7' AND (`nse` = 'Server Share 4' OR `nse` = 'Server Share 5')");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $sotien = $get["sotien"];
                    $time = time();
                    $dd = $row['vnd'];
                    $nd1 = 'Hoàn tiền mua share facebook ID (' . $id_order . '):';
                    $gtls = '+';
                    $bd = $sotien;
                    $array["status"] = 'success';
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '8' WHERE `id` = '$id_order' AND `dv` = 'Share'");
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
            $sv = mysqli_real_escape_string($db, $_POST['sv']);
            $cd = mysqli_real_escape_string($db, $_POST['gift']);
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if ($sv == 1 || $sv == 2 || $sv == 3 || $sv == 4 || $sv == 5) {
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
                                $nse = 'Server Share 1';
                                $min = '20';
                                $max = '5000';
                            } elseif ($sv == 2) {
                                $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                                $nse = 'Server Share 2';
                                $min = '100';
                                $max = '500000';
                            } elseif ($sv == 3) {
                                $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                                $nse = 'Server Share 3';
                                $min = '10';
                                $max = '1000';
                            } elseif ($sv == 4) {
                                $tongtien = ($sl * $gia4) - (($sl * $gia4) / 100 * $dis);
                                $nse = 'Server Share 4';
                                $min = '50000';
                                $max = '100000000';
                            } elseif ($sv == 5) {
                                $tongtien = ($sl * $gia5) - (($sl * $gia5) / 100 * $dis);
                                $nse = 'Server Share 5';
                                $min = '1000';
                                $max = '100000000';
                            }
                        } else {

                            if ($sv == 1) {
                                $tongtien = $sl * $gia1;
                                $nse = 'Server Share 1';
                                $min = '20';
                                $max = '5000';
                            } elseif ($sv == 2) {
                                $tongtien = $sl * $gia2;
                                $nse = 'Server Share 2';
                                $min = '100';
                                $max = '500000';
                            } elseif ($sv == 3) {
                                $tongtien = $sl * $gia3;
                                $nse = 'Server Share 3';
                                $min = '10';
                                $max = '1000';
                            } elseif ($sv == 4) {
                                $tongtien = $sl * $gia4;
                                $nse = 'Server Share 4';
                                $min = '50000';
                                $max = '100000000';
                            } elseif ($sv == 5) {
                                $tongtien = $sl * $gia5;
                                $nse = 'Server Share 5';
                                $min = '1000';
                                $max = '100000000';
                            }
                        }
                    }

                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
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
                        if ($sv == 1 || $sv == 2) {
                            $user = $s['user'];
                            $pass = $s['pass'];
                            $login_tds = json_decode(login($user, urlencode($pass)));
                            if ($login_tds->success == 'true') {
                                $date_create =  date("Y-m-d H:i:s");
                                $send_api = send_tds_share(trim($id), trim($sl), '', $date_create, $sv);
                                usleep(1000);
                                if (strpos($send_api, 'nh công') !== false) {
                                    $nd1 = 'Tăng Share Bài Viết ID:';
                                    $bd = $tongtien;
                                    $gt = '-';
                                    $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                    $goc = $row['vnd'];
                                    $time = time();
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Share',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse', `bh`='1', `sttdone` = '1'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua share Thành Công! Cảm ơn bạn!!';
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Lỗi ID tăng share vui lòng kiểu tra lại!!';
                                }
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Lỗi Server Tăng share Vui Lòng Liên Hệ Admin!';
                            }
                        } elseif ($sv == 3) {
                            $nd1 = 'Tăng Share Bài Viết ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Share',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua share Thành Công! Cảm ơn bạn!!';
                        } elseif ($sv == 4) {
                            if ($sv4 == 'on') {
                                $nd1 = 'Tăng Share Bài Viết ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();

                                $tg = date("G:i:s d/m/Y", time());
                                $send_tele = telegram_send('27876', '<b>***Bạn vừa có một đơn hàng Share Facebook Mới***</b>%0A- ID: <a href="https://facebook.com/' . $id . '">' . $id . '</a>%0A- Số lượng: ' . $sl . ' Share%0A- Người mua: <a href="https://mlike.vn/admin/user.php?edit=' . $login . '">' . $login . '</a>%0A- Thời Gian: ' . $tg . '%0A- Để kiểm tra vui lòng: <a href="https://mlike.vn/admin/liketay.php">ấn vào đây</a>%0A(<b>QBOT Notification</b>)');
                                $send_tele = json_decode($send_tele);
                                if ($send_tele->ok == 'true') {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Share',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua share Thành Công! Cảm ơn bạn!!';
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại 100!!';
                                }
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Server đang đóng, vui lòng sử dụng server khác!!';
                            }
                        } elseif ($sv == 5) {
                            if ($sv5 == 'on') {
                                $nd1 = 'Tăng Share Bài Viết ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();

                                $tg = date("G:i:s d/m/Y", time());
                                $send_tele = telegram_send('27876', '<b>***Bạn vừa có một đơn hàng Share Facebook Mới***</b>%0A- ID: <a href="https://facebook.com/' . $id . '">' . $id . '</a>%0A- Số lượng: ' . $sl . ' Share%0A- Người mua: <a href="https://mlike.vn/admin/user.php?edit=' . $login . '">' . $login . '</a>%0A- Thời Gian: ' . $tg . '%0A- Để kiểm tra vui lòng: <a href="https://mlike.vn/admin/liketay.php">ấn vào đây</a>%0A(<b>QBOT Notification</b>)');
                                $send_tele = json_decode($send_tele);
                                if ($send_tele->ok == 'true') {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Share',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua share Thành Công! Cảm ơn bạn!!';
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại 100!!';
                                }
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Server đang đóng, vui lòng sử dụng server khác!!';
                            }
                        }
                    }
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Lỗi Server Tăng Share Không Đúng!';
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
