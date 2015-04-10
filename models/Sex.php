<?php

namespace app\models;

use Yii;

class Sex
{
    public static $sexChoice = [
        1 => 'Мужской',
        2 => 'Женский',
    ];

    public static function get($sex = null)
    {
        return ($sex) ? self::$sexChoice[$sex] : self::$sexChoice;
    }
}
