<?php

/**
 * 座机验证
 * Class Formatter_Email
 */
class Common_Formatter_Tel implements PhalApi_Request_Formatter
{

    public function parse($value, $rule) {
        if(!preg_match('/^0\d{2,3}(\-)?\d{7,8}$/',$value)){
            throw new PhalApi_Exception_BadRequest(T('invalid tel'), 6);
        }

        return $value;
    }
}