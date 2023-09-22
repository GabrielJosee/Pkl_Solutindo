<?php

namespace App\Helpers;

class Configuration
{
    public static function getSalesStatus(){
        $data = array(
            1 => "Belum Dibayar",
            2 => "Dibayar",
            3 => "Tidak Dibayar",
            4 => "Selesai",
            5 => "Tidak Selesai",
        );

        return $data;
    }

    public static function getSalesScheduleStatus(){
        $data = array(
            0 => "Akan Datang",
            1 => "Sudah Dilaksanakan",
            2 => "Tidak Dilaksanakan",
        );

        return $data;
    }
}

?>