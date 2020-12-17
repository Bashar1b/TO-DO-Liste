<?php
spl_autoload_register('loadKlassen');
function loadKlassen($klassenName)
{
    $path = "lib/";
    $erweiterung = ".php";
    $fullpath = $path . $klassenName . $erweiterung;
    include_once $fullpath;
}