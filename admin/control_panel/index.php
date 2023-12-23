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
            <?php
            if (isset($_GET['status'], $_GET['message']) && $_GET['status'] == 'success') {
                unlink("payment.json");
                echo '<div class="mb-3">
                <div class="alert alert-success" role="alert">
                    <p>Bạn đã thanh toán thành công, hệ thống sẽ tự tối ưu và dọn dẹp lại toàn bộ file hệ thống trong vòng 24h!! <a href="index.php">Vui lòng ấn vào đây để load lại trang</a></p>
                </div>
            </div>';
            }
            ?>
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
                        <h3 class="mb-0 mt-0 number"><em id="cachelog">Loading...</em></h3>
                        <p class="mb-0">Bộ Nhớ Cache/Log</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="fact-item">
                    <span class="icon icon-chart"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0 number"><em id="performentcahcelog">Loading...</em></h3>
                        <p class="mb-0">Đã Tối Ưu</p>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="alert alert-warning" role="alert">
                    <p>Bạn đang sử dụng gói pro bạn sẽ được xóa và tối tư tự động hóa 50MB miễn phí, đôi khi chúng tôi sẽ tự động tối ưu nhẹ để đảm bảo hiệu suất của máy chủ của bạn, hệ thống này đang hoạt động thử nghiệm, để xóa và tối ưu lại vui lòng liên hệ facebook giá siêu rẻ!!</p>
                </div>
            </div>
            <br>
            <button type="button" id="button_pay" onclick="create_pay();" class="btn btn-primary btn-rounded me-1 mb-1">Thanh toán ngay</button>
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
                        <a href="https://github.com/QDevTeam/mlike_project" target="_blank" class="btn btn-primary btn-rounded me-1 mb-1">File Manager</a>
                        <hr>
                        <a href="" target="_blank" class="btn btn-primary btn-rounded me-1 mb-1">Firewall Manager</a>
                        <hr>
                        <a href="http://216.9.227.213:888/phpmyadmin_98122d01e88e0708" class="btn btn-primary btn-rounded me-1 mb-1" target="_blank">Database Manager</a>
                        <hr>
                        <a href="#" data-toggle="modal" data-target="#getbackup" target="_blank" class="btn btn-primary btn-rounded me-1 mb-1">Get Backup File</a>
                        <hr>
                        <a href="#" class="btn btn-primary btn-rounded me-1 mb-1">Tối Ưu Hóa Server</a>
                        <hr>
                        <a href="#" data-toggle="modal" data-target="#updatetoken" target="_blank" class="btn btn-primary btn-rounded me-1 mb-1">Cập Nhập Token Facebook</a>
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
        $('#info').load('api.php?act=info');
    }, 1000);
    setInterval(function() {
        fetch('api.php?act=server_info')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cpu_load').textContent = data.cpu;
                document.getElementById('mem_usage').textContent = data.ram;
                document.getElementById('load').textContent = data.load;
                document.getElementById('network').textContent = data.network;
                document.getElementById('bandwidth').textContent = data.bandwidth + 'GB';
                document.getElementById('bandwidthdata').textContent = data.bandwidth_data + 'GB';
                document.getElementById('fw_all_block').textContent = data.firewall.total_banned;
                document.getElementById('fw_all_error').textContent = data.firewall.total_failed;
                document.getElementById('fw_block').textContent = data.firewall.currently_banned;
                document.getElementById('fw_block_error').textContent = data.firewall.currently_failed;
                document.getElementById('cachelog').textContent = data.disklog.size_number + 'MB (' + data.disklog.price + 'VND)';
                document.getElementById('performentcahcelog').textContent = data.disklog.op + 'MB';
            })
            .catch(error => console.error('Error:', error));
    }, 1000);
</script>
<script>
    function create_pay(disk, st) {
        swal({
            title: "Bạn có chắc chắn?",
            text: "Bạn có muốn thanh toán ngay không?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#button_pay')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button_pay")
                    .prop("disabled", true);
                $.ajax({
                    url: "api.php?act=create_url",
                    type: "post",
                    dataType: "json",
                    data: {
                        disk,
                        st,
                    },
                    success: function(result) {
                        if (result.status == 'success') {
                            const win = window.open(result.url, '_blank');
                            win.focus();
                        } else {
                            swal("Thất Bại!", "Thanh toán thất bại!", "error");
                        }
                        $('#button_pay')['html']('Thanh toán ngay');
                    }
                });
            }
        });
    }

    function load_token() {
        var token = $('#token').val();
        $('#button_token')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $("#button_token")
            .prop("disabled", true);
        $.ajax({
            url: "api.php?act=update_token",
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
<?php
require_once('../../_System/end.php');
?>