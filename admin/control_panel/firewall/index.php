<?php
$admin = 1;
require_once('../../../_System/db.php');
$title = 'Cấu hình tường lửa';
require_once('../../../_System/head.php');
?>

<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <center>
            <h2 class="card-title">Cài đặt tường lửa</h2>
        </center>
    </div>
    <hr>
    <div class="card-body">
        <div class="row">
            <h6 class="mb-0 text-uppercase">Thông Tin Tường Lửa</h6>
            <hr>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tên Miền: <span class="badge bg-primary" id="domain">NULL</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">IP Nội Bộ: <span class="badge bg-primary" id="ip_static">NULL</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Trạng Thái: <span class="badge bg-primary" id="fw_status">NULL</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Mức Độ Bảo Mật: <span class="badge bg-primary" id="fw_level">NULL</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Mức Bộ Nhớ Cache: <span class="badge bg-primary" id="fw_cache">NULL</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">IP Tường Lửa: <span class="badge bg-primary" id="fw_ip">NULL</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Nén: <span class="badge bg-primary" id="fw_compress">NULL</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Hỗ Trợ HTTP/2: <span class="badge bg-primary" id="fw_http2">NULL</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Max Tải Lên: <span class="badge bg-primary" id="fw_max_upload">NULL</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Chống Flood: <span class="badge bg-primary" id="fw_flood">NULL</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Phát Hiện ADV Nâng Cao: <span class="badge bg-primary" id="fw_adv">NULL</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Bộ Lọc BOT: <span class="badge bg-primary" id="fw_bot">NULL</span>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <center>
            <h2 class="card-title">Quản Lý IP</h2>
        </center>
    </div>
    <hr>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-xl-6">
                <h6 class="mb-0 text-uppercase">Thêm Mở Khóa IP</h6>
                <hr>
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="ip" placeholder="Nhập IP">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="allow_ip($('#ip').val());" id="bt_allow">Thêm</button>
                </form>
                <hr>
                <h6 class="mb-0 text-uppercase">Danh Sách IP Đã Mở Khóa</h6>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="list_allow">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">IP</th>
                                <th scope="col">Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td colspan="3" class="text-center">Đang Tải...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <h6 class="mb-0 text-uppercase">Thêm Chặn IP</h6>
                <hr>
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="ip_block" placeholder="Nhập IP">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="block_ip($('#ip_block').val());" id="bt_block">Chặn</button>
                </form>
                <hr>
                <h6 class="mb-0 text-uppercase">Danh Sách IP Đã Chặn</h6>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="list_block">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">IP</th>
                                <th scope="col">Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td colspan="3" class="text-center">Đang Tải...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'api.php?act=show_setting',
            dataType: 'json',
            success: function(data) {
                $('#domain').html(data.output.domain);
                $('#ip_static').html(data.output.internal_ip_main);
                if (data.output.proxy_active == '1') {
                    data.output.proxy_active = 'Đang Bật';
                } else {
                    data.output.proxy_active = 'Đang Tắt';
                }
                $('#fw_status').html(data.output.proxy_active);
                if (data.output.security_level == 'high') {
                    data.output.security_level = 'Cao';
                } else if (data.output.security_level == 'medium') {
                    data.output.security_level = 'Trung Bình';
                } else {
                    data.output.security_level = 'Thấp';
                }
                $('#fw_level').html(data.output.security_level);
                $('#fw_cache').html(data.output.cache_mode);
                $('#fw_ip').html(data.output.internal_domain_ip);
                $('#fw_compress').html(data.output.compression_mode);
                $('#fw_http2').html(data.output.spdy_mode);
                $('#fw_max_upload').html(data.output.max_upload_size);
                $('#fw_flood').html(data.output.http_flood_protection);
                $('#fw_adv').html(data.output.detect_adv_evasion);
                $('#fw_bot').html(data.output.aggressive_bot_filter);
                var processedData = data.output.whitelist_list.map(function(ip) {
                    return {
                        "IP": ip
                    };
                });

                $('#list_allow').DataTable({
                    data: processedData,
                    columns: [{
                            title: "#",
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'IP',
                            title: "IP"
                        },
                        {
                            title: "Chức năng",
                            data: null,
                            render: function(data, type, row, meta) {
                                return '<button class="btn btn-primary" onclick="allow_ip_del(\'' + data.IP + '\', \'allow_ip_del_' + meta.row + '\');" id="allow_ip_del_' + meta.row + '">Xóa</button>';
                            }
                        }
                    ]
                });
                var processedData_block = data.output.blacklist_list.map(function(ip) {
                    return {
                        "IP": ip
                    };
                });

                $('#list_block').DataTable({
                    data: processedData_block,
                    columns: [{
                            title: "#",
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'IP',
                            title: "IP"
                        },
                        {
                            title: "Chức năng",
                            data: null,
                            render: function(data, type, row, meta) {
                                return '<button class="btn btn-primary" onclick="block_ip_del(\'' + data.IP + '\', \'block_ip_del_' + meta.row + '\');" id="block_ip_del_' + meta.row + '">Xóa</button>';
                            }
                        }
                    ]
                });
            }
        });
    });

    function allow_ip(ip) {
        $('#bt_allow').html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý...');
        $('#bt_allow').attr('disabled', 'disabled');
        $.ajax({
            url: 'api.php?act=allow_ip&ip=' + ip,
            dataType: 'json',
            success: function(data) {
                if (data.status == '1') {
                    swal('Hệ Thống!', 'Đã thêm IP ' + ip + ' vào danh sách mở khóa!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    var error = data.messages[0];
                    swal('Hệ Thống!', 'Đã có lỗi xảy ra, vui lòng thử lại sau! (' + error + ')', 'error');
                    $('#bt_allow').html('Thêm');
                    $('#bt_allow').removeAttr('disabled');
                }
            }
        });
    }

    function allow_ip_del(ip, id) {
        $('#' + id).html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý...');
        $('#' + id).attr('disabled', 'disabled');
        $.ajax({
            url: 'api.php?act=allow_ip_del&ip=' + ip,
            dataType: 'json',
            success: function(data) {
                if (data.status == '1') {
                    swal('Hệ Thống!', 'Đã xóa IP ' + ip + ' khỏi danh sách mở khóa!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    var error = data.messages[0];
                    swal('Hệ Thống!', 'Đã có lỗi xảy ra, vui lòng thử lại sau! (' + error + ')', 'error');
                    $('#' + id).html('Xóa');
                    $('#' + id).removeAttr('disabled');
                }
            }
        });
    }

    function block_ip(ip) {
        $('#bt_block').html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý...');
        $('#bt_block').attr('disabled', 'disabled');
        $.ajax({
            url: 'api.php?act=block_ip&ip=' + ip,
            dataType: 'json',
            success: function(data) {
                if (data.status == '1') {
                    swal('Hệ Thống!', 'Đã thêm IP ' + ip + ' vào danh sách chặn!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    var error = data.messages[0];
                    swal('Hệ Thống!', 'Đã có lỗi xảy ra, vui lòng thử lại sau! (' + error + ')', 'error');
                    $('#bt_block').html('Chặn');
                    $('#bt_block').removeAttr('disabled');
                }
            }
        });
    }

    function block_ip_del(ip, id) {
        $('#' + id).html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý...');
        $('#' + id).attr('disabled', 'disabled');
        $.ajax({
            url: 'api.php?act=block_ip_del&ip=' + ip,
            dataType: 'json',
            success: function(data) {
                if (data.status == '1') {
                    swal('Hệ Thống!', 'Đã xóa IP ' + ip + ' khỏi danh sách chặn!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    var error = data.messages[0];
                    swal('Hệ Thống!', 'Đã có lỗi xảy ra, vui lòng thử lại sau! (' + error + ')', 'error');
                    $('#' + id).html('Xóa');
                    $('#' + id).removeAttr('disabled');
                }
            }
        });
    }
</script>
<?php require_once('../../../_System/end.php'); ?>