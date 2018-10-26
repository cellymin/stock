<?php

/**
 * 姓名验证
 * Class Common_Formatter_Name
 */
class Common_Formatter_Name implements PhalApi_Request_Formatter
{
    public function parse($value, $rule) {
        if (!preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/', $value)) {
            throw new PhalApi_Exception_BadRequest('姓名 必须为2-4位中文');
        }

        return $value;
    }

}