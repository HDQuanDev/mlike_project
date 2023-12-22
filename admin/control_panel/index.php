<?php
$admin = 1;
require_once('../../_System/db.php');
$title = "Quản Lý Máy Chủ";
require_once('../../_System/head.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" integrity="sha512-QKC1UZ/ZHNgFzVKSAhV5v5j73eeL9EEN289eKAEFaAjgAiobVAnVv/AGuPbXsKl1dNoel3kNr6PYnSiTzVVBCw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header ">
        <h4>Quản Lý Máy Chủ</h4>
    </div>
    <div class="card-body">
        <p class="mb-0">
        <div class="row">
            <!-- skill item -->
            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-fire"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="cpu_load">Loading...</em></h3>
                        <p class="mb-0">CPU Sử dụng (%)</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-cup"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="mem_usage">Loading...</em></h3>
                        <p class="mb-0">Ram Sử dụng (MB)</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-people"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="load">Loading...</em></h3>
                        <p class="mb-0">Tải máy chủ (%)</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-badge"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="network">Loading...</em></h3>
                        <p class="mb-0">Mạng Sử dụng (kb/s)</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <!-- skill item -->
            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-close"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="fw_all_block">Loading...</em></h3>
                        <p class="mb-0">Tổng Chặn</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-minus"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="fw_all_error">Loading...</em></h3>
                        <p class="mb-0">Tổng Lỗi</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-user-unfollow"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="fw_block">Loading...</em></h3>
                        <p class="mb-0">Đang Chặn</p>
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- fact item -->
                <div class="fact-item">
                    <span class="icon icon-badge"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="fw_block_error">Loading...</em></h3>
                        <p class="mb-0">Chặn Lỗi</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="fact-item">
                    <span class="icon icon-badge"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="bandwidth">Loading...</em></h3>
                        <p class="mb-0">Bandwidth Sử dụng</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="fact-item">
                    <span class="icon icon-cup"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="bandwidthdata">Loading...</em></h3>
                        <p class="mb-0">Bandwidth Database</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="fact-item">
                    <span class="icon icon-cloud-upload"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="backupsize">Loading...</em></h3>
                        <p class="mb-0">Dung Lượng Backup</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="fact-item">
                    <span class="icon icon-chart"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="backupfile">Loading...</em></h3>
                        <p class="mb-0">Site/Database</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <!-- skill item -->
            <div class="col-md-8">
                <span id="info"></span>
            </div>
            <div class="col-md-4">
                <div class="fact-item">
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em>Liên kết nhanh</em></h3><br>
                        <a href="get_session.php?act=filemanager&token=<?= @$_SESSION[$_COOKIE['PHPSESSID']]['auth']['login_time']; ?>" target="_blank" class="btn btn-default">File Manager</a>
                        <hr>
                        <a href="get_session.php?act=firewallmanager&token=<?= @$_SESSION[$_COOKIE['PHPSESSID']]['auth']['login_time']; ?>" target="_blank" class="btn btn-default">Firewall Manager</a>
                        <hr>
                        <a href="get_session.php?act=databasemanager&token=<?= @$_SESSION[$_COOKIE['PHPSESSID']]['auth']['login_time']; ?>" class="btn btn-default" target="_blank">Database Manager</a>
                        <hr>
                        <a href="#" data-toggle="modal" data-target="#getbackup" target="_blank" class="btn btn-default">Get Backup File</a>
                        <hr>
                        <a href="#" class="btn btn-default">Tối Ưu Hóa Server</a>
                        <hr>
                        <a href="#" data-toggle="modal" data-target="#updatetoken" target="_blank" class="btn btn-default">Cập Nhập Token Facebook</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buy Pro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>Kiểm soát sâu đến server</li>
                            <li>Hỗ trợ nhanh các vấn đề trong 24h kể từ khi nhận được yêu cầu</li>
                            <li>Truy cập các chức năng theo IP</li>
                            <li>Liên tục cập nhât bảng điều khiển, trực quan dễ dùng</li>
                            <li>Và vô vàn tính năng mới sắp update</li>
                        </ul>
                        <div id="resultt"></div>
                        <div id="resultt_loadbalace"></div>
                    </div>
                    <div class="modal-footer">
                        <h3 class="mb-0 mt-0 number"><em>HSD: <?= $hsd; ?></em></h3>
                        <button type="button" <? if ($bt_buy == 'false') {
                                                    echo 'disabled';
                                                } ?> class="btn btn-primary" onclick="load_ajax()" id="button">Buy</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updatetoken" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhập Token Facebook</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <textarea id="token" row="8" class="form-control"><?= file_get_contents("tokenfb.txt"); ?></textarea>
                        </form>
                        <div id="result_token"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="load_token()" id="button_token">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="getbackup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Get Backup File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="result_backup"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="load_backup()" id="button_backup">Lấy Danh Sách File Backup</button>
                    </div>
                </div>
            </div>
        </div>
        </p>
    </div>
    <div class="card-footer border-0 text-center py-4">

    </div>
</div>
<script>
    setTimeout(function() {
        $('#info').load('mlike.php?act=info');
    }, 1000);
    setInterval(function() {
        $.ajax({
            url: 'api.php?act=server_info',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#cpu_load').text(data.cpu);
                $('#mem_usage').text(data.ram);
                $('#load').text(data.load);
                $('#network').text(data.network);
                $('#bandwidth').text(data.bandwidth);
                $('#bandwidthdata').text(data.bandwidth_data);
                $('#backupsize').text(data.backup_usage);
                $('#backupfile').text(data.backup_size);
                $('#fw_all_block').text(data.firewall.total_banned);
                $('#fw_all_error').text(data.firewall.total_failed);
                $('#fw_block').text(data.firewall.currently_banned);
                $('#fw_block_error').text(data.firewall.currently_failed);
            }
        });
    }, 1000);
</script>
<script>
    function load_ajax() {
        $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $.ajax({
            url: "mlike.php?act=qrcode",
            type: "post",
            dataType: "text",
            data: {
                act: 'getqr',
            },
            success: function(result) {
                $('#button')['html']('Buy');
                $("#resultt").html(result);
                setInterval(function() {
                    $('#resultt_loadbalace').load('mlike.php?act=check_payment');
                }, 1000);
            }
        });
    }
</script>
<script>
    function load_token() {
        var token = $('#token').val();
        $('#button_token')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $("#button_token")
            .prop("disabled", true);
        $.ajax({
            url: "mlike.php?act=update_token",
            type: "post",
            dataType: "text",
            data: {
                token,
            },
            success: function(result) {
                $('#button_token')['html']('Cập Nhật');
                $("#result_token").html(result);
            }

        });
    }
</script>
<script>
    function load_backup() {
        var token = <?= $_SESSION['key']; ?>;
        $('#button_backup')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $("#button_backup")
            .prop("disabled", true);
        $.ajax({
            url: "mlike.php?act=get_backup",
            type: "post",
            dataType: "text",
            data: {
                token,
            },
            success: function(result) {
                $('#button_backup')['html']('Lấy Danh Sách File Backup');
                console.log(result);
                $("#result_backup").html(result);
                $("#button_backup")
                    .prop("disabled", false);
            },
            error: function(error) {
                alert("error" + error);
            }
        });
    }
</script>
<?php
require_once('../../_System/end.php');
?>