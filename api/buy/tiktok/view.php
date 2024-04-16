<?php

$hdq = "ok";
$page = 'view_tt';
require_once('../../../_System/db.php');
require_once('../../../module/viewyt.php');
require_once('../../../module/autofb88.php');
require_once('../../../module/ongtrum.php');
require_once('../../../module/tiktok.php');
require_once('../../../module/buffviewer.php');
require_once('../../../module/boosterviews.php');
$gia = $gia1;
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
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_view' ORDER BY id DESC LIMIT $limit");
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
    case 'history_user':
        if (isset($_POST['token']) && isset($_POST['limit'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                if ($row["rule"] == '99') {
                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' ORDER BY id DESC LIMIT $limit");
                } else {
                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_view' ORDER BY id DESC LIMIT $limit");
                }
                $q = 0;
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['iddon'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"][$q]["id"] = "$profile";
                    $array["data"][$q]["number"] = "$sl";
                    $array["data"][$q]["start"] = "$start";
                    $array["data"][$q]["done"] = "$done";
                    $array["data"][$q]["server"] = "$sv";
                    $array["data"][$q]["user"] = "$user";
                    $array["data"][$q]["time"] = "$t";
                    $array["data"][$q]["status"] = "$tt";
                    $array["data"][$q]["sotien"] = $ro['sotien'];
                    $array["data"][$q]["id_order"] = $ro['id'];
                    $q++;
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
    case 'refill_view':
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
                $check = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv`='tiktok_view' AND `id` = '$id_order' AND `user` = '$login' AND (`nse` = 'Server View 7' OR `nse` = 'Server View 9')");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $idgd = $get["idgd"];
                    if ($idgd > 0) {
                        if ($get["nse"] == 'Server View 7') {
                            $refill = json_decode(bv_refill_view($idgd), true);
                            if ($refill["data"][0]["status"] == true) {
                                $array["status"] = 'success';
                                $array["msg"] = 'Đã refill thành công!';
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = $refill["data"][0]["message"];
                            }
                        } elseif ($get["nse"] == 'Server View 9') {
                            $refill = json_decode(boosterviews_refill($idgd), true);
                            if (isset($refill["refill"])) {
                                $array["status"] = 'success';
                                $array["msg"] = 'Đã refill thành công!';
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đơn hàng này chưa cần bảo hành, vui lòng thử lại sau!';
                            }
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'ID_ORDER không tồn tại, đơn này không nằm trong server được refill!';
                    }
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại, hoặc trạng thái đơn không hợp lệ để refill!';
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
                if ($sv == 1) {
                    $tongtien = $sl * $gia;
                    $nse = 'Server View 1';
                    $min = 50000;
                    $max = 5000000;
                } elseif ($sv == 2) {
                    $tongtien = $sl * $gia2;
                    $nse = 'Server View 2';
                    $min = 1000;
                    $max = 2000000;
                } elseif ($sv == 3) {
                    $tongtien = $sl * $gia3;
                    $nse = 'Server View 3';
                    $min = 1000;
                    $max = 100000000;
                } elseif ($sv == 4) {
                    $tongtien = $sl * $gia4;
                    $nse = 'Server View 4';
                    $min = 1000;
                    $max = 100000000;
                } elseif ($sv == 5) {
                    $tongtien = $sl * $gia5;
                    $nse = 'Server View 5';
                    $min = 1000;
                    $max = 100000000;
                } elseif ($sv == 6) {
                    $tongtien = $sl * $gia6;
                    $nse = 'Server View 6';
                    $min = 20000;
                    $max = 100000000;
                } elseif ($sv == 7) {
                    $tongtien = $sl * $gia7;
                    $nse = 'Server View 7';
                    $min = 1000;
                    $max = 2000000000;
                } elseif ($sv == 8) {
                    $tongtien = $sl * $gia8;
                    $nse = 'Server View 8';
                    $min = 1000;
                    $max = 2000000000;
                } elseif ($sv == 9) {
                    $tongtien = $sl * $gia9;
                    $nse = 'Server View 9';
                    $min = 1000;
                    $max = 2000000000;
                } elseif ($sv == 10) {
                    $tongtien = $sl * $gia10;
                    $nse = 'Server View 10';
                    $min = 50000;
                    $max = 100000000;
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
                        $link = $id;
                    } else {
                        $link = 'https://www.tiktok.com/@tiktok/video/' . $id;
                    }
                    if ($sv == 1 || $sv == 2) {
                        if ($sv == 1 && $sv1 == 'off') {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang bảo trì, vui lòng chọn server khác hoặc thử lại sau!!';
                            echo json_encode($array);
                            die();
                        } elseif ($sv == 2 && $sv2 == 'off') {
                            $array["status"] = 'error';
                            $array["msg"] = 'Server đang bảo trì, vui lòng chọn server khác hoặc thử lại sau!!';
                            echo json_encode($array);
                            die();
                        }
                        if ($sv == 1) {
                            $order = $api->order(array('service' => 1793, 'link' => '' . $id . '', 'quantity' => $sl));
                        } elseif ($sv == 2) {
                            $order = $api->order(array('service' => 1918, 'link' => '' . $id . '', 'quantity' => $sl));
                        }
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            if (isset($order)) {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $buff->message . '';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 3) {
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            $buff = json_decode(viewtt88($id, $sl, "82_5"));
                            if ($buff->status == '200') {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $buff->message . '';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 4 || $sv == 5) {
                        if (isset($_POST['view']) && isset($_POST['uid']) && isset($_POST['link'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $ttlink = $_POST['link'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                                $ttlink = $tt->link;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                                $ttlink = $id;
                            }
                        }
                        if ($checkne == '200') {
                            if ($sv == 4) {
                                $buff = json_decode(ongtrum("$ttid", "$ttlink", "51", "tiktok.buff.view", "$sl", "$ttview"));
                            } elseif ($sv == 5) {
                                $buff = json_decode(ongtrum("$ttid", "$ttlink", "56", "tiktok.buff.view", "$sl", "$ttview"));
                            }
                            if ($buff->code == '200') {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $buff->message . '';
                                $array["link"] = '' . $ttlink . '';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 6) {
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            $buff = json_decode(viewtt88($id, $sl, "82_10"));
                            if ($buff->status == '200') {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $buff->message . '';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 7) {
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            $buff = json_decode(bv_viewtt($link, $sl, "0"), true);
                            if ($buff["data"][0]["status"] == true) {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                $iddon = $buff["data"][0]["id"];
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$iddon'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = $buff["data"][0]["status"]["message"];
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 8) {
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            $buff = json_decode(bv_viewtt($link, $sl, "1"), true);
                            if ($buff["data"][0]["status"] == true) {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                $iddon = $buff["data"][0]["id"];
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$iddon'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = $buff["data"][0]["status"]["message"];
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 9) {
                        if (isset($_POST['view']) && isset($_POST['uid'])) {
                            $ttid = $_POST['uid'];
                            $ttview = $_POST['view'];
                            $checkne = '200';
                        } else {
                            $tt = json_decode(check_tt($link, "video"));
                            if ($stttiktok == 'on') {
                                $checkne = $tt->success;
                                $ttid = $tt->data->id;
                                $ttview = $tt->data->playCount;
                            } else {
                                $checkne = '200';
                                $ttid = $id;
                                $ttview = 'null';
                            }
                        }
                        if ($checkne == '200') {
                            $buff = json_decode(boosterviews($link, $sl, "0000000"), true);
                            if (isset($buff["order"])) {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                $iddon = $buff["order"];
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$iddon'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi, vui lòng thử lại sau!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } elseif ($sv == 10) {
                        $checkne = '200';
                        $ttid = $id;
                        $ttview = 'null';
                        if ($checkne == '200') {
                            $buff = json_decode(boosterviews($link, $sl, "1216"), true);
                            if (isset($buff["order"])) {
                                $nd1 = 'Tăng View TikTok ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                $iddon = $buff["order"];
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$iddon'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi, vui lòng thử lại sau!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Không thể lấy thông tin từ UID/Link này, vui lòng thử lại!!!';
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi Server Tăng View Không Đúng!';
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
