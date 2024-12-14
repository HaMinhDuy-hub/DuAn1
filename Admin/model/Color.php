<?php
require_once 'pdo.php';

class Color
{
    public static function getAll()
    {
        $sql = "SELECT * FROM colors";
        return pdo_query($sql);
    }
}
