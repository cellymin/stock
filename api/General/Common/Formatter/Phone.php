<?php

/**
 * 手机号验证
 * Class Formatter_Phone
 */
class Common_Formatter_Phone implements PhalApi_Request_Formatter
{

    public function parse($value, $rule) {
        if (!preg_match('/^(1(([35][0-9])|(47)|[8][01236789]))\d{8}$/', $value)) {
            throw new PhalApi_Exception_BadRequest(T('invalid phone'), 6);
        }

        return $value;
    }
}