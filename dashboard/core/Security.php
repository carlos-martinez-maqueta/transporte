<?php


class Security
{
   
    public static function getUserId()
    {
        return $_SESSION["user_id"];
    }


   
}
