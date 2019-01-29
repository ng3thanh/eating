<?php

use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

if (!function_exists('checkIsNullOrEmpty')) {
    /**
     * @param $array
     * @return boolean
     */
    function checkIsNullOrEmpty($array)
    {
        if (is_null($array) || empty($array)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('checkIsNullOrEmptyCollection')) {

    /**
     * @param $collection
     * @return boolean
     */
    function checkIsNullOrEmptyCollection($collection)
    {
        if (is_null($collection) || $collection->isEmpty()) {
            return true;
        }
        return false;
    }
}

if (!function_exists('checkNotNullAndEmpty')) {
    /**
     * @param $array
     * @return boolean
     */
    function checkNotNullAndEmpty($array)
    {
        if (!is_null($array) && !empty($array)) {
            return true;
        }
        return false;
    }

}

if (!function_exists('checkIsNullOrEmptyStr')) {
    /**
     * @param $string
     * @return boolean
     */
    function checkIsNullOrEmptyStr($string)
    {
        if (is_null($string) || empty(trim($string))) {
            return true;
        }
        return false;
    }
}

if (!function_exists('validateStringIsNullOrEmpty')) {
    /**
     * this function return true when string is null or ''
     * else return false
     * @param $string
     * @return boolean
     */
    function validateStringIsNullOrEmpty($string)
    {
        if (is_null($string) || $string = "") {
            return true;
        }
        return false;
    }
}

if (!function_exists('getCurrentDate')) {
    /**
     * @param string $format
     * @return false|string
     */
    function getCurrentDate($format = 'Y/m/d H:i')
    {
        return date($format);
    }
}

if (!function_exists('formatDataBaseOnTable')) {
    /**
     * @param $tableName
     * @param $data
     * @return array
     */
    function formatDataBaseOnTable($tableName, $data)
    {
        $saveData = [];
        $columnName = DB::getSchemaBuilder()->getColumnListing($tableName);

        foreach ($columnName as $value) {
            if (array_key_exists($value, $data)) {
                $saveData[$value] = (isset($data[$value])) ? ($data[$value]) : null;
            }
        }

        if (isset($saveData['id'])) {
            unset($saveData['id']);
        }

        return $saveData;
    }
}

if (!function_exists('dateFormat')) {
    /**
     * @param $date
     * @param string $format
     * @return false|string
     */
    function dateFormat($date, $format = 'Y/m/d')
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('getFullQuery')) {
    /**
     * @param $builder
     * @return null|string|string[]
     */
    function getFullQuery($builder)
    {
        $sql = $builder->toSql();
        foreach ($builder->getBindings() as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
}

if (!function_exists('uploadImage')) {
    /**
     * Upload image
     * @param $id
     * @param $file
     * @param $location
     * @return string
     */
    function uploadImage($id, $file, $location)
    {
        $newName = $location . '_' . $id . '_main_image.' . $file->getClientOriginalExtension();
        $folder = config('upload.'. $location);
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $file->move($folder . $id . '/', $newName);
        return $newName;
    }
}

if (!function_exists('timeElapsedString')) {
    /**
     * Time Elapsed String
     *
     * @param $datetime
     * @param bool $full
     * @return string
     */
    function timeElapsedString($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('timeFormatTextDate')) {
    /**
     * @param $date
     * @return false|string
     */
    function timeFormatTextDate($date)
    {
        return date("F j, Y", strtotime($date));
    }
}

if (!function_exists('checkLanguage')) {
    /**
     * @param string $language
     * @param string $type
     * @return bool|string
     */
    function checkLanguage($language = 'en', $type = 'active')
    {
        $input = app()->getLocale();
        $return = '';

        if ($type == 'active') {
            $return = ($input == $language) ? 'active' : '';
        } elseif($type == 'boolean') {
            $return = ($input == $language) ? true : false;
        }

        return $return;
    }
}

if (!function_exists('breakStringToArray')) {
    /**
     * @param $string
     * @param string $character
     * @return array
     */
    function breakStringToArray($string, $character = ',')
    {
        $array = explode($character, $string);
        return $array;
    }
}

if (!function_exists('cutStringWithLongText')) {
    /**
     * @param $string
     * @param $numberCharacter
     * @return string
     */
    function cutStringWithLongText($string, $numberCharacter)
    {
        if(strlen($string) > $numberCharacter) {
            return substr($string, 0, $numberCharacter - 3) . ' ... ';
        } else {
            return $string;
        }
    }
}

if (!function_exists('getRoleOfUser')) {
    /**
     * @param $id
     * @return mixed
     */
    function getRoleOfUser($id)
    {
        $role = Sentinel::findRoleById($id);
        if ($role) {
            return $role->name;
        } else {
            return '';
        }

    }
}

if (!function_exists('getAvatarUser')) {
    /**
     * @param $avatar
     * @return string
     */
    function getAvatarUser($avatar)
    {
        if ($avatar) {
            return $avatar;
        } else {
            return config('upload.avatar') . "default.png";
        }

    }
}