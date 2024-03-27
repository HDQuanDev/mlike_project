<?php

header('Content-Type: text/html; charset=UTF-8');
set_time_limit(0);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/viewyt.php');
require_once('../module/tds.php');
require_once('../module/tiktok.php');
$apii = new Api();
switch ($_GET["service"]) {
    case 'like':
        switch ($_GET["act"]) {
            case 'buy':
                $data = json_decode(file_get_contents("php://input"));
                $api = $data->api;
                $sl = $data->number;
                $id = $data->id;
                $sv = $data->sv;
                $vip = $data->vip;
                if (isset($api) && isset($sl) && isset($id) && isset($sv)) {
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $tk = $u['username'];
                        $quan = array();
                        if ($sv == '1') {
                            if (isset($vip) && $vip == 'quandz') {
                                $tongtien = $sl * 1.6;
                            } else {
                                $tongtien = $sl * 2.5;
                            }
                            if (empty($id)) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                            } elseif (empty($sl)) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Vui lòng nhập số lượng Like!';
                            } elseif ($sl < 100) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Số lượng phải lớn hơn 100 Like';
                            } elseif ($sl > $s['max1']) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Số lượng tối đa ' . $s['max1'] . ' Like 1 lần ( Có thể order nhiều lần )!';
                            } elseif ($u['vnd'] < $tongtien) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Bạn không đủ tiền!';
                            } elseif (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Vui lòng sử dụng ID Post không sử dụng LINK!';
                            } else {
                                $qua = $s['tds_or_xule'];
                                $t = $s['tlc'];
                                if ($qua == 'tds') {
                                    $nd1 = 'Mua Like Bài Viết ID:';
                                    $bd = $tongtien;
                                    $gt = '-';
                                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                    $goc = $u['vnd'];
                                    $time = time();
                                    $user = $s['user'];
                                    $pass = $s['pass'];
                                    $login_tds = json_decode(login($user, urlencode($pass)));
                                    if ($login_tds->success == 'true') {
                                        $date_create =  date("Y-m-d H:i:s");
                                        $send_api = send_tds(trim($id), trim($sl), 'hdq1', $date_create);
                                        if (strpos($send_api, 'nh công') !== false) {
                                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1', `site` = '$site'");
                                            $sve = 'Server Like 1';
                                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$tk',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '1', `bh`='1', `sttdone` = '0'");
                                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                            $quan["status"] = 'success';
                                            $quan["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                        } else {
                                            $quan["status"] = 'error';
                                            $quan["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                                        }
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = 'Lỗi server tăng like vui lòng liên hệ admin!!';
                                    }
                                } elseif ($qua == 'xule') {

                                    $nd1 = 'Mua Like Bài Viết ID:';
                                    $bd = $tongtien;
                                    $gt = '-';
                                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                    $goc = $u['vnd'];
                                    $time = time();
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    $sve = 'Server Like 1';
                                    $cod = rand(1000, 999999999);
                                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `code` = '$cod', `user`='$tk',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '1', `bh`='19', `sttdone` = '0', `iddon` = '2005'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                    $quan["status"] = 'success';
                                    $quan["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                } elseif ($qua == 'bao') {
                                    $quann = json_decode(baostar($id, $sl));
                                    if ($quann->status == '200') {
                                        $nd1 = 'Mua Like Bài Viết ID:';
                                        $bd = $tongtien;
                                        $gt = '-';
                                        $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                        $goc = $u['vnd'];
                                        $time = time();
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                        $sve = 'Server Like 1';
                                        $cod = rand(1000, 999999999);
                                        mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '2', `code` = '$cod', `user`='$tk',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '$sl', `nse` = '1', `bh`='1', `sttdone` = '0', `iddon` = '2005'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                        $quan["status"] = 'success';
                                        $quan["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = $quann->message;
                                    }
                                } elseif ($qua == 'tlc') {
                                    $send_tlc = json_decode(sv2_low($id, $sl, $t));
                                    if ($send_tlc->success == 'true') {
                                        $nd1 = 'Mua Like Bài Viết ID:';
                                        $bd = $tongtien;
                                        $gt = '-';
                                        $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                        $goc = $u['vnd'];
                                        $time = time();
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                        $sve = 'Server Like 1';
                                        $cod = rand(1000, 999999999);
                                        mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `code` = '$cod', `user`='$tk',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='98', `sttdone` = '0', `iddon` = '2005'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                        $quan["status"] = 'success';
                                        $quan["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = $send_tlc->message;
                                    }
                                }
                            }
                        } elseif ($sv == '4') {
                            $tongtien = $sl * 10;
                            if (empty($id)) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                            } elseif (empty($sl)) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Vui lòng nhập số lượng Like!';
                            } elseif ($sl < $s['min4']) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Số lượng phải lớn hơn ' . $s['min4'] . ' Like';
                            } elseif ($sl > $s['max4']) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Số lượng tối đa ' . $s['max4'] . ' Like 1 lần ( Có thể order nhiều lần )!';
                            } elseif ($u['vnd'] < $tongtien) {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Bạn không đủ tiền!';
                            } else {
                                $nd1 = 'Mua Like Bài Viết ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(4) ' . $id . ' (' . $sl . ')';
                                $goc = $u['vnd'];
                                $time = time();
                                $url = 'https://graph.facebook.com/' . $id . '/likes?summary=true&access_token=' . $s['token'] . '';
                                $check = json_decode(file_get_contents($url));
                                $total_like = $check->data[0]->summary->total_count;
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                $sve = 'Server Like Tay';
                                mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$tk',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '4', `bh`='1', `sttdone` = '0', `code` = '$total_like'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                $quan["status"] = 'success';
                                $quan["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                $quan["like_goc"] = '' . $total_like . '';
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;

            case 'check':
                $data = json_decode(file_get_contents("php://input"));
                $api = $data->api;
                $id = $data->id;
                $quan = array();
                if (isset($api) && isset($id)) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tkk = mysqli_num_rows($u);
                    if ($tkk == '1') {
                        $ui = mysqli_fetch_assoc($u);
                        $user = $ui["username"];
                        $uu = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `profile`='$id' AND `user` = '$user'");
                        $tko = mysqli_num_rows($uu);
                        if ($tko == '1') {
                            $u = mysqli_fetch_assoc($uu);
                            $quan["status"] = 'success';
                            $quan["id"] = $u['profile'];
                            $quan["number"] = $u['sl'];
                            $quan["like_goc"] = $u['code'];
                            $quan["done"] = $u['done'];
                            $quan["trangthai"] = $u['trangthai'];
                            $quan["msg"] = 'Lấy thành công!';
                        } else {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Không tìm thấy đơn!';
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;
        }
        break;
    case 'view_tiktok':
        switch ($_GET["act"]) {
            case 'buy':
                $page = 'view_tt';
                require_once('../_System/config.php');
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $sl = mysqli_real_escape_string($db, $data->number);
                $id = mysqli_real_escape_string($db, $data->link);
                $sv = mysqli_real_escape_string($db, $data->sv);
                if (isset($api) && isset($sl) && isset($id) && isset($sv)) {
                    if ($sv == 1) {
                        $gia = 0.06;
                        $nse = 'Server View 1';
                        $min = 10000;
                        $max = 100000000;
                    } elseif ($sv == 2) {
                        $gia = 0.039;
                        $nse = 'Server View 2';
                        $min = 50000;
                        $max = 100000000;
                    } elseif ($sv == 3) {
                        $gia = 0.039;
                        $nse = 'Server View 3';
                        $min = 100000;
                        $max = 100000000;
                    }
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $tk = $u['username'];
                        $quan = array();
                        $tongtien = $sl * $gia;
                        if (empty($id)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập Link Video TikTok!';
                        } elseif (empty($sl)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số lượng View!';
                        } elseif ($sl < $min) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng phải lớn hơn ' . $min . ' View';
                        } elseif ($sl > $max) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng tối đa ' . $max . ' View!';
                        } elseif ($sv == 1 && $sv1 == 'off') {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Server 1 đang bảo trì vui lòng thử lại sau!';
                        } elseif ($sv == 2 && $sv2 == 'off') {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Server 2 đang bảo trì vui lòng thử lại sau!';
                        } elseif ($sv == 3 && $sv3 == 'off') {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Server 3 đang bảo trì vui lòng thử lại sau!';
                        } elseif ($u['vnd'] < $tongtien) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Bạn không đủ tiền!';
                        } else {
                            $nd1 = 'Tăng View TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $u['vnd'];
                            $time = time();
                            if ($sv == 1) {
                                $order = $apii->order(array('service' => 000000000, 'link' => '' . $id . '', 'quantity' => $sl));
                            } elseif ($sv == 2) {
                                $order = $apii->order(array('service' => 000000000, 'link' => '' . $id . '', 'quantity' => $sl));
                            } elseif ($sv == 3) {
                                $order = $apii->order(array('service' => 000000000, 'link' => '' . $id . '', 'quantity' => $sl));
                            }
                            if (isset($order)) {
                                $tt = json_decode(check_tt($id, "view"));
                                $ttid = $tt->id;
                                $ttview = $tt->view;
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$tk',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $num = $rr["id"];
                                $quan["status"] = 'success';
                                $quan["msg"] = 'Mua View Thành Công! Cảm ơn bạn!! ' . $sv1 . '';
                                $quan["id_order"] = $num;
                                $quan["goc"] = $ttview;
                            } else {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'lỗi';
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Dữ Liệu Truyền Vào Không Đúng!!';
                }
                echo json_encode($quan);
                break;

            case 'check':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $id = mysqli_real_escape_string($db, $data->id);
                $quan = array();
                if (isset($api) && isset($id)) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tkk = mysqli_num_rows($u);
                    if ($tkk == '1') {
                        $ui = mysqli_fetch_assoc($u);
                        $user = $ui["username"];
                        $uu = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `id`='$id' AND `user` = '$user'");
                        $tko = mysqli_num_rows($uu);
                        if ($tko == '1') {
                            $u = mysqli_fetch_assoc($uu);
                            $quan["status"] = 'success';
                            $quan["link"] = $u['profile'];
                            $quan["number"] = $u['sl'];
                            $quan["done"] = $u['done'];
                            $quan["goc"] = $u['iddon'];
                            $quan["msg"] = 'Lấy thành công!';
                        } else {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Không tìm thấy đơn!';
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;
        }
        break;
    case 'share_fb':
        switch ($_GET["act"]) {
            case 'buy':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $sl = mysqli_real_escape_string($db, $data->number);
                $id = mysqli_real_escape_string($db, $data->link);
                $sv = mysqli_real_escape_string($db, $data->sv);
                if (isset($api) && isset($sl) && isset($id) && isset($sv)) {
                    if ($sv == 1) {
                        $gia = 20;
                        $nse = 'Server Share 1';
                        $min = 20;
                        $max = 1000;
                    } elseif ($sv == 2) {
                        $gia = 6;
                        $nse = 'Server Share 2';
                        $min = 100;
                        $max = 100000;
                    }
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $tk = $u['username'];
                        $quan = array();
                        $tongtien = $sl * $gia;
                        if (empty($id)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập Link Bài Viết!';
                        } elseif (empty($sl)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số lượng Share!';
                        } elseif ($sl < $min) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng phải lớn hơn ' . $min . ' Share';
                        } elseif ($sl > $max) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng tối đa ' . $max . ' Share!';
                        } elseif ($u['vnd'] < $tongtien) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Bạn không đủ tiền!';
                        } else {
                            $nd1 = 'Tăng Share Bài Viết ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $u['vnd'];
                            $time = time();
                            if ($sv == 1 || $sv == 2) {
                                $user = $s['user'];
                                $pass = $s['pass'];
                                $login_tds = json_decode(login($user, urlencode($pass)));
                                if ($login_tds->success == 'true') {
                                    $date_create =  date("Y-m-d H:i:s");
                                    $send_api = send_tds_share(trim($id), trim($sl), '', $date_create, $sv);
                                    if (strpos($send_api, 'nh công') !== false) {
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                        mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Share',`sl` = '$sl', `trangthai` = '2', `user`='$tk',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse', `bh`='1', `sttdone` = '1'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                        $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                                        $rr = mysqli_fetch_assoc($r);
                                        $num = $rr["id"];
                                        $quan["status"] = 'success';
                                        $quan["msg"] = 'Mua Share Thành Công! Cảm ơn bạn!!';
                                        $quan["id_order"] = $num;
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = 'Lỗi ID tăng share vui lòng kiểm tra lại!!';
                                    }
                                } else {
                                    $quan["status"] = 'error';
                                    $quan["msg"] = 'Server đang tạm bảo trì, vui lòng thử lại sau ít phút';
                                }
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Dữ Liệu Truyền Vào Không Đúng!!';
                }
                echo json_encode($quan);
                break;

            case 'check':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $id = mysqli_real_escape_string($db, $data->id);
                $quan = array();
                if (isset($api) && isset($id)) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tkk = mysqli_num_rows($u);
                    if ($tkk == '1') {
                        $ui = mysqli_fetch_assoc($u);
                        $user = $ui["username"];
                        $uu = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Share' AND `id`='$id' AND `user` = '$user'");
                        $tko = mysqli_num_rows($uu);
                        if ($tko == '1') {
                            $u = mysqli_fetch_assoc($uu);
                            $quan["status"] = 'success';
                            $quan["link"] = $u['profile'];
                            $quan["number"] = $u['sl'];
                            $quan["done"] = $u['done'];
                            $quan["msg"] = 'Lấy thành công!';
                        } else {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Không tìm thấy đơn!';
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;
        }
        break;
    case 'like_tt':
        switch ($_GET["act"]) {
            case 'buy':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $sl = mysqli_real_escape_string($db, $data->number);
                $id = mysqli_real_escape_string($db, $data->link);
                $sv = mysqli_real_escape_string($db, $data->sv);
                $tt = json_decode(check_tt($id, "view"));
                $ttid = $tt->id;
                $ttview = $tt->tim;
                if (isset($api) && isset($sl) && isset($id) && isset($sv)) {
                    if ($sv == 4) {
                        $gia = 11;
                        $nse = 'Server Like 4';
                        $min = 100;
                        $max = 10000;
                    }
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $tk = $u['username'];
                        $quan = array();
                        $tongtien = $sl * $gia;
                        if (empty($id)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số ID cần tăng Tim TikTok!';
                        } elseif (empty($sl)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số lượng Tim!';
                        } elseif ($sl < $min) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng phải lớn hơn ' . $min . ' Tim';
                        } elseif ($sl > $max) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng tối đa ' . $max . ' Tim!';
                        } elseif ($u['vnd'] < $tongtien) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Bạn không đủ tiền!';
                        } else {
                            $ur = urlencode($id);
                            $nd1 = 'Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $u['vnd'];
                            $time = time();
                            if ($sv == 4) {
                                $user = $s['user'];
                                $pass = $s['pass'];
                                $login_tds = json_decode(login($user, urlencode($pass)));
                                if ($login_tds->success == 'true') {
                                    $date_create =  date("Y-m-d H:i:s");
                                    $send_api = send_tds_tt('like', trim($ur), trim($sl), '', $date_create);
                                    if (strpos($send_api, 'nh công') !== false) {
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                        mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$tk',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `idgd` = '', `cmt` = '$ttid', `iddon` = '$ttview'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                        $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                        $rr = mysqli_fetch_assoc($r);
                                        $num = $rr["id"];
                                        $quan["status"] = 'success';
                                        $quan["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                                        $quan["id_order"] = $num;
                                        $quan["goc"] = $ttview;
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = 'Lỗi ID tăng tim vui lòng kiểm tra lại!!';
                                    }
                                } else {
                                    $quan["status"] = 'error';
                                    $quan["msg"] = 'Server đang tạm bảo trì, vui lòng thử lại sau ít phút';
                                }
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Dữ Liệu Truyền Vào Không Đúng!!';
                }
                echo json_encode($quan);
                break;
            case 'check':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $id = mysqli_real_escape_string($db, $data->id);
                $quan = array();
                if (isset($api) && isset($id)) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tkk = mysqli_num_rows($u);
                    if ($tkk == '1') {
                        $ui = mysqli_fetch_assoc($u);
                        $user = $ui["username"];
                        $uu = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like' AND `id`='$id' AND `user` = '$user'");
                        $tko = mysqli_num_rows($uu);
                        if ($tko == '1') {
                            $u = mysqli_fetch_assoc($uu);
                            $quan["status"] = 'success';
                            $quan["link"] = $u['profile'];
                            $quan["number"] = $u['sl'];
                            $quan["done"] = $u['done'];
                            $quan["goc"] = $u['iddon'];
                            $quan["msg"] = 'Lấy thành công!';
                        } else {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Không tìm thấy đơn!';
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;
        }
        break;

    case 'follow_tt':
        switch ($_GET["act"]) {
            case 'buy':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $sl = mysqli_real_escape_string($db, $data->number);
                $idd = mysqli_real_escape_string($db, $data->link);
                $sv = mysqli_real_escape_string($db, $data->sv);
                $tt = json_decode(check_tt($idd, "follow"));
                $ttid = $tt->id;
                $ttview = $tt->follow;
                $id = $tt->nickname;
                if (isset($api) && isset($sl) && isset($id) && isset($sv)) {
                    if ($sv == 3) {
                        $gia = 21;
                        $nse = 'Server Follow 3';
                        $min = 100;
                        $max = 10000;
                    }
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $tk = $u['username'];
                        $quan = array();
                        $tongtien = $sl * $gia;
                        if (empty($id)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số ID cần tăng Follow TikTok!';
                        } elseif (empty($sl)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số lượng Follow!';
                        } elseif ($sl < $min) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng phải lớn hơn ' . $min . ' Follow';
                        } elseif ($sl > $max) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng tối đa ' . $max . ' Follow!';
                        } elseif ($u['vnd'] < $tongtien) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Bạn không đủ tiền!';
                        } else {
                            $ur = urlencode($id);
                            $nd1 = 'Tăng Follow TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $u['vnd'];
                            $time = time();
                            if ($sv == 3) {
                                $user = $s['user'];
                                $pass = $s['pass'];
                                $login_tds = json_decode(login($user, urlencode($pass)));
                                if ($login_tds->success == 'true') {
                                    $date_create =  date("Y-m-d H:i:s");
                                    $send_api = send_tds_tt('follow', trim($ur), trim($sl), '', $date_create);
                                    if (strpos($send_api, 'nh công') !== false) {
                                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                        mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$tk',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$idd'");
                                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                        $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                        $rr = mysqli_fetch_assoc($r);
                                        $num = $rr["id"];
                                        $quan["status"] = 'success';
                                        $quan["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                                        $quan["id_order"] = $num;
                                        $quan["goc"] = $ttview;
                                        $quan["profile_link"] = $id;
                                    } else {
                                        $quan["status"] = 'error';
                                        $quan["msg"] = 'Lỗi ID tăng follow vui lòng kiểm tra lại!!';
                                    }
                                } else {
                                    $quan["status"] = 'error';
                                    $quan["msg"] = 'Server đang tạm bảo trì, vui lòng thử lại sau ít phút';
                                }
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Dữ Liệu Truyền Vào Không Đúng!!';
                }
                echo json_encode($quan);
                break;
            case 'check':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $id = mysqli_real_escape_string($db, $data->id);
                $quan = array();
                if (isset($api) && isset($id)) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tkk = mysqli_num_rows($u);
                    if ($tkk == '1') {
                        $ui = mysqli_fetch_assoc($u);
                        $user = $ui["username"];
                        $uu = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_follow' AND `id`='$id' AND `user` = '$user'");
                        $tko = mysqli_num_rows($uu);
                        if ($tko == '1') {
                            $u = mysqli_fetch_assoc($uu);
                            $quan["status"] = 'success';
                            $quan["link"] = $u['profile'];
                            $quan["number"] = $u['sl'];
                            $quan["done"] = $u['done'];
                            $quan["goc"] = $u['iddon'];
                            $quan["msg"] = 'Lấy thành công!';
                        } else {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Không tìm thấy đơn!';
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Không đủ phần tử gọi đến!';
                }
                echo json_encode($quan);
                break;
        }
        break;

    case 'view_story':
        switch ($_GET["act"]) {
            case 'buy':
                $data = json_decode(file_get_contents("php://input"));
                $api = mysqli_real_escape_string($db, $data->api);
                $sl = mysqli_real_escape_string($db, $data->number);
                $id = mysqli_real_escape_string($db, $data->link);
                if (isset($api) && isset($sl) && isset($id)) {
                    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
                    $tko = mysqli_num_rows($uu);
                    if ($tko == '1') {
                        $u = mysqli_fetch_assoc($uu);
                        $gia = 5;
                        $min = 100;
                        $max = 2000;
                        $quan = array();
                        $tongtien = $sl * $gia;
                        if (empty($id)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập Link Story cần tăng View!';
                        } elseif (empty($sl)) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Vui lòng nhập số lượng View!';
                        } elseif ($sl < $min) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng phải lớn hơn ' . $min . ' View';
                        } elseif ($sl > $max) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Số lượng tối đa ' . $max . ' View!';
                        } elseif ($u['vnd'] < $tongtien) {
                            $quan["status"] = 'error';
                            $quan["msg"] = 'Bạn không đủ tiền!';
                        } else {
                            $nd1 = 'Tăng View Story ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $u['vnd'];
                            $time = time();
                            $user = $s['user'];
                            $pass = $s['pass'];
                            $login_tds = json_decode(login($user, urlencode($pass)));
                            if ($login_tds->success == 'true') {
                                $date_create =  date("Y-m-d H:i:s");
                                $send_api = send_tds_story(trim($id), trim($sl), '', $date_create);
                                if (strpos($send_api, 'nh công') !== false) {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$tk',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_viewstory',`sl` = '$sl', `trangthai` = '2', `user`='$tk',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '4', `bh`='1', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$tk' AND `site` = '$site'");
                                    $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                    $rr = mysqli_fetch_assoc($r);
                                    $num = $rr["id"];
                                    $quan["status"] = 'success';
                                    $quan["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                    $quan["id_order"] = $num;
                                    $quan["goc"] = $ttview;
                                    $quan["profile_link"] = $id;
                                } else {
                                    $quan["status"] = 'error';
                                    $quan["msg"] = 'Lỗi Link tăng View vui lòng kiểm tra lại!!';
                                }
                            } else {
                                $quan["status"] = 'error';
                                $quan["msg"] = 'Server đang tạm bảo trì, vui lòng thử lại sau ít phút';
                            }
                        }
                    } else {
                        $quan["status"] = 'error';
                        $quan["msg"] = 'API không tồn tại!';
                    }
                } else {
                    $quan["status"] = 'error';
                    $quan["msg"] = 'Dữ Liệu Truyền Vào Không Đúng!!';
                }
                echo json_encode($quan);
                break;
        }
        break;
}
