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

function getIDP(elm) {
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        if (!format.test(link)) {
            return;
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
            url: "https://huaducquan.id.vn/mlike/tiktok.php?type=video",
            data: {
                url: link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(response.link);
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
            url: "https://huaducquan.id.vn/mlike/tiktok.php?type=video",
            data: {
                url: link,
            },
            dataType: "json",
            success: function (response) {
                if (response.success == 200) {
                    $("[name=" + elm + "]")
                        .prop("disabled", false)
                        .val(link);
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
            type: "POST",
            url: "https://huaducquan.id.vn/mlike/tiktok.php?type=user",
            data: {
                url: link,
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
                    $('#detailServer').show().html(`<div class="alert bg-success text-white" role="alert">
                    <h4>Thông Tin User</h4><ul><b><li> ID: ${response.data.id}</li><li> Follow: ${follow}</li><li>Tài Khoản Riêng Tư: ${response.data.privateAccount}<li>Tên: ${response.data.name} - ${veryfied}</li><li>API By <a href="https://www.facebook.com/quancp72h" target="_blank">HDQuanDev</a></li></b></ul></div><br>`);
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

$(document).ready(function () {
    $("#get").click(function () {
        var id = $("#idbuff_like")["val"]();
        var result = null;
        var post_id = id["match"](/(.*)\/posts\/([0-9]{8,})/);
        var ins_id_post = id["match"](/(.*)\/p\/([a-zA-Z0-9]{8,})/);
        var photo_id = id["match"](/(.*)\/?fbid=([0-9]{8,})/);
        var album_id = id["match"](/(.*)\/media_set\?set=a.([0-9]{8,})/);
        var video_id = id["match"](/(.*)\/video.php\?v=([0-9]{8,})/);
        var story_id = id["match"](/(.*)\/story.php\?story_fbid=([0-9]{8,})/);
        var link_id = id["match"](/(.*)\/permalink.php\?story_fbid=([0-9]{8,})/);
        var tiktok_id = id["match"](
            /(.*)\/([a-zA-Z0-9]{1,})\/share\/([a-zA-Z0-9.]{2,})\/([a-zA-Z0-9.]{4,})/
        );
        var video_id_2 = id["match"](/(.*)\/?v=([0-9]{8,})/);
        var other_id = id["match"](/(.*)\/([a-zA-Z0-9.]{4,})/);
        var group_id = id["match"](/(.*)\/group\/([a-zA-Z0-9.]{4,})/);
        var tiktok_p = id["match"](/(.*)\/@([a-zA-Z0-9.]{3,})/);
        var comment_id = id["match"](/(.*)comment_id=([0-9]{8,})/);
        if (post_id) {
            result = post_id[2];
        } else {
            if (tiktok_id) {
                result = tiktok_id[4];
            } else {
                if (tiktok_p) {
                    result = tiktok_p[2];
                } else {
                    if (group_id) {
                        result = group_id[2];
                    } else {
                        if (ins_id_post) {
                            result = ins_id_post[2];
                        } else {
                            if (photo_id) {
                                result = photo_id[2];
                            } else {
                                if (video_id) {
                                    result = video_id[2];
                                } else {
                                    if (video_id_2) {
                                        result = video_id_2[2];
                                    } else {
                                        if (album_id) {
                                            result = album_id[2];
                                        } else {
                                            if (story_id) {
                                                result = story_id[2];
                                            } else {
                                                if (link_id) {
                                                    result = link_id[2];
                                                } else {
                                                    if (other_id) {
                                                        result = other_id[2];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if (comment_id) {
            result += "_" + comment_id[2];
        }
        console.log(result);
        if (result == null) {
            result =
                "Link bài viết không hợp lệ hoặc không hỗ trợ vui lòng liên hệ admin.";
        }
        $("#idbuff_like").val(result);
        $("#idbuff").val(result);
    });
});

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
                            data = '<a href="?act=history&id=' + row.id + '&user=' + row.user + '&st=' + row.sotien + '">Hủy Đơn</a>';
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
                        if (row.server == 'Server View 7') {
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