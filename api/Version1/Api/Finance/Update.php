<?php

class Api_Finance_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'financeId'     => array(
                    'name'    => 'financeId',
                    'type'    => 'int',
                    'min'     => 0,
                    'require' => true
                ),
                'money'         => array('name' => 'money', 'type' => 'float', 'min' => 0, 'require' => true),
                'invoiceImgs'   => array('name' => 'invoiceImgs', 'type' => 'string', 'require' => false),
                'payStatus'     => array(
                    'name'    => 'payStatus',
                    'type'    => 'enum',
                    'range'   => array(0, 1),
                    'require' => true
                ),
                'invoiceStatus' => array(
                    'name'    => 'invoiceStatus',
                    'type'    => 'enum',
                    'range'   => array(0, 1),
                    'require' => true
                ),
                'endTime'       => array('name' => 'endTime', 'type' => 'date', 'require' => false),
                'advanceDay'    => array('name' => 'advanceDay', 'type' => 'int', 'min' => 0, 'require' => false),
                'remark'        => array('name' => 'remark', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'financeId' => '', 'msg' => '');
        $noticeTime = '0000-00-00 00:00:00';


        if ($this->invoiceStatus == 0) {
            if (empty($this->endTime)) {
                throw new PhalApi_Exception_BadRequest('请选择预计收票时间', 0);
            }
            $unix_endTime = strtotime($this->endTime);
            if (!$unix_endTime) {
                throw new PhalApi_Exception_BadRequest('请选择预计收票时间格式不正确', 0);
            }
            if ($this->advanceDay) {
                $noticeTime = date('Y-m-d H:i:s', strtotime($this->endTime . ' -' . $this->advanceDay . 'day'));
            }
        }

        $domain = new Domain_Finance_CURD();

        $data = array(
            'financeId'     => $this->financeId,
            'money'         => $this->money,
            'invoiceImgs'   => $this->invoiceImgs,
            'payStatus'     => $this->payStatus,
            'invoiceStatus' => $this->invoiceStatus,
            'endTime'       => $this->endTime,
            'noticeTime'    => $noticeTime,
            'remark'        => $this->remark,
        );

        $id = $domain->update($data);
        if ($id) {
            $rs['code'] = 1;
            $rs['financeId'] = $id;
            return $rs;
        }
        $rs['msg'] = '保存失败';
        return $rs;
    }
}