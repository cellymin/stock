<?php

/**
 * 自定义Request
 * Class Common_Request
 */
class Common_Request extends PhalApi_Request
{
    public function genData($data) {
        if (!isset($data) || !is_array($data)) {
            return $data;
        }
        if (!isset($_GET['service'])) {
            $_GET['service'] = 'Default.Index';
        }

        $data['service'] = $_GET['service']?$_GET['service']:'Default.Index';

        return $data;
    }

}