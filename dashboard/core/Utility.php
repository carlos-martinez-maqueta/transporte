<?php


class Utility
{

    public static function readTemplateFile($FileName) {
        $fp = fopen($FileName, "r") or exit("Unable to open File " . $FileName);
        $str = "";
        while (!feof($fp)) {
            $str .= fread($fp, 1024);
        }
        return $str;
    }
    public static function fechaValida($date, $format = 'Y-m-d H:i:s')
    {
        if (strlen($date) == 10) {
            $format = 'Y-m-d';
        }
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public static function obtenerFechaConFormato($stringFecha, $formato = "d/m/Y")
    {
        if (!isset($stringFecha) || $stringFecha == null || !Utility::fechaValida($stringFecha)) return null;

        try {
            $date = new DateTime($stringFecha);
            return $date->format($formato);
        } catch (Exception $err) {
            return "";
        }
    }
}