<?php


namespace app\classes;
use app\classes\Router;


class Helper
{
    private static function strMonth($month): string
    {
        $ruMonths = array(
            '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля', '05' => 'мая', '06' => 'июня',
            '07' => 'июля', '08' => 'августа', '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'января'
        );

        return $ruMonths[$month];
    }

    public static function datetime(string $pattern, $date)
    {
        $dateTime = explode(' ', (string)$date);

        $date = explode('-', $dateTime[0]);
        $time = explode(':', $dateTime[1]);

        $parameters = array('%d' => $date[2], '%m' => $date[1], '%b' => self::strMonth($date[1]), '%y' => $date[0], '%H' => $time[0], '%M' => $time[1], '%S' => $time[2]);

        foreach ($parameters as $key => $value) {
            $pattern = str_replace($key, $value, $pattern);
        }

        return $pattern;
    }

    public static function navigate() {

    }

    public static function translit(string $value)
    {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        );

        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');

        return $value;
    }

    public static function generateUrl($title, $id)
    {
        return self::translit($title) . '-' . $id;
    }

//    public static function provider($value, string $file)
//    {
//        if(is_null($value) || !($value)) {
//            Router::route($file);
//            die();
//        }
//    }
}

