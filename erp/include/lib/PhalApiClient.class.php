<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class PhalApiClient
{
    protected $host = API_HOST;
    protected $secrect = API_SECRECT;

    protected $params = array();

    protected $moreParams = array();

    protected $url;
    protected $ret;
    protected $msg;
    protected $data = array();

    const RET_OK = 'OK';
    const RET_WRONG = 'WRONG';
    const RET_ERROR = 'ERROR';


    public function request($service, $params = array(), $timeoutMs = 3000)
    {
        if (!empty($service)) {
            $this->params['service'] = $service;
        }

        $params['timestamp'] = time();
        $params['user'] = $_SESSION[UserSession::SESSION_NAME]['user_id'];
        $params['referer'] = Common::getActionUrl();
        $params['sign'] = $this->encryptAppKey($params, $this->secrect);

        $this->url = $this->host . '?' . http_build_query($this->params);
        $this->moreParams = $params;

        $rs = $this->doRequest($this->url, $params, $timeoutMs);

        if ($rs === false) {
            $this->ret = self::RET_ERROR;
            $this->msg = '后台接口请求超时';
            return $this->getData();
        }
//        error_log(print_r($rs,1));

        $rs = json_decode($rs, true);


        if (isset($rs['data']['code']) && $rs['data']['code'] == 0) {
            $this->ret = self::RET_WRONG;
            $this->msg = '接口调用失败[code =' . $rs['data']['code'] . ']' . ', 错误>信息：' . isset($rs['data']['msg']) ? $rs['data']['msg'] : '无';
            return $this->getData();
        }

        $this->ret = intval($rs['ret']) == 200 ? self::RET_OK : self::RET_WRONG;
        $this->data = $rs['data'];
        $this->msg = $rs['msg']?$rs['msg']:$rs['data']['msg'];



        return $this->getData();
    }

    public function getRet()
    {
        return $this->ret;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function getUrl()
    {
        return $this->url . '&' . http_build_query($this->moreParams);
    }

    protected function encryptAppKey($params, $secrect)
    {
        ksort($params);

        $paramsStrExceptSign = '';
        foreach ($params as $val) {
            $paramsStrExceptSign .= $val;
        }

        return md5($paramsStrExceptSign . $secrect);
    }

    protected function doRequest($url, $data, $timeoutMs = 3000)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeoutMs);

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $rs = curl_exec($ch);

        curl_close($ch);

        return $rs;
    }
}