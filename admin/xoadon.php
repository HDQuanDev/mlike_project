<?php
$admin = '1';
require_once('../_System/db.php');
switch ($_GET['act']) {
    case 'del':
        $bang = $_GET['bang'];
        $loai = $_GET['loai'];
        $dv = $_GET['dv'];
        $sv = $_GET['sv'];
        $sv_2 = $_GET['sv_2'];
        $time = $_GET['time'];
        $time_2 = $_GET['time_2'];
        if ($loai == 'donhang') {
            if (isset($dv) && empty($sv) && empty($sv_2)) {
                $del = mysqli_query($db, "DELETE FROM `$bang`
        WHERE `dv` = '$dv' AND `time` > '$time' AND `time` < '$time_2'");
                echo $del;
                echo 'a';
            } elseif (isset($dv) && isset($sv) && empty($sv_2)) {
                $del = mysqli_query($db, "DELETE FROM `$bang`
        WHERE `dv` = '$dv' AND `sve` = '$sv' AND `time` > '$time' AND `time` < '$time_2'");
                echo $del;
                echo 'b';
            } elseif (isset($dv) && empty($sv) && isset($sv_2)) {
                $del = mysqli_query($db, "DELETE FROM `$bang`
        WHERE `dv` = '$dv' AND `nse` = '$sv_2' AND `time` > '$time' AND `time` < '$time_2'");
                echo $del;
                echo 'c';
            }
        } elseif ($loai == 'lichsu') {
            if (isset($bang) && isset($time) && isset($time_2)) {
                $del = mysqli_query($db, "DELETE FROM `$bang`
        WHERE `time` > '$time' AND `time` < '$time_2'");
                echo $del;
                echo 'da xoa lich su!';
            }
        }
        echo '<meta http-equiv="refresh" content="2;url=/admin/xoadon?note=Success">';
        break;

    default:
        if (isset($_GET['note'])) {
            echo '<script>
        
          alert("Xóa Thành Công");
        
        </script>';
        }
        ?>
        <form action="?act=del" method="GET">
            <input type="hidden" value="del" name="act">
            <label for="" class="">Nhập Bảng Muốn Xóa</label>
            <select name="loai">
                <option value="donhang">Đơn Hàng</option>
                <option value="lichsu">Lịch Sử</option>
            </select><br><code>Nếu chọn lịch sử, vui lòng nhập tên bảng muốn xóa, và nhập thời gian muốn xóa từ -> thời gian muốn xóa</code><br>
            <label for="" class="">Nhập Bảng Muốn Xóa</label>
            <input type="text" name="bang" require><br>
            <label for="" class="">Nhập Dịch Vụ Muốn Xóa</label>
            <input type="text" name="dv" require><br>
            <label for="" class="">Nhập Server Muốn Xóa (Lấy cột sve)</label>
            <input type="text" name="sv"><br>
            <label for="" class="">Nhập Tên Server Muốn Xóa (Lấy cột nse)</label>
            <input type="text" name="sv_2"><br>
            <label for="" class="">Nhập Thời Gian Muốn Xóa Từ (Lấy timestramp)</label>
            <input type="text" name="time" value="0"><br>
            <label for="" class="">Nhập Thời Gian Kết Thúc Xóa (Lấy timestramp)</label>
            <input type="text" name="time_2" value="<?= time(); ?>"><br>
            <input type="submit" value="Xóa">
        </form>
    <?php
                break;
    case 'delcmt':
        $sl = $_GET['sl'];
        $time = $_GET['time'];
        $time_2 = $_GET['time_2'];
        $del = mysqli_query($db, "DELETE FROM `dv_cmt` WHERE `time` > '$time' AND `time` < '$time_2' LIMIT $sl");
        echo $del;
        echo '<meta http-equiv="refresh" content="2;url=/admin/xoadon?note=Success&act=cmt">';
        break;

    case 'cmt':
        if (isset($_GET['note'])) {
            echo '<script>
            
              alert("Xóa Thành Công");
            
            </script>';
        }
        ?>
        <form action="?act=delcmt" method="GET">
            <input type="text" name="sl" placeholder="Nhập số lượng cmt cần xóa">
            <input type="text" name="time" placeholder="Nhập thời gian bắt đầu">
            <input type="text" name="time_2" placeholder="Nhập thời gian kết thúc">
            <input type="submit" value="Xóa">
        </form>
<?php
            break;
}
