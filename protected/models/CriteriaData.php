<?php

class CriteriaData {

    public static $default = '-- ทั้งหมด --';

    public static function crayFishFilters() {
        return array(
            'age asc' => 'อายุ: ต่ำ - สูง',
            'age desc' => 'อายุ: สูง - ต่ำ', 
            'price asc' => 'ราคา: ต่ำ - สูง',
            'price desc' => 'ราคา: สูง - ต่ำ',            
        );
    }
    public static function accessoryFilters() {
        return array(
            'price asc' => 'ราคา: ต่ำ - สูง',
            'price desc' => 'ราคา: สูง - ต่ำ',            
        );
    }

    public static function prices() {
        return array(
            '' => self::$default,
            '100-1500' => '100-1500 บาท',
            '1501-3000' => '1501-3000 บาท',
            '3001-4500' => '3001-4500 บาท',
            '4501-6000' => '4501-6000 บาท',
            '6001-7500' => '6001-7500 บาท',
            '7501-9000' => '7501-9000 บาท',
            '9000-0' => '9001 บาท ขึ้นไป',
        );
    }

    public static function ages() {
        return array(
            '' => self::$default,
            '0-6' => '0-6 เดือน',
            '7-12' => '7-12 เดือน (1 ปี)',
            '13-18' => '13-18 เดือน',
            '19-24' => '19-24 เดือน (2 ปี)',
            '25-30' => '25-30 เดือน',
            '31-36' => '31-36 เดือน (3 ปี)',
            '37-42' => '37-42 เดือน',
            '43-0' => '43 เดือน ขึ้นไป',
        );
    }

}
