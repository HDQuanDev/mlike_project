<?php

$hdq = "ok";
$page = 'view_fb';
require_once('../../../_System/db.php');
require_once('../../../_System/config.php');
require_once('../../../module/view.php');
require_once('../../../module/buffviewer.php');
$gia = $gia1;
$min = '1000';
$max = '10000000';
$mgr = 'VIEW_LUCKY';

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
                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'view' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['id'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['start'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['sv'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["$id"]["id"] = "$profile";
                    $array["data"]["$id"]["number"] = "$sl";
                    $array["data"]["$id"]["start"] = "$start";
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
    case 'history2':
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
                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'view' AND `profile` = '$id' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['start'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['sv'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["number"] = "$sl";
                    $array["data"]["start"] = "$start";
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
                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'view' AND `id` = '$id' ORDER BY id DESC LIMIT 1");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['start'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['sv'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["id"] = "$profile";
                    $array["data"]["number"] = "$sl";
                    $array["data"]["start"] = "$start";
                    $array["data"]["done"] = "$done";
                    $array["data"]["server"] = "$sv";
                    $array["data"]["user"] = "$user";
                    $array["data"]["time"] = "$t";
                    $array["data"]["status"] = "$tt";
                    $array["data"]["id_order"] = $ro['id'];
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
                $check = mysqli_query($db, "SELECT * FROM `video` WHERE (`code` = '14' OR `code` = '1410') AND `time` > '1693286127' AND `id` = '$id_order' AND `user` = '$login' AND `trangthai` = '7'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $sotien = $get["sotien"];
                    $time = time();
                    $dd = $row['vnd'];
                    $nd1 = 'Hoàn tiền mua view facebook ID (' . $id_order . '):';
                    $gtls = '+';
                    $bd = $sotien;
                    $array["status"] = 'success';
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `video` SET `trangthai` = '8' WHERE `id` = '$id_order'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$sotien' WHERE `username` = '$login'");
                    $array["msg"] = 'Hủy và hoàn tiền đơn hàng ' . $id_order . ' thành công!';
                    $array["sotien"] = $bd;
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại hoặc ID_ORDER không nằm trong danh sách, trạng thái đơn không hợp lệ để hủy!';
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
            $tdd = mysqli_real_escape_string($db, $_POST['sv']);
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if ($tdd == '1') {
                    $td = '0';
                    $tongtien = $sl * $gia * $tdd;
                    $sv = 'Bình thường';
                } elseif ($tdd == '2') {
                    $td = '1';
                    $tongtien = $sl * $gia * 1.5;
                    $sv = 'Tốc độ nhanh';
                } elseif ($tdd == '3') {
                    $tongtien = $sl * $gia2;
                    $sv = 'Server View 3';
                    $min = '1000';
                } elseif ($tdd == '4') {
                    $tongtien = $sl * $gia3;
                    $sv = 'Server View 4';
                    $min = '1000';
                } elseif ($tdd == '5') {
                    $tongtien = $sl * $gia4;
                    $sv = 'Server View 5';
                    $min = '1000';
                } elseif ($tdd == '6') {
                    $tongtien = $sl * $gia5;
                    $sv = 'Server View 6';
                    $min = '100000';
                } elseif ($tdd == '7') {
                    $tongtien = 600000 * $gia6;
                    $sv = '600K Phút';
                    $min = '600000';
                    $max = '600000';
                } elseif ($tdd == '8') {
                    $tongtien = 60000 * $gia7;
                    $sv = '60K Phút';
                    $min = '60000';
                    $max = '60000';
                }
                if (filter_var($id, FILTER_VALIDATE_URL) == false) {
                    if (!is_numeric($id)) {
                        echo '{"status":"error","msg":"Link/ID Video Facebook không hợp lệ, vui lòng nhập lại!","link":"' . $id . '"}';
                        exit;
                    }
                }
                if (empty($id)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số ID Video Facebook!';
                } elseif (empty($sl)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số lượng View!';
                } elseif ($sl < $min) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
                } elseif ($sl > $max) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng tối đa ' . $max . '!';
                } elseif ($sl % 500 != 0) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng phải là cấp số nhân của 500!';
                } elseif ($row['vnd'] < $tongtien) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Bạn không đủ tiền!';
                } else {

                    if ($tdd == '7') {
                        if ($sv7 == 'on') {
                            $nd1 = 'Tăng View Video Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '203', `sttdone` = '0', `done` = '0', `code`='1410', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd == '8') {
                        if ($sv8 == 'on') {
                            $nd1 = 'Tăng View Video Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '203', `sttdone` = '0', `done` = '0', `code`='1410', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd == '6') {
                        if ($sv6 == 'on') {
                            $nd1 = 'Tăng View Video Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '203', `sttdone` = '0', `done` = '0', `code`='1410', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd == '5') {
                        if ($sv5 == 'on') {
                            if ($tay_or_auto == 'auto') {
                                $buffview = bv_viewfb($id, $sl, '1', $mgr);
                                $buffview = json_decode($buffview);
                            } elseif ($tay_or_auto == 'tay') {
                                $buffview = [];
                                $buffview['status'] = 'true';
                                $buffview = json_encode($buffview);
                                $buffview = json_decode($buffview);
                            }
                            if ($buffview->status == 'true') {
                                $nd1 = 'Tăng View Video Facebook ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '203', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại nếu lỗi vẫn tiếp tục xảy ra vui lòng liên hệ admin!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd == '4') {
                        if ($sv4 == 'on') {
                            if ($tay_or_auto == 'auto') {
                                $buffview = bv_viewfb($id, $sl, '1', $mgr);
                                $buffview = json_decode($buffview);
                            } elseif ($tay_or_auto == 'tay') {
                                $buffview = [];
                                $buffview['status'] = 'true';
                                $buffview = json_encode($buffview);
                                $buffview = json_decode($buffview);
                            }
                            if ($buffview->status == 'true') {
                                $nd1 = 'Tăng View Video Facebook ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '203', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại nếu lỗi vẫn tiếp tục xảy ra vui lòng liên hệ admin!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd == '3') {
                        if ($sv3 == 'on') {
                            $nd1 = 'Tăng View Video Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            if ($s['congtac_viewfb'] == 'uutien') {
                                $sldon = check_view(3);
                            } else {
                                $sldon = 0;
                            }
                            if ($s['congtac_viewfb'] == 'uutien') {
                                if ($sldon > 0) {
                                    $buff = view($id, $sl, '1', $mgr);
                                    $buff = json_decode($buff);
                                    if ($buff->data[0]->status == 'true') {
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                        $idgdd = $buff->data[0]->id;
                                        mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '$idgdd', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '2', `sv` = '$sv', `sotien` = '$tongtien'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                        $array["status"] = 'success';
                                        $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                        $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                        $rr = mysqli_fetch_assoc($r);
                                        $array["id_order"] = $rr['id'];
                                    } else {
                                        $array["status"] = 'error';
                                        $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại!';
                                    }
                                } else {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '2003', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                    $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                    $rr = mysqli_fetch_assoc($r);
                                    $array["id_order"] = $rr['id'];
                                }
                            } elseif ($s['congtac_viewfb'] == 'tay') {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `idgd` = '2003', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '0', `sv` = '$sv', `sotien` = '$tongtien'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } elseif ($s['congtac_viewfb'] == 'autofb') {
                                $buff = view_autofb($id, $sl);
                                $buff = json_decode($buff);
                                if ($buff->status == '200') {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    $start = $buff->data->start;
                                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = '$start', `idgd` = '', `sttdone` = '0', `done` = '0', `code`='14', `auto` = '2', `sv` = '$sv', `sotien` = '$tongtien'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                    $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                                    $rr = mysqli_fetch_assoc($r);
                                    $array["id_order"] = $rr['id'];
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = '' . $buff->message . '';
                                }
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang quá tải vui lòng dùng server khác';
                        }
                    } elseif ($tdd < 3) {
                        $buff = view($id, $sl, $td, $mgr);
                        $buff = json_decode($buff);
                        if ($buff->data[0]->status == 'true') {
                            $nd1 = 'Tăng View Video Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $idgdd = $buff->data[0]->id;
                            mysqli_query($db, "INSERT INTO `video` SET `dv` = 'view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$td', `idgd` = '$idgdd', `sttdone` = '0', `done` = '0', `code`='0', `sv` = '$sv', `sotien` = '$tongtien'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT `id` FROM `video` ORDER BY `video`.`id` DESC LIMIT 1");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->data[0]->message[0] . '';
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng chọn tốc độ/Server!!';
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
