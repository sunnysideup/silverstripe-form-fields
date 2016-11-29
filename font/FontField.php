<?php

/*
 *@author Romain[at]sunnysidep.co.nz
 *
 **/


class FontField extends DropdownField
{
    public static $font_families = array(
        'Arial',
        'Courier',
        'Courier New',
        'Georgia',
        'Lucida Console',
        'Times',
        'Times New Roman',
        'Verdana'
    );

    public static $generic_families = array(
        'Cursive',
        'Fantasy',
        'Monospace',
        'Sans-serif',
        'Serif'
    );

    public function __construct($name, $title = null, $value = '')
    {
        foreach (self::$font_families as $fontFamily) {
            foreach (self::$generic_families as $genericFamily) {
                $font = (strpos($fontFamily, ' ') ? "'$fontFamily'" : $fontFamily) . ", $genericFamily";
                $fonts[strtolower($font)] = $font;
            }
        }
        parent::__construct($name, $title, $fonts, $value);
    }
}
