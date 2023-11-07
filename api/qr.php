<?php
if (isset($_POST['act']) && isset($_POST['vnd']) && isset($_POST['nd'])) {
    if ($_POST['act'] == 'getqr') {
        $vnd = $_POST['vnd'];
        $nd = $_POST['nd'];
        $img = 'https://img.vietqr.io/image/vietcombank-0061001062057-compact2.jpg?amount=' . $vnd . '&addInfo=' . $nd . '&accountName=Nguyen Ngoc Thanh Sang';
        echo '<br><center><h5 class="mb-3">Vui Lòng Quét Mã QR Để Chuyển Khoản</h5>
        <img class="img-thumbnail" src="' . $img . '" itemprop="thumbnail" alt="Image description"></center>';
    }
}
