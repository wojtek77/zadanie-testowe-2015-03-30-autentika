<?php

/**
 * Useful functions for coding, especially in Poland
 * @author Wojciech Brüggemann <wojtek77@o2.pl>
 */
class My_Coding {

    // ą ć ę ł ń ó ś ź ż
    // Ą Ć Ę Ł Ń Ó Ś Ź Ż

    static private $_win = array(
        "\xb9", "\xe6", "\xea", "\xb3", "\xf1", "\xf3", "\x9c", "\x9f", "\xbf",
        "\xa5", "\xc6", "\xca", "\xa3", "\xd1", "\xd3", "\x8c", "\x8f", "\xaf"
    );
    static private $_iso = array(
        "\xb1", "\xe6", "\xea", "\xb3", "\xf1", "\xf3", "\xb6", "\xbc", "\xbf",
        "\xa1", "\xc6", "\xca", "\xa3", "\xd1", "\xd3", "\xa6", "\xac", "\xaf"
    );
    static private $_utf = array(
        "\xc4\x85", "\xc4\x87", "\xc4\x99", "\xc5\x82", "\xc5\x84", "\xc3\xb3", "\xc5\x9b", "\xc5\xba", "\xc5\xbc",
        "\xc4\x84", "\xc4\x86", "\xc4\x98", "\xc5\x81", "\xc5\x83", "\xc3\x93", "\xc5\x9a", "\xc5\xb9", "\xc5\xbb"
    );
    static private $_noPl = array(
        'a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z',
        'A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z'
    );

    /*
     * these 3 functions with the prefix "all" can cause errors
     * te 3 funkcje z prefiksem "all" moga powodowac bledy
     */

    static public function allToUtf8($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_utf) + array_combine(self::$_iso, self::$_utf) + array_combine(self::$_win, self::$_utf);

        return strtr($s, $t);
    }
    static public function allToIso8859_2($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_iso) + array_combine(self::$_win, self::$_iso);

        return strtr($s, $t);
    }
    static public function allToWin1250($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_win) + array_combine(self::$_iso, self::$_win);

        return strtr($s, $t);
    }

    //-------

    static public function win1250ToUtf8($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_win, self::$_utf);

        return strtr($s, $t);
    }
    static public function utf8ToWin1250($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_win);

        return strtr($s, $t);
    }

    //-------

    static public function iso88592ToUtf8($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_iso, self::$_utf);

        return strtr($s, $t);
    }
    static public function utf8ToIso88592($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_iso);

        return strtr($s, $t);
    }

    //-------

    static public function win1250ToIso88592($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_win, self::$_iso);

        return strtr($s, $t);
    }
    static public function iso88592ToWin1250($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_iso, self::$_win);

        return strtr($s, $t);
    }
    
    //-------
    
    static public function removePolishCharactersFromWin1250($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_win, self::$_noPl);
        
        return strtr($s, $t);
    }
    static public function removePolishCharactersFromIso88592($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_iso, self::$_noPl);
        
        return strtr($s, $t);
    }
    static public function removePolishCharactersFromUtf8($s) {
        static $t;
        if (!isset($t))
            $t = array_combine(self::$_utf, self::$_noPl);
        
        return strtr($s, $t);
    }

}
