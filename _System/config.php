<?php

if (isset($page)) {
    if ($page == 'view_tt') {
        ## on: bật, off: tắt
        $sv1 = 'on'; //bật tắt sv1
        $sv2 = 'on';
        $sv3 = 'on';
    } elseif ($page == 'view_fb') {
        $sv1 = 'off'; //bật tắt sv1
        $sv2 = 'off';
        $sv3 = 'off';
        $sv4 = 'off';
        $sv5 = 'on';
        $sv6 = 'off';
        $sv7 = 'off';
        $sv8 = 'on';
        $tay_or_auto = 'tay'; //auto: tự động, tay: thủ công
    } elseif ($page == 'tim_tt_tay') {
        $sv1 = 'off'; //bật tắt sv1
    } elseif ($page == 'like_fb') {
        $sv4 = 'off';
    } elseif ($page == 'page_fb') {
        $sv2 = 'on';
    } elseif ($page == 'share_fb') {
        $sv4 = 'on';
        $sv5 = 'on';
    }
}
