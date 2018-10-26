<?php

class Model_Invoice extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'invoices';
    }

    public function getTableKey($table)
    {
        return 'invoiceId';
    }

    public function count($keyword, $supplierId, $payStatus, $invoiceStatus, $type)
    {

        $sql = 'select count(*) as `count` '
            . 'from vich_invoices i ';
        if ($type == 1) {
            $sql .= 'left join vich_suppliers s on s.supplierId=i.supplierId '
                . 'left join vich_orders_ip o on o.orderId=i.orderId ';
        } else {
            $sql .= 'left join vich_customers s on s.customerId=i.supplierId '
                . 'left join vich_orders_so o on o.orderId=i.orderId ';
        }

        $sql .= 'where (i.invoiceNo like :keyword or o.orderNo like :keyword) and i.type=:type ';

        $param[':keyword'] = '%' . $keyword . '%';
        $param[':type'] = $type;
        if ($supplierId) {
            if ($type == 1) {
                $sql .= ' and s.supplierId=:supplierId';
            } else {
                $sql .= ' and s.customerId=:supplierId';
            }

            $param[':supplierId'] = $supplierId;
        }

        if ($payStatus) {
            $sql .= ' and i.payStatus=:payStatus';
            $param[':payStatus'] = $payStatus - 1;
        }
        if ($invoiceStatus) {
            $sql .= ' and i.invoiceStatus=:invoiceStatus';
            $param[':invoiceStatus'] = $invoiceStatus - 1;
        }

        $user = DI()->userInfo;
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $sql .= ' and i.companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }
//        error_log(print_r($sql,1));
        return $this->getORM()->queryAll($sql, $param);
    }

    public function getList($start, $page_size, $keyword, $supplierId, $payStatus, $invoiceStatus, $type)
    {
        $limit = "";
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }

        if($type==1)
            $column = 's.supplierName';
        else
            $column = 's.customerName';

        $sql = 'select i.*,'.$column.',o.orderNo,co.companyName,'
            . '(case i.payStatus when 0 then "未付款" when 1 then "已付款" end) as payFlag, '
            . '(case i.invoiceStatus when 0 then "未收票" when 1 then "已收票" end) as invoiceFlag '
            . 'from vich_invoices i ';
        if ($type == 1) {
            $sql .= 'left join vich_suppliers s on s.supplierId=i.supplierId '
                . 'left join vich_orders_ip o on o.orderId=i.orderId ';
        } else {
            $sql .= 'left join vich_customers s on s.customerId=i.supplierId '
                . 'left join vich_orders_so o on o.orderId=i.orderId ';
        }
        $sql .= 'left join vich_companys co on co.companyId=i.companyId '
            . 'where (i.invoiceNo like :keyword or o.orderNo like :keyword) and i.type=:type';

        $param[':keyword'] = "%" . $keyword . "%";
        $param[':type'] = $type;
        if ($supplierId) {
            if ($type == 1) {
                $sql .= ' and s.supplierId=:supplierId';
            } else {
                $sql .= ' and s.customerId=:supplierId';
            }
            $param[':supplierId'] = $supplierId;
        }

        if ($payStatus) {
            $sql .= ' and i.payStatus=:payStatus';
            $param[':payStatus'] = $payStatus - 1;
        }
        if ($invoiceStatus) {
            $sql .= ' and i.invoiceStatus=:invoiceStatus';
            $param[':invoiceStatus'] = $invoiceStatus - 1;
        }

        $user = DI()->userInfo;
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $sql .= ' and i.companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }

        $sql .= ' order by i.createTime desc';
        $sql .= $limit;
//        error_log(print_r($sql,1));
        return $this->getORM()->queryAll($sql, $param);
    }

    public function selectByFinanceId($financeId)
    {
        return $this->getORM()->select('*')->where('financeId=?', $financeId)
            ->fetchAll();
    }

    public static function searchNeedNotice($companyId)
    {
        $time = date('Y-m-d H:i:s');
        return DI()->notorm->invoices
            ->select('*')
            ->where('flag=1 and invoiceStatus=0 and noticeTime is not null and noticeTime<=? and companyId=?',
                array($time, $companyId))
            ->fetchAll();
    }
}