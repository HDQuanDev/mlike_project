<?php
require_once('_System/db.php');
$title = "Trang Chủ";
require_once('_System/head.php');
?>
<?php

if (!$s['thongbao'] == null) {

    $tbb = $s['thongbao'];
    ?>
    <script type="text/JavaScript">
        function getCookie(name){
    var pattern = RegExp(name + "=.[^;]*");
    var matched = document.cookie.match(pattern);
    if(matched){
        var cookie = matched[0].split('=');
        return cookie[1];
    };
    return false;
};
//alert(getCookie("thongbao"));
if(getCookie("thongbao") == false) {
const wrapper = document.createElement('div');
<?php if (!$s['idyt'] == '0') { ?>
wrapper.innerHTML = '<div id="player" class="player rounded-3" data-plyr-provider="youtube" data-plyr-embed-id="7T09viA678g"> </div><br><p class="mb-3"><?= $tbb; ?></p>';
<?php } else { ?>
wrapper.innerHTML = '<p class="mb-3"><?= $tbb; ?></p>';
<?php } ?>
function thongbao() {
swal({
  title: "Thông Báo",
  content: wrapper,
  buttons: ["OK", "Đã Đọc"],
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Cảm ơn bạn đã đọc thông báo này!");
    var now = new Date();
     var minutes = 10;
now.setTime(now.getTime() + (minutes * 60 * 1000));
document.cookie = "thongbao=hihi; expires=" + now.toUTCString() + "; path=/";
  };
});
}
setTimeout(thongbao, 1000);
};
</script>
<?php
}
?>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Họ và Tên</p>
                        <h4 class="my-1 text-info"><?= $row['hoten']; ?></h4>

                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i data-feather="user"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Số dư tài khoản</p>
                        <h4 class="my-1 text-danger"><?= number_format($row['vnd']); ?>₫</h4>

                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i data-feather="dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Số tiền đã dùng</p>
                        <h4 class="my-1 text-success"><?= number_format($row['sd']) ?>₫</h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i data-feather="credit-card"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Loại người dùng</p>
                        <h4 class="my-1 text-warning"><?= $cv; ?></h4>

                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<?php

$result1 = mysqli_query($db, "SELECT * FROM `thongbao` WHERE `site` = '$site' ORDER BY id DESC LIMIT 0,3");
if ($result1) {
    while ($ro = mysqli_fetch_assoc($result1)) {
        $t = $ro['time'];
        ?>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="new-users-social">
                        <div class="d-flex align-items-start"><img class="rounded-circle image-radius m-r-15" src="https://graph.facebook.com/101295558452595/picture?width=60&height=60&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt="">
                            <div class="flex-grow-1">
                                <h5 class="mb-0 f-w-700">MLIKE Support</h5>
                                <p><?= time_func($t); ?></p>
                            </div><span class="pull-right mt-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg></span>
                        </div>
                    </div>
                    <div class="timeline-content">
                        <p class="mb-0"><?= $ro['noidung']; ?></p>
                        <div class="like-content"><span><i class="fa fa-heart font-danger"></i> 1B </span><span class="pull-right comment-number"><span>20 </span><span><i class="fa fa-share-alt me-0"></i></span></span><span class="pull-right comment-number"><span>10 </span><span><i class="fa fa-comments-o"></i></span></span></div>
                        <div class="social-chat">
                            <div class="text-center"><a class="f-w-600" href="javascript:void(0)">More Comments</a></div>
                        </div>
                        <div class="comments-box">
                            <div class="d-flex align-items-center"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://graph.facebook.com/<?= $row['idfb']; ?>/picture?width=60&height=60&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662">
                                <div class="flex-grow-1">
                                    <div class="input-group text-box">
                                        <input class="form-control input-txt-bx" type="text" name="message-to-send" placeholder="Post Your comments">
                                        <div class="input-group-text"><img src="../assets/images/smiley.png" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
    }
}
require_once('_System/end.php');

?>