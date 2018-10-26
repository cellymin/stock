<?php

/**
 * 邮箱验证
 * Class Formatter_Email
 */
class Common_Formatter_Email implements PhalApi_Request_Formatter
{

    public function parse($value, $rule) {
        if (!preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/', $value)) {
            throw new PhalApi_Exception_BadRequest(T('invalid email'));
        }

        return $value;
    }
}