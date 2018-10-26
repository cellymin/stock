<?php

/**
 * 银行卡号验证
 * Class Common_Formatter_BankNo
 */
class Common_Formatter_Bank implements PhalApi_Request_Formatter
{
    public function parse($value, $rule)
    {
        $len = strlen($value);
        if ($len != 15 && $len != 16 && $len != 19) {
            throw new PhalApi_Exception_BadRequest('银行卡号不正确', 0);
        }

        $arr_no = str_split($value);
        $last_n = $arr_no[count($arr_no)-1];
        krsort($arr_no);
        $i = 1;
        $total = 0;
        foreach ($arr_no as $n){
            if($i%2==0){
                $ix = $n*2;
                if($ix>=10){
                    $nx = 1 + ($ix % 10);
                    $total += $nx;
                }else{
                    $total += $ix;
                }
            }else{
                $total += $n;
            }
            $i++;
        }
        $total -= $last_n;
        $total *= 9;
        if($last_n != ($total%10)){
            throw new PhalApi_Exception_BadRequest('银行卡号不正确', 0);
        }
        return $value;
    }
}