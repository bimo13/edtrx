<?php namespace Trim;

class TrimCustom {
    static public function GetTrim($s,$l) {
        if (strlen($s) > $l) {
            $offset = ($l - 3) - strlen($s);
            $s = substr($s, 0, strrpos($s, ' ', $offset)) . '...';
        }

        return $s;
    }
}