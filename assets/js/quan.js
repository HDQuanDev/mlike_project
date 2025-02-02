function isURL(str) {
    var pattern = new RegExp(
        "^(https?:\\/\\/)?" + // protocol
        "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|" + // domain name
        "((\\d{1,3}\\.){3}\\d{1,3}))" + // OR ip (v4) address
        "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + // port and path
        "(\\?[;&a-z\\d%_.~+=-]*)?" + // query string
        "(\\#[-a-z\\d_]*)?$",
        "i"
    ); // fragment locator
    return pattern.test(str);
}

function isUR(str) {
    var pattern = new RegExp(
        "^(https?:\\/\\/)?" + // protocol
        "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|" + // domain name
        "((\\d{1,3}\\.){3}\\d{1,3}))"
    ); // fragment loca tor
    return pattern.test(str);
}

const isValidUrl = urlString => {
    var urlPattern = new RegExp('^(https?:\\/\\/)?' + // validate protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // validate domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // validate OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // validate port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // validate query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // validate fragment locator
    return !!urlPattern.test(urlString);
}

function getDateTimeFromTimestamp(timestamp) {
    const date = new Date(timestamp * 1000);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();
    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
}

function isValidUrl_Q(string) {
    try {
        new URL(string);
    } catch (_) {
        return false;
    }

    return true;
}

function getIDP(elm) {
    setTimeout(() => {
        let linkk = $("[name=" + elm + "]").val();
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        if (!format.test(linkk)) {
            $('#notine').show().html(``);
            return;
        }
        if (isValidUrl_Q(linkk) == false) {
            let matches = linkk.match(/https:\/\/www\.facebook\.com\/[a-zA-Z\.]+[\/\?]+[^ ]*/g);
            if (matches !== null) {
                var link = matches[0];
                $('#notine').show().html(`<div class="alert bg-primary text-white" role="alert"><b>Nè bạn ưi, bạn vừa nhập sai link rồi đóa, nếu bạn copy link trên điện thoại thì chú ý nhenn!<br>- Link bạn nhập vào ô: ${linkk}<br>- Link mình sửa cho bạn nè: ${link}<br>Mình đã sửa và get id cho bạn rồi nhen, lần sau chú ý hơn nhaaa!</b></div><br>`);
            } else {
                var link = linkk;
                $('#notine').show().html(``);
            }
        } else {
            var link = linkk;
            $('#notine').show().html(``);
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        $.ajax({
            type: "GET",
            url: "/module/getid.php?type=like",
            data: {
                link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.id);
                    $("#button")
                        .prop("disabled", false);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("");
                    $("#button")
                        .prop("disabled", false);
                }
            },
        });
    }, 100);
}

function getIDP2(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        $.ajax({
            type: "GET",
            url: "/module/getid.php?type=follow",
            data: {
                link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.id);
                    $("#button")
                        .prop("disabled", false);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("");
                    $("#button")
                        .prop("disabled", false);
                }
            },
        });
    }, 100);
}

function getIDPL(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        var video_id = link["match"](/(.*)\/video.php\?v=([0-9]{8,})/);
        var video_id_2 = link["match"](/(.*)\/?v=([0-9]{8,})/);
        var other_id = link["match"](/(.*)\/videos\/([0-9.]{4,})/);
        var photo_id = link["match"](/(.*)\/photo.php\?fbid=([0-9]{8,})/);
        if (!isURL(link)) {
            return;
        }

        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        if (video_id) {
            result = video_id[2];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(result);
            $("#button")
                .prop("disabled", false)
        } else {
            if (video_id_2) {
                result = video_id_2[2];
                $("[name=" + elm + "]")
                    .prop("disabled", false)
                    .val(result);
                $("#button")
                    .prop("disabled", false)
            } else {
                if (other_id) {
                    result = other_id[2];
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(result);
                    $("#button")
                        .prop("disabled", false)
                } else {
                    if (photo_id) {
                        result = photo_id[2];
                        $("[name=" + elm + "]")
                            .prop("disabled", false)
                            .val(result);
                        $("#button")
                            .prop("disabled", false)
                    } else {
                        $.ajax({
                            type: "GET",
                            url: "/module/getid.php?post=post",
                            data: {
                                link,
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.status === 200) {
                                    $("[name=" + elm + "]")
                                        .prop("disabled", false)
                                        .val(response.id);
                                    $("#button")
                                        .prop("disabled", false)
                                } else {
                                    $("[name=" + elm + "]")
                                        .prop("disabled", false)
                                        .val("");
                                    $("#button")
                                        .prop("disabled", false)
                                }
                            },
                        });
                    }
                }
            }
        }
    }, 100);
}

function getIDA(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();

        if (!isUR(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $.ajax({
            type: "GET",
            url: "/module/getid.php?act=act",
            data: {
                link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(link);
                    $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
            <h4>Thông Tin Tài Khoản</h4>
            - <b>${response.name} (${response.id}) - ${response.follow} Follow</b></div><br>`);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("a");
                }
            },
        });
    }, 100);
}

function getView(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();

        if (!isUR(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/module/hdquandev.php?type=video",
            data: {
                url: link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.data.link);
                    var view = response.data.playCount;
                    var viewne = view.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                    if (response.data.user_verified == true) {
                        var veryfied = "Đã Xác Minh";
                    } else {
                        var veryfied = "Chưa Xác Minh";
                    }
                    $('#detailServer').show().html(`<div class="alert bg-success text-white" role="alert">
            <h4>Thông Tin Video</h4><ul><b><li> ID: ${response.data.id}</li><li> View: ${viewne}</li><li>Ngày Đăng: ${getDateTimeFromTimestamp(response.data.video_createTime)}<li>Người Đăng: ${response.data.name} - ${veryfied}</li><li>API By <a href="https://www.facebook.com/quancp72h" target="_blank">HDQuanDev</a></li></b></ul></div><br>`);
                    $("#button")
                        .prop("disabled", false);
                    $("#view")
                        .val(response.data.playCount);
                    $("#uid")
                        .val(response.data.id);
                    $("#link")
                        .val(response.data.link);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("Lỗi vui lòng nhập lại link!");
                    $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
            (*) Warning: Lỗi, vui lòng thử nhập lại link</div><br>`);
                }
            },
        });
    }, 100);
}

function getTym(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();

        if (!isUR(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/module/hdquandev.php?type=video",
            data: {
                url: link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.data.link);
                    var tim = response.data.diggCount;
                    var tim = tim.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                    if (response.data.user_verified == true) {
                        var veryfied = "Đã Xác Minh";
                    } else {
                        var veryfied = "Chưa Xác Minh";
                    }
                    $('#detailServer').show().html(`<div class="alert bg-success text-white" role="alert">
                    <h4>Thông Tin Video</h4><ul><b><li> ID: ${response.data.id}</li><li> Tim: ${tim}</li><li>Ngày Đăng: ${getDateTimeFromTimestamp(response.data.video_createTime)}<li>Người Đăng: ${response.data.name} - ${veryfied}</li><li>API By <a href="https://www.facebook.com/quancp72h" target="_blank">HDQuanDev</a></li></b></ul></div><br>`);
                    $("#button")
                        .prop("disabled", false);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("Lỗi vui lòng nhập lại link!");
                    $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
            (*) Warning: Lỗi, vui lòng thử nhập lại link</div><br>`);
                }
            },
        });
    }, 100);
}

function getFollow(elm) {
    setTimeout(() => {
        var link = $("[name=" + elm + "]").val();

        if (!isUR(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $("#button")
            .prop("disabled", true);
        $.ajax({
            "url": "/module/hdquandev.php?type=user",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": {
                "url": link
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(link);
                    var follow = response.data.user_follower;
                    var follow = follow.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                    if (response.data.user_verified == true) {
                        var veryfied = "Đã Xác Minh";
                    } else {
                        var veryfied = "Chưa Xác Minh";
                    }
                    if (response.data.privateAccount == true) {
                        var privateAccount = "Có";
                    } else {
                        var privateAccount = "Không";
                    }
                    $('#detailServer').show().html(`<div class="alert bg-success text-white" role="alert">
                    <h4>Thông Tin User</h4><ul><b><li> ID: ${response.data.id}</li><li> Follow: ${follow}</li><li>Tài Khoản Riêng Tư?: ${privateAccount}<li>Tên: ${response.data.name} - ${veryfied}</li><li>API By <a href="https://www.facebook.com/quancp72h" target="_blank">HDQuanDev</a></li></b></ul></div><br>`);
                    $("#button")
                        .prop("disabled", false);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("Lỗi vui lòng nhập lại link!");
                    $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
            (*) Warning: Lỗi, vui lòng thử nhập lại link</div><br>`);
                }
            },
        });
    }, 100);
}

function GetIDCmt(elm) {
    var link = $("[name=" + elm + "]").val();
    if (!isValidUrl(link)) {
        $("[name=" + elm + "]").prop("disabled", false).val("Vui lòng kiểm tra lại link của bạn, link không đúng định dạng!");
        return;
    }
    var id = link.match(/comment_id=([0-9]+)/);
    var result = id ? id[1] : null;
    if (result == null) {
        $("[name=" + elm + "]").prop("disabled", false).val("Không tìm thấy id comment trong link của bạn, vui lòng click vào thời gian của cmt muốn tăng và copy link!");
    } else {
        $("[name=" + elm + "]").prop("disabled", false).val(result);
    }
}

function getUID(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý...");
        $.ajax({
            type: "GET",
            url: "/module/getid.php?type=follow",
            data: {
                link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.id);
                } else {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val("");
                }
            },
        });
    }, 100);
}

$(document).ready(function () {
    $("#example").DataTable({
        order: [
            [0, "desc"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});

$(document).ready(function () {
    $(".btn-success").click(function () {
        // disable button
        //$(this).prop("disabled", true);
        // add spinner to button
        $("#loadingquan").addClass("firstquan");
        $(this).html(
            `
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      Loading...`
        );
    });
});

function Trangthai_order(tt) {
    if (tt == 1) {
        return '<span class="badge bg-primary">Đang Xử Lý</span>';
    } else if (tt == 2) {
        return '<span class="badge bg-success">Hoàn Thành</span>';
    } else if (tt == 3) {
        return '<span class="badge bg-warning">Đang Chạy</span>';
    } else if (tt == 4) {
        return '<span class="badge bg-danger">Bị Hủy</span>';
    } else if (tt == 5) {
        return '<span class="badge bg-danger">Hết Hạn</span>';
    } else if (tt == 6) {
        return '<span class="badge bg-danger">Link Die</span>';
    } else if (tt == 7) {
        return '<span class="badge bg-warning">Lỗi</span>';
    } else if (tt == 8) {
        return '<span class="badge bg-danger">Đã Hủy & Hoàn Tiền</span>';
    }
}

function getCookieValue(name) {
    const regex = new RegExp(`(^| )${name}=([^;]+)`)
    const match = document.cookie.match(regex)
    if (match) {
        return match[2]
    }
}

$(function () {
    $('#data-source').DataTable({
        "ajax": {
            "url": "/api/buy/tiktok/view.php?act=history_user",
            "type": "POST",
            "data": function (d) {
                return $.extend({}, d, {
                    "token": decodeURIComponent(getCookieValue("token")),
                    "limit": "10000"
                });
            }
        },
        "columns": [{
                data: 'id_order'
            },
            {
                data: 'time',
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        data = getDateTimeFromTimestamp(data);
                    }
                    return data;
                }
            },
            {
                data: 'number'
            },
            {
                data: 'start'
            },
            {
                data: 'done'
            },
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        data = '<a href="https://www.tiktok.com/@tiktok/video/' + row.id + '">' + data + '</a>';
                    }
                    return data;
                }
            },
            {
                data: 'server'
            },
            {
                data: 'user'
            },
            {
                data: 'status',
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        data = Trangthai_order(data);
                    }
                    return data;
                }
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        if (getCookieValue("cv") == '99') {
                            data = '<a href="?act=history&id=' + row.id_order + '&user=' + row.user + '&st=' + row.sotien + '">Hủy Đơn</a>';
                        } else {
                            data = null;
                        }
                        return data;
                    }
                    return null;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (type === 'display') {
                        if (row.server == 'Server View 7' || row.server == 'Server View 9') {
                            data = '<form><button type="button" id="button_' + row.id_order + '" class="btn btn-primary btn-rounded" onclick="huy_order_view(\'' + row.id_order + '\',\'' + decodeURIComponent(getCookieValue("token")) + '\')">Bảo Hành</button></form>';
                        } else {
                            data = null;
                        }
                        return data;
                    }
                    return null;
                }
            }
        ],
        "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "",
                "width": "75px"
            },

        ],
        order: [
            [0, "desc"]
        ],
        dom: 'B<"clear">lfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "pageLength": 10,
        "lengthMenu": [
            [10, 100, 500, 1000, "All"],
            [10, 100, 500, 1000, "All"]
        ]
    });
});

function huy_order_view(id, token) {
    var id_order = id;
    var token = token;
    $('#button_' + id + '')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
    $("#button_" + id + "")
        .prop("disabled", true);
    $.ajax({
        url: "/api/buy/tiktok/view.php?act=refill_view",
        type: "post",
        dataType: "json",
        data: {
            id_order,
            token,
        },
        success: function (response) {
            if (response.status === 'success') {
                swal('Hệ Thống!', response.msg, 'success');
            } else {
                swal('Hệ Thống!', response.msg, 'warning');
                $("#button_" + id + "")
                    .prop("disabled", false)
            }
            $('#button_' + id + '')['html']('Bảo Hành');
        }
    });
}
