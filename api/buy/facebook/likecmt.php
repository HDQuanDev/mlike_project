<?php

$hdq = "ok";
$page = 'fb_likecmt';
require_once('../../../_System/db.php');
include('../../../module/tlc.php');
require_once('../../../module/tds.php');
require_once('../../../module/telegram.php');
$min = '20';
$max = '20000';
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
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_likecmt' ORDER BY id DESC LIMIT $limit");
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
    default:
        if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv']) && isset($_POST['cx'])) {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $sl = mysqli_real_escape_string($db, $_POST['sl']);
            $cx = mysqli_real_escape_string($db, $_POST['cx']);
            $sv = mysqli_real_escape_string($db, $_POST['sv']);
            $cd = mysqli_real_escape_string($db, $_POST['gift']);
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if ($sv == 1 || $sv == 2 || $sv == 3) {
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
                                $nse = 'Server Like 1';
                            } elseif ($sv == 2) {
                                $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                                $nse = 'Server Like 2';
                            } elseif ($sv == 3) {
                                $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                                $nse = 'Server Like 3';
                                $min = '2000';
                            }
                        } else {

                            if ($sv == 1) {
                                $tongtien = ($sl * $gia1);
                                $nse = 'Server Like 1';
                            } elseif ($sv == 2) {
                                $tongtien = ($sl * $gia2);
                                $nse = 'Server Like 2';
                            } elseif ($sv == 3) {
                                $tongtien = ($sl * $gia3);
                                $nse = 'Server Like 3';
                                $min = '2000';
                            }
                        }
                    }
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Comment Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif (empty($cx)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng chọn cảm xúc muốn tăng!';
                    } elseif ($sl < $min) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
                    } elseif ($sl > $max) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $max . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        if ($sv == 2) {
                            $nd1 = 'Mua Like Comment Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(2) ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            $cxx = strtolower($cx);
                            $send_tlc = json_decode(tlc_likecmt($id, $sl, $cxx));
                            if ($send_tlc->success == 'true') {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_likecmt',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='1', `sttdone` = '0'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại!!';
                            }
                        } elseif ($sv == 1) {
                            $nd1 = 'Mua Like Comment Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(2) ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            $user = $s['user'];
                            $pass = $s['pass'];
                            $login_tds = json_decode(login($user, urlencode($pass)));
                            if ($login_tds->success == 'true') {
                                $date_create =  date("Y-m-d H:i:s");
                                $send_api = send_tds_likecmt(trim($id), trim($sl), '', $date_create, $cx);
                                usleep(1000);
                                if (strpos($send_api, 'nh công') !== false) {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_likecmt',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='2', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                    $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                    $rr = mysqli_fetch_assoc($r);
                                    $array["id_order"] = $rr['id'];
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                                }
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại!!';
                            }
                        } elseif ($sv == '3') {
                            $cres = mysqli_query($db, "SELECT sum(`sl`) FROM `dv_other` WHERE `dv` = 'fb_likecmt' AND `bh` = '444' AND `profile` = '$id'");
                            $crow = mysqli_fetch_row($cres);
                            $lcheckl = $crow[0];
                            $lcheck = $lcheckl + $sl;
                            $mcheck = 10000 - $lcheckl;
                            if ($cx !== "LIKE") {
                                $array["status"] = 'error';
                                $array["msg"] = 'Server này chỉ có thể sử dụng cảm xúc Like, vui lòng thử lại!!';
                            } elseif ($lcheck > '10000') {
                                $array["status"] = 'error';
                                $array["msg"] = 'Số lượng tối đa của 1 ID có thể mua là 10000 Like (Bạn có thể mua thêm ' . $mcheck . ' Like cho ID nay)!';
                            } else {
                                $nd1 = 'Mua Like Comment Facebook ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(3) ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $tg = date("G:i:s d/m/Y", time());
                                $send_tele = telegram_send('***Bạn vừa có một đơn hàng Like Cmt Mới***%0A- ID: <a href="https://facebook.com/' . $id . '">' . $id . '</a>%0A- Số lượng: ' . $sl . ' Like%0A- Người mua: <a href="https://mlike.vn/admin/user.php?edit=' . $login . '">' . $login . '</a>%0A- Thời Gian: ' . $tg . '%0A- Để kiểm tra vui lòng: <a href="https://mlike.vn/admin/like_cmt.php">ấn vào đây</a>%0A(<b>QBOT Notification</b>)');
                                $send_tele = json_decode($send_tele);
                                $time = time();
                                if (isset($time)) {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_likecmt',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `bh`='444', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                    $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                    $rr = mysqli_fetch_assoc($r);
                                    $array["id_order"] = $rr['id'];
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại 100!!';
                                }
                            }
                        }
                    }
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Lỗi Server Tăng Like Không Đúng!';
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
