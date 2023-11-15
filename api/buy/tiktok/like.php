<?
$hdq = "ok";
$page = 'tim_tt';
require_once('../../../_System/db.php');
require_once('../../../module/tiktok.php');
require_once('../../../module/viewyt.php');
require_once('../../../module/vnfb.php');
require_once('../../../module/autofb88.php');
require_once('../../../module/ongtrum.php');
$gia = $gia1;
$min = '100';
$max = '9999';
$api = new Api();
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
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_like' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    if ($_GET['type'] == 'id_order') {
                        $id = $ro['id'];
                    } else {
                        $id = $ro['profile'];
                    }
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['iddon'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
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
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if ($sv == 1) {
                    $tongtien = $sl * $gia1;
                    $nse = 'Server Like 1';
                    $max = 5000;
                } elseif ($sv == 2) {
                    $tongtien = $sl * $gia2;
                    $nse = 'Server Like 2';
                } elseif ($sv == 3) {
                    $tongtien = $sl * $gia3;
                    $nse = 'Server Like 3';
                } elseif ($sv == 4) {
                    $tongtien = $sl * $gia4;
                    $nse = 'Server Like 4';
                    $max = 9999;
                } elseif ($sv == 5) {
                    $tongtien = $sl * $gia5;
                    $nse = 'Server Like 5';
                } elseif ($sv == 6) {
                    $tongtien = $sl * $gia6;
                    $nse = 'Server Like 6';
                } elseif ($sv == 7) {
                    $tongtien = $sl * $gia7;
                    $nse = 'Server Like 7';
                } elseif ($sv == 8) {
                    $tongtien = $sl * $gia8;
                    $min = 1000;
                    $nse = 'Server Like 8';
                }
                if (empty($id)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số ID!';
                } elseif (empty($sl)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số lượng!';
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
                    if (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                        $tt = json_decode(check_tt($id, "video"));
                        $ttid = $tt->data->id;
                        $ttview = $tt->data->diggCount;
                        $ttlink = $tt->data->link;
                    } else {
                        $ttid = $id;
                        $ttview = '0';
                    }
                    if ($sv == 1) {
                        $order = $api->order(array('service' => 1724, 'link' => '' . $id . '', 'quantity' => $sl));
                        if (isset($order)) {
                            $nd1 = '(1) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 2) {
                        $order = $api->order(array('service' => 1724, 'link' => '' . $id . '', 'quantity' => $sl));
                        if (isset($order)) {
                            $nd1 = '(2) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '1', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 3) {
                        $ur = urlencode($id);
                        $buff = send_likett_vnfb("$ur", "$sl");
                        $buff = json_decode($buff);
                        if ($buff->success == 1) {
                            $nd1 = '(3) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            $idgdd = $buff->order_id;
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `idgd` = '$idgdd', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 4) {
                        require_once('../../../module/tds.php');
                        $ur = urlencode($id);
                        $nd1 = '(4) Tăng Tim TikTok ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $user = $s['user'];
                        $pass = $s['pass'];
                        $login_tds = json_decode(login($user, urlencode($pass)));
                        if ($login_tds->success == 'true') {
                            $date_create =  date("Y-m-d H:i:s");
                            $send_api = send_tds_tt('like', trim($ur), trim($sl), '', $date_create);
                            if (strpos($send_api, 'nh công') !== false) {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi, vui lòng thử lại';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Đã xảy ra lỗi, vui lòng thử lại';
                        }
                    } elseif ($sv == 5) {
                        require_once('../../../module/subgiare.php');
                        $buff = sgr_ttlike("$id", "sv9", "$sl", "");
                        $buff = json_decode($buff);
                        if ($buff->status == true) {
                            $nd1 = '(5) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 6) {
                        $buff = timtt88("$id", "$sl", "80_13");
                        $buff = json_decode($buff);
                        if ($buff->status == '200') {
                            $nd1 = '(6) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 7) {
                        $buff = timtt88("$id", "$sl", "80_9");
                        $buff = json_decode($buff);
                        if ($buff->status == '200') {
                            $nd1 = '(7) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 8) {
                        $buff = json_decode(ongtrum("$ttid", "$ttlink", "64", "tiktok.buff.like", "$sl", "$ttview"));
                        if ($buff->code == '200') {
                            $nd1 = '(7) Tăng Tim TikTok ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                            $array["link"] = '' . $ttlink . '';
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi Server Tăng Tim Không Đúng!';
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
