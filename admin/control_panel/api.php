<?php
@ob_start();
@session_start();
require_once('config.php');
class bt_api
{
    private $BT_KEY = "oYfrWndyfDFZIIF7cLUJ0ds1RHOpcxBE";
    private $BT_PANEL = "http://216.9.227.213:7800";
    public function __construct($bt_panel = null, $bt_key = null)
    {
        if ($bt_panel) $this->BT_PANEL = $bt_panel;
        if ($bt_key) $this->BT_KEY = $bt_key;
    }
    public function GetLogs()
    {
        $url = $this->BT_PANEL . '/system?action=GetNetWork';
        $p_data = $this->GetKeyData();
        $p_data['table'] = 'logs';
        $p_data['limit'] = 10;
        $p_data['tojs'] = 'test';
        $result = $this->HttpPostCookie($url, $p_data);
        $data = json_decode($result, true);
        return $data;
    }

    public function GetDatabase()
    {
        $url = $this->BT_PANEL . '/database?action=GetRunStatus';
        $p_data = $this->GetKeyData();
        $p_data['table'] = 'logs';
        $p_data['limit'] = 10;
        $p_data['tojs'] = 'test';
        $result = $this->HttpPostCookie($url, $p_data);
        $data = json_decode($result, true);
        return $data;
    }
    public function GetFirewall()
    {
        $url = $this->BT_PANEL . '/plugin?action=a&name=fail2ban&s=get_status';
        $p_data = $this->GetKeyData();
        $p_data['mode'] = 'mlike.vn-cc';
        $result = $this->HttpPostCookie($url, $p_data);
        $data = json_decode($result, true);
        return $data;
    }
    public function GetConfig()
    {
        $url = $this->BT_PANEL . '/config?action=get_config';
        $p_data = $this->GetKeyData();
        $result = $this->HttpPostCookie($url, $p_data);
        $data = json_decode($result, true);
        return $result;
    }
    private function GetKeyData()
    {
        $now_time = time();
        $p_data = array(
            'request_token'    =>    md5($now_time . '' . md5($this->BT_KEY)),
            'request_time'    =>    $now_time
        );
        return $p_data;
    }

    private function HttpPostCookie($url, $data, $timeout = 60)
    {
        $cookie_file = './' . md5($this->BT_PANEL) . '.cookie';
        if (!file_exists($cookie_file)) {
            $fp = fopen($cookie_file, 'w+');
            fclose($fp);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

function recursiveSearch($folder, $pattern)
{
    $dir = new RecursiveDirectoryIterator($folder);
    $ite = new RecursiveIteratorIterator($dir);
    $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
    $fileList = array();
    foreach ($files as $file) {
        $fileList[] = array(
            'path' => $file[0],
        );
    }
    return $fileList;
}

function delete_files($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            delete_files($file);
        }

        rmdir($target);
    } elseif (is_file($target)) {
        unlink($target);
    }
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://216.9.227.213:7800/config?action=get_config',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_COOKIEJAR => $cookie_file,
    CURLOPT_COOKIEFILE => $cookie_file,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Accept: */*',
        'x-http-token: VHbEjzrioe49XYVvCSkhUnFh1k5XorapklWRjmzam536nA2u',
        'DNT: 1',
        'X-Requested-With: XMLHttpRequest',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.76',
        'host: 216.9.227.213',
        'Cookie: 1bbb12afbc7478b05c300ef1e29e1b63=03dfdfc6-2a49-43a8-83da-2a99664c18c2.wrUSTPIpZL6jsJpqK3nkVN55-gY; 9e89751e05789ec9c568f2b981a9493d=0a2b1a83-1ddc-4702-83d4-84e598ceb27e.mRJ4gSj_clA8U0WNSHyT6B4lu28; Path=/www/wwwroot/huaducquan.id.vn/mlike; ad19cc0100d4518eb8003e51353e4bdb=7d6971fc-8c78-483b-b745-00572e40fa08.nVcb_fSRKxQN0tF_cGj1RwesobI; backup_path=/www/backup; commandInputViewUUID=6rBbES7bNpSzrpb; config-tab=allConfig; db_page_model=mysql; distribution=centos7; force=0; load_page=4; load_search=undefined; load_type=null; ltd_end=-1; memSize=13869; order=id%20desc; pnull=4; pro_end=-1; rank=list; record_paste_type=null; serial_no=; serverType=openlitespeed; site_model=php; site_type=-1; sites_path=/www/wwwroot; vcodesum=14'
    ),
));

$config = curl_exec($curl);

curl_close($curl);


$api = new bt_api();
$r_data = $api->GetLogs();
$quan = json_encode($r_data);
$get = json_decode($quan, true);

// $get_config = $api->GetConfig();
// $encf = json_encode($get_config);
$config = json_decode($config, true);

$cpu_name = "AMD EPYC Genoa 9554 * 2";
$cpu_core = "128";
$cpu_threat = "256";

switch ($_GET['act']) {
    case 'firewall_info':
        $get = $api->GetFirewall();
        echo json_encode($get);
        break;
    case 'cpu_load':
        echo $get["cpu"][0];
        break;
    case 'ram_usage':
        echo $get["mem"]["memCached"] + $get["mem"]["memRealUsed"];
        break;
    case 'load':
        echo $get["load"]["one"];
        break;
    case 'network':
        echo $get["network"]["ens160"]["down"];
        break;
    case 'bandwidth':
        $up = $get["upTotal"];
        $down = $get["downTotal"];
        $up = $up / pow(1024, 3);
        $down = $down / pow(1024, 3);
        $up = round($up, 2);
        $down = round($down, 2);
        $total = $up + $down;
        $ph = $total / 5000 * 100;
        $ph = round($ph, 2);
        echo '' . $total . '/5000GB (' . $ph . '%)';
        break;
    case 'bandwidthdata':
        $db = $api->GetDatabase();
        $getdb = json_encode($db);
        $db = json_decode($getdb, true);
        $received = $db["Bytes_received"];
        $send = $db["Bytes_sent"];
        $received = $received / pow(1024, 3);
        $send = $send / pow(1024, 3);
        $received = round($received, 2);
        $send = round($send, 2);
        $total = $received + $send;
        $ph = $total / 10000 * 100;
        $ph = round($ph, 2);
        echo '' . $total . '/10000GB (' . $ph . '%)';
        break;
    case 'backupsize':
        $site = file_get_contents('site.txt');
        $data = file_get_contents('database.txt');
        $tong = $site + $data;
        $ph = $tong / 51200 * 100;
        $ph = round($ph, 2);
        echo '' . number_format($tong) . '/51,200MB (' . $ph . '%)';
        break;
    case 'backupfile':
        $site = count(scandir('../../../backup/site')) - 2;
        $data = count(scandir('../../../backup/database')) - 2;
        echo '' . $site . '/' . $data . ' File';
        break;
    case 'info':
?>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em>AMD EPYC Genoa 9554 * 2</em></h3>
                <p class="mb-0">CPU</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em>128</em></h3>
                <p class="mb-0">CPU Core</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em>128</em></h3>
                <p class="mb-0">Total Ram</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["disk"][0]["size"][0]; ?></em></h3>
                <p class="mb-0">Total Disk</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["disk"][0]["size"][1]; ?></em></h3>
                <p class="mb-0">Disk Usage</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["version"]; ?></em></h3>
                <p class="mb-0">Panel Version</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em>216.9.227.213</em></h3>
                <p class="mb-0">IP Address</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["system"]; ?></em></h3>
                <p class="mb-0">System</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["site_total"]; ?></em></h3>
                <p class="mb-0">Total Site</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["ftp_total"]; ?></em></h3>
                <p class="mb-0">Total FTP</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["database_total"]; ?></em></h3>
                <p class="mb-0">Total Database</p>
            </div>
        </div>
        <div class="fact-item">
            <div class="details">
                <h3 class="mb-0 mt-0 number"><em><?= $get["time"]; ?></em></h3>
                <p class="mb-0">Server Uptime</p>
            </div>
        </div>

        <?
        break;
    case 'qrcode':
        $img = 'https://img.vietqr.io/image/MB-0919982762-compact2.png?amount=300000&addInfo=buypro mlike&accountName=Hua Duc Quan';
        echo '<br><center><h5 class="mb-3">Vui Lòng Quét Mã QR Để Thanh Toán</h5>
        <img class="img-thumbnail" src="' . $img . '" itemprop="thumbnail" alt="Image description"></center>';
        break;
    case 'update_token':
        if (isset($_POST["token"])) {
            $token = $_POST["token"];
            $fh = fopen("tokenfb.txt", 'w+');
            fwrite($fh, $token);
            fclose($fh);
            echo '<em><b>Cập Nhật Token Thành Công, Vui Lòng Tải Lại Trang!!</b></em>';
        }
        break;
    case 'get_backup':
        if ($_POST['token'] == $_SESSION['key']) {
            delete_files("file_backup/website");
            mkdir("file_backup/website", 0755);
            $files = recursiveSearch("../../../backup/site", "/^.*\.(tar.gz)$/");
            $fileCount = count($files);
            foreach ($files as $file) {
                $get = explode("/", $file['path']);
                $check = explode("_", $get[5]);
                if ($check[1] != 'huaducquan.id.vn') {
                    $new = 'file_backup/website/' . $get[5];
                    copy($file['path'], $new);
                }
            }
            delete_files("file_backup/database");
            mkdir("file_backup/database", 0755);
            $files = recursiveSearch("../../../backup/database", "/^.*\.(sql.gz)$/");
            $fileCount = count($files);
            foreach ($files as $file) {
                $get = explode("/", $file['path']);
                $check = explode("_", $get[5]);
                if ($check[1] != 'hoadon') {
                    $new = 'file_backup/database/' . $get[5];
                    copy($file['path'], $new);
                }
            }
            echo '<em><b>Danh Sách File Backup Website</em></b>';
            $files = recursiveSearch("file_backup/website", "/^.*\.(tar.gz)$/");
            $fileCount = count($files);
            foreach ($files as $file) {
                $get = explode("/", $file['path']);
                $check = explode("_", $get[2]);
                $ngay = $check[2];
                $gio = explode(".", $check[3]);
                $gio = $gio[0];

        ?>
                <div class="fact-item">
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em><?= $check[1]; ?></em> <a href="<?= $file['path']; ?>" target="_blank" class="btn btn-default">Download</a></h3>
                        <p class="mb-0">Time Backup: <?= substr($ngay, 6, 8); ?>/<?= substr($ngay, 4, 2); ?>/<?= substr($ngay, 0, 4); ?>, <?= substr($gio, 0, 2); ?>:<?= substr($gio, 2, 2); ?>:<?= substr($gio, 4); ?></p>
                    </div>
                </div>
            <?
            }
            echo '<hr><em><b>Danh Sách File Backup Database</em></b>';
            $files = recursiveSearch("file_backup/database", "/^.*\.(sql.gz)$/");
            $fileCount = count($files);
            foreach ($files as $file) {
                $get = explode("/", $file['path']);
                $check = explode("_", $get[2]);
                $ngay = $check[2];
                $gio = explode(".", $check[3]);
                $gio = $gio[0];

            ?>
                <div class="fact-item">
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em><?= $check[1]; ?></em> <a href="<?= $file['path']; ?>" target="_blank" class="btn btn-default">Download</a></h3>
                        <p class="mb-0">Time Backup: <?= substr($ngay, 6, 8); ?>/<?= substr($ngay, 4, 2); ?>/<?= substr($ngay, 0, 4); ?>, <?= substr($gio, 0, 2); ?>:<?= substr($gio, 2, 2); ?>:<?= substr($gio, 4); ?></p>
                    </div>
                </div>
<?
            }
        } else {
            echo '<em><b>Đã Xảy Ra Lỗi Khi Lấy Danh Sách File, Vui Lòng Tải Lại Trang Và Thử Lại!!</b></em>';
        }
        break;
    case 'doi_port':
        // // $port = rand(8000, 8999);
        // // $curl = curl_init();

        // // curl_setopt_array($curl, array(
        // //     CURLOPT_URL => 'http://194.180.50.114:7800/ajax?action=setPHPMyAdmin',
        // //     CURLOPT_RETURNTRANSFER => true,
        // //     CURLOPT_ENCODING => '',
        // //     CURLOPT_MAXREDIRS => 10,
        // //     CURLOPT_TIMEOUT => 0,
        // //     CURLOPT_FOLLOWLOCATION => true,
        // //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // //     CURLOPT_POSTFIELDS => 'port=' . $port,
        // //     CURLOPT_CUSTOMREQUEST => 'POST',
        // //     CURLOPT_HTTPHEADER => array(
        // //         'Accept: */*',
        // //         'x-http-token: J8AYYYzc6QsY11HNw9XEM5QEzqxjct1Lb9xfxYTacILdbQI8',
        // //         'DNT: 1',
        // //         'X-Requested-With: XMLHttpRequest',
        // //         'x-cookie-token: ',
        // //         'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.62',
        // //         'host: 194.180.50.114',
        // //         'Cookie: 0640b42471562362f87b3c2df65bc36a=90a71fa3-484d-4b8f-b72c-1885bafbc07e.hi5zy1c02ZUo1wT--zNBk5VA9jM; 416923547bc4b77a66f04c2e9f5d8dce=fd4f7901-ae53-4ded-b56c-f32d2c23f956.mmirJyQnVM_bTcGVDumiK0Xp_v4; 460da02e6125467eac043a2119bacfc7=167817f9-bb1e-4bc6-824a-8d070444ab39.NYiKOzPhiJzxboAR6ZfJS9bVb9U; Path=/www/wwwroot/huaducquan.id.vn; __stripe_mid=19ce4fef-7fd4-4515-a5e8-5a9ddf50e1226a7a0a; backup_path=/www/backup; bt_user_info=%7B%22status%22%3Atrue%2C%22msg%22%3A%22Got%20successfully%21%22%2C%22data%22%3A%7B%22username%22%3A%22hdq****.com%22%7D%7D; config-tab=allConfig; d7e3262831a1ea205115ba2ea40475cc=56e39936-a807-4c1b-9dcf-ff65c0d18840.wfvp47fbrBg5uMSamtCfXS4KZmQ; db_page_model=mysql; disk-unitType=KB/s; distribution=centos7; firewall_type=safety; force=0; load_page=3; load_search=undefined; load_type=null; logs_type=panelLogs; ltd_end=-1; memSize=13867; network-unitType=KB/s; order=id%20desc; ph_mqkwGT0JNFqO-zX2t0mW6Tec9yooaVu7xCBlXtHnt5Y_posthog=%7B%22distinct_id%22%3A%22188186c948817ba-040be92d0fb66d-7b515477-1fa400-188186c9489fe2%22%2C%22%24device_id%22%3A%22188186c948817ba-040be92d0fb66d-7b515477-1fa400-188186c9489fe2%22%2C%22%24user_state%22%3A%22anonymous%22%7D; pnull=3; pro_end=-1; rank=list; serial_no=; serverType=apache; site_model=php; sites_path=/www/wwwroot'
        // //     ),
        // // ));

        // $config = curl_exec($curl);

        // curl_close($curl);
        break;
    case 'check_payment':
        if ($pay == 'true') {
            echo '<center><span style="color:green;"><b>Đã Thanh Toán, Vui Lòng Làm Mới Lại Trang Để Cập Nhật Các Tính Năng Của PRO</b></span></center>';
        } else {
            echo '<center><span style="color:red;"><b>Đang chờ thanh toán, vui lòng quét mã QR và không đóng tab này đến khi thanh toán hoàn tất</b></span></center>';
        }
        break;
    case 'notification':
        $json = [];
        $json["show"] = false;
        $json["data"][0]["id"] = '1';
        $json["data"][0]["msg"] = 'The <a href="https://docs.google.com/spreadsheets/d/11d__BgjACkJpx-NdspxOJ9PwovKcG3OdoXPw5j2Matg/edit#gid=0&range=B9">TikTok API Warranty</a> Payment is due on 25/10/2023 from <a href="https://docs.google.com/spreadsheets/d/11d__BgjACkJpx-NdspxOJ9PwovKcG3OdoXPw5j2Matg/edit#gid=0">MLIKE SYSTEM</a>.';
        $json["data"][0]["class"] = 'warning';
        echo json_encode($json);
        break;
    default:
        # code...
        break;
}
