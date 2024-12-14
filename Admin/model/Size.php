<?php
require_once 'pdo.php';

class Size
{
    public static function getAll()
    {
        $sql = "SELECT * FROM sizes";
        return pdo_query($sql);
    }
}
