<?php

(defined('ABSPATH')) || exit;
function gregorian_to_jalali($g_y, $g_m, $g_d, $mod = '')
{
    $g_y   = sanitize_number($g_y);
    $g_m   = sanitize_number($g_m);
    $g_d   = sanitize_number($g_d); /* <= :اين سطر ، جزء تابع اصلي نيست */
    $d_4   = $g_y % 4;
    $g_a   = [ 0, 0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334 ];
    $doy_g = $g_a[ (int) $g_m ] + $g_d;
    if ($d_4 == 0 and $g_m > 2) {
        $doy_g++;
    }

    $d_33 = (int) ((($g_y - 16) % 132) * .0305);
    $a    = ($d_33 == 3 or $d_33 < ($d_4 - 1) or $d_4 == 0) ? 286 : 287;
    $b    = (($d_33 == 1 or $d_33 == 2) and ($d_33 == $d_4 or $d_4 == 1)) ? 78 : (($d_33 == 3 and $d_4 == 0) ? 80 : 79);
    if ((int) (($g_y - 10) / 63) == 30) {$a--;
        $b++;}
    if ($doy_g > $b) {
        $jy    = $g_y - 621;
        $doy_j = $doy_g - $b;
    } else {
        $jy    = $g_y - 622;
        $doy_j = $doy_g + $a;
    }
    if ($doy_j < 187) {
        $jm = (int) (($doy_j - 1) / 31);
        $jd = $doy_j - (31 * $jm++);
    } else {
        $jm = (int) (($doy_j - 187) / 30);
        $jd = $doy_j - 186 - ($jm * 30);
        $jm += 7;
    }
    return ($mod == '') ? [ $jy, $jm, $jd ] : $jy . $mod . $jm . $mod . $jd;
}

function jalali_to_gregorian($j_y, $j_m, $j_d, $mod = '')
{
    $j_y   = sanitize_number($j_y);
    $j_m   = sanitize_number($j_m);
    $j_d   = sanitize_number($j_d);
    $d_4   = ($j_y + 1) % 4;
    $doy_j = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d : (($j_m - 7) * 30) + $j_d + 186;
    $d_33  = (int) ((($j_y - 55) % 132) * .0305);
    $a     = ($d_33 != 3 and $d_4 <= $d_33) ? 287 : 286;
    $b     = (($d_33 == 1 or $d_33 == 2) and ($d_33 == $d_4 or $d_4 == 1)) ? 78 : (($d_33 == 3 and $d_4 == 0) ? 80 : 79);
    if ((int) (($j_y - 19) / 63) == 20) {$a--;
        $b++;}
    if ($doy_j <= $a) {
        $gy = $j_y + 621;
        $gd = $doy_j + $b;
    } else {
        $gy = $j_y + 622;
        $gd = $doy_j - $a;
    }
    foreach ([ 0, 31, ($gy % 4 == 0) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ] as $gm => $v) {
        if ($gd <= $v) {
            break;
        }

        $gd -= $v;
    }
    return ($mod == '') ? [ $gy, $gm, $gd ] : $gy . $mod . $gm . $mod . $gd;
}

function tarikh($data, $type = '')
{

    $data_array = explode(" ", $data);

    $data = $data_array[ 0 ];
    $time = (sizeof($data_array) >= 2) ? $data_array[ 1 ] : 0;

    $has_mode = (strpos($data, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $data);

    $ch_date = (strpos($data, '-')) ? gregorian_to_jalali($y, $m, $d, '/') : jalali_to_gregorian($y, $m, $d, '-');

    $has_mode = (strpos($ch_date, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $ch_date);
    if ($m < 10) {$m = '0' . $m;}
    if ($d < 10) {$d = '0' . $d;}

    $ch_date = $y . $has_mode . $m . $has_mode . $d;

    if ($type == 'time') {
        $new_date = $time;
    } elseif ($type == 'date') {
        $new_date = $ch_date;
    } elseif ($type == 'w') {

        if (strpos($ch_date, '/')) {

            list($y, $m, $d) = explode('/', $ch_date);

            $ch_date = jalali_to_gregorian($y, $m, $d, '-');

        }

        $timestamp = strtotime($ch_date);
        $dayOfWeek = date('w', $timestamp);

        $daysOfWeekPersian = [ 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه' ];

        $new_date = $daysOfWeekPersian[ $dayOfWeek ];
    } elseif ($type == 'm' && strpos($ch_date, '/')) {
        $month = [ 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند' ];

        $new_date = $d . " " . $month[ (absint($m) - 1) ] . " " . $y;
    } else {
        $new_date = ($time === 0) ? $ch_date : $ch_date . ' ' . $time;
    }

    return $new_date;

}
