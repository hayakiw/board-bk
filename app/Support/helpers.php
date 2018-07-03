<?php
use App\Models;
use App\Models\DateConversion;
use Carbon\Carbon;


if (!function_exists('mb_strim')) {
    function mb_strim($str, $start = 0, $length = 50, $marker = '...', $encoding = 'UTF-8')
    {
        $result = mb_substr($str, $start, $length, $encoding);

        if (mb_strlen($str, $encoding) > mb_strlen($result, $encoding)) {
            $result .= $marker;
        }

        return $result;
    }
}

if (!function_exists('javascript_encode')) {
    function javascript_encode($str)
    {
        $str = str_replace(array("\r\n", "\r", "\n"), '', $str);
        $str = str_replace(array("'"), "\'", $str);

        return $str;
    }
}


if (!function_exists('format_price')) {
    function format_price($price)
    {
        if (empty($price)) return $price;
        return number_format($price);
    }
}


if (!function_exists('format_date')) {
    function format_date($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        }

        return '';
    }
}


if (!function_exists('to_christian_year')) {
    function to_christian_year($year)
    {
        if ($jpYear = DateConversion::christianToJpYear($year)) {
            return $jpYear['元号名'] . $jpYear['年'];
        }

        return '';
    }
}


if (!function_exists('to_christian_month')) {
    function to_christian_month($month)
    {
        if (empty($month)) return null;

        if ($jpMonth = DateConversion::christianToJpYearMonth($month)) {
            if (empty($jpMonth)) return null;
            return $jpMonth['元号名'] . $jpMonth['年'] . '年' . $jpMonth['月'] . '月';
        }

        return null;
    }
}


if (!function_exists('to_christian_date')) {
    function to_christian_date($date)
    {
        if (empty($date)) return null;

        if ($jpDate = DateConversion::christianToJpYearDate(Carbon::parse($date)->format('Y-m-d'))) {
            if (empty($jpDate)) return null;
            return $jpDate['元号名'] . $jpDate['年'] . '年' . $jpDate['月'] . '月' . $jpDate['日'] . '日';
        }

        return null;
    }
}


if (!function_exists('format_datetime')) {
    function format_datetime($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('Y-m-d H:i');
        }

        return '';
    }
}

if ( ! function_exists('family_size')) {
    /**
     * プルダウン用の世帯人員数を返す
     *
     * @param void
     *
     * @return array
     */
    function family_size()
    {
        return [
            1  => '1人',
            2  => '2人',
            3  => '3人',
            4  => '4人',
            5  => '5人',
            6  => '6人',
            7  => '7人',
            8  => '8人',
            9  => '9人',
            10 => '10人',
            11 => '11人',
            12 => '12人',
            13 => '13人',
            14 => '14人',
            15 => '15人',
            16 => '16人',
            17 => '17人',
            18 => '18人',
            19 => '19人',
            20 => '20人',
        ];
    }
}
