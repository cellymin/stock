<?php

class Api_Finance_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'page_no'   => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size' => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'type'      => array('name' => 'type', 'type' => 'int', 'range' => array(1, 2), 'require' => false),
                'startTime' => array('name' => 'startTime', 'type' => 'date', 'require' => false),
                'endTime'   => array('name' => 'endTime', 'type' => 'date', 'require' => false),
            )
        );
    }

    public function go()
    {
        $startTime = strtotime($this->startTime);
        if (!empty($this->startTime) && !$startTime) {
            throw new PhalApi_Exception_BadRequest('开始时间格式错误');
        }
        $endTime = strtotime($this->endTime);
        if (!empty($this->endTime) && !$endTime) {
            throw new PhalApi_Exception_BadRequest('结束时间格式错误');
        }

        if (!empty($this->endTime) && $endTime < $startTime) {
            throw new PhalApi_Exception_BadRequest('结束时间不能小于等于开始时间');
        }

        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Finance_CURD();

        $list = $domain->getList($this->page_no, $this->page_size, $this->type, $this->startTime, $this->endTime);
        if ($list) {
            $rs['code'] = 1;
            $rs['content'] = $list;
            return $rs;
        }
        return $rs;
    }

}