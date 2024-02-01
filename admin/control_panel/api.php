<?php
@ob_start();
@session_start();
class bt_api
{
    private $BT_KEY = "8djpDMP3q4RSqMeV4p22EuFVhhPYjoRN";
    private $BT_PANEL = "http://216.9.227.213:1411";
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
    public function GetDirSite($path)
    {
        $url = $this->BT_PANEL . '/files?action=GetDirSize';
        $p_data = $this->GetKeyData();
        $p_data['path'] = $path;
        $result = $this->HttpPostCookie($url, $p_data);
        $result = str_replace('"', '', $result);
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
function CheckFileExist($username)
{
    $username = strtolower($username);
    if (file_exists("$username.json")) {
        return true;
    } else {
        return false;
    }
}
function save_file($data, $username)
{
    $username = strtolower($username);
    if (!empty($username) && !empty($data)) {
        $file = @fopen("$username.json", "w+");
        if (!$file) {
            $result = array("status" => "error", "message" => "can't open file");
        } else {
            fwrite($file, $data);
            fclose($file);
            $result = array("status" => "success", "message" => "save data success");
        }
    } else {
        $result = array("status" => "error", "message" => "username or data is empty");
    }
    return $result;
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

$cpu_name = "Intel(R) Xeon(R) CPU E5-2699C v4 @ 2.20GHz";
$cpu_core = "32";
$cpu_threat = "32";

switch ($_GET['act']) {
    case 'server_info':

        $cpu = $get["cpu"][0];
        $ram = $get["mem"]["memCached"] + $get["mem"]["memRealUsed"];
        $load = $get["load"]["one"];
        $network = $get["network"]["ens192"]["down"];

        $up = $get["upTotal"];
        $down = $get["downTotal"];
        $up = $up / pow(1024, 3);
        $down = $down / pow(1024, 3);
        $up = round($up, 2);
        $down = round($down, 2);
        $total = $up + $down;
        $bandwidth = $total / 5000 * 100;
        $bandwidth = round($bandwidth, 2);

        $db = $api->GetDatabase();
        $db = json_decode(json_encode($db), true);
        $received = $db["Bytes_received"];
        $sent = $db["Bytes_sent"];
        $received = $received / pow(1024, 3);
        $sent = $sent / pow(1024, 3);
        $received = round($received, 2);
        $sent = round($sent, 2);
        $total = $received + $sent;
        $bandwidth_data = $total / 10000 * 100;
        $bandwidth_data = round($bandwidth_data, 2);


        $get_disk = $api->GetDirSite('/www/wwwlogs');
        $get_disk_size = explode('.', $get_disk);
        $get_disk_size = $get_disk_size[0];
        $get_disk_size = trim($get_disk_size);
        if ($get_disk_size > 50) {
            $get_disk_size = $get_disk_size - 50;
            $op = '0';
        } else {
            $op = '100';
        }
        $get_disk_price = $get_disk_size * 1000;
        $get_disk_price = number_format($get_disk_price);
        $response = [
            "cpu" => $cpu,
            "ram" => $ram,
            "load" => $load,
            "network" => $network,
            "bandwidth" => $bandwidth,
            "bandwidth_data" => $bandwidth_data,
            "firewall" => [
                "total_banned" => '9999',
                "total_failed" => '9999',
                "currently_banned" => '9999',
                "currently_failed" => '9999',
            ],
            "disklog" => [
                "size" => $get_disk,
                "size_number" => $get_disk_size,
                "price" => $get_disk_price,
                "op" => $op,
            ]
        ];

        echo json_encode($response);
        break;
    case 'create_url':
        if (CheckFileExist('payment')) {
            $json = [];
            $json["status"] = "success";
            $json["message"] = "Bạn Đã Tạo URL Thanh Toán Rồi, Vui Lòng Đợi Đến Khi Hết Hạn";
            $json["url"] = file_get_contents('payment.json');
            echo json_encode($json);
            exit();
        }
        $get_disk = $api->GetDirSite('/www/wwwlogs');
        $get_disk_size = explode('.', $get_disk);
        $get_disk_size = $get_disk_size[0];
        $get_disk_size = trim($get_disk_size);
        if ($get_disk_size > 50) {
            $get_disk_size = $get_disk_size - 50;
        }
        $get_disk_price = $get_disk_size * 1000;
        $json = [];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://hoadon.qdevs.tech/api/create-bill',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '', // Bỏ qua việc giải nén nếu có
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // Đặt thời gian chờ tối đa là 30 giây
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'sotien' => $get_disk_price,
                'comment' => 'Tối ưu lại hết thống file mlike.vn',
                'return_url' => 'https://mlike.vn/admin/control_panel/payment.php',
                'api' => 'qdevs_mlike',
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $json["status"] = "error";
            $json["message"] = curl_error($curl);
            echo json_encode($json);
            exit();
        }

        curl_close($curl);
        $response = json_decode($response, true);
        if ($response["status"] == "error") {
            $json["status"] = "error";
            $json["message"] = $response["message"];
        } else {
            $json["status"] = "success";
            $json["message"] = $response["message"];
            $json["url"] = $response["data"]["link"];
            save_file($response["data"]["link"], 'payment');
        }
        echo json_encode($json);
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
    case 'test':
        $cpu = $get["cpu"][0];
        $ram = $get["mem"]["memCached"] + $get["mem"]["memRealUsed"];
        $load = $get["load"]["one"];
        $network = $get["network"]["ens192"]["down"];

        $up = $get["upTotal"];
        $down = $get["downTotal"];
        $up = $up / pow(1024, 3);
        $down = $down / pow(1024, 3);
        $up = round($up, 2);
        $down = round($down, 2);
        $total = $up + $down;
        $bandwidth = $total / 5000 * 100;
        $bandwidth = round($bandwidth, 2);

        $db = $api->GetDatabase();
        $db = json_decode(json_encode($db), true);
        $received = $db["Bytes_received"];
        $sent = $db["Bytes_sent"];
        $received = $received / pow(1024, 3);
        $sent = $sent / pow(1024, 3);
        $received = round($received, 2);
        $sent = round($sent, 2);
        $total = $received + $sent;
        $bandwidth_data = $total / 10000 * 100;
        $bandwidth_data = round($bandwidth_data, 2);

        $site = file_get_contents('site.txt');
        $data = file_get_contents('database.txt');
        $backup_size = $site + $data;
        $backup_usage = $backup_size / 51200 * 100;
        $backup_usage = round($backup_usage, 2);

        $site_files = count(scandir('../../../../backup/site')) - 2;
        $data_files = count(scandir('../../../../backup/database')) - 2;

        $get_fw = $api->GetFirewall();
        $config = json_encode($get_fw);
        $config = json_decode($config, true);

        $get_disk = $api->GetDirSite('/www/wwwlogs');
        $get_disk_size = explode('.', $get_disk);
        $get_disk_size = $get_disk_size[0];
        $get_disk_size = trim($get_disk_size);
        if ($get_disk_size > 50) {
            $get_disk_size = $get_disk_size - 50;
            $op = '0';
        } else {
            $op = '100';
        }
        $get_disk_price = $get_disk_size * 1000;
        $get_disk_price = number_format($get_disk_price);
        $response = [
            "cpu" => $cpu,
            "ram" => $ram,
            "load" => $load,
            "network" => $network,
            "bandwidth" => $bandwidth,
            "bandwidth_data" => $bandwidth_data,
            "firewall" => [
                "total_banned" => $config["msg"]["total_banned"],
                "total_failed" => $config["msg"]["total_failed"],
                "currently_banned" => $config["msg"]["currently_banned"],
                "currently_failed" => $config["msg"]["currently_failed"],
                // "total_banned" => 999999,
                // "total_failed" => 999999,
                // "currently_banned" => 999999,
                // "currently_failed" => 999999,
            ],
            "disklog" => [
                "size" => $get_disk,
                "size_number" => $get_disk_size,
                "price" => $get_disk_price,
                "op" => $op,
            ]
        ];

        echo json_encode($response);
        break;
    default:
        # code...
        break;
}
