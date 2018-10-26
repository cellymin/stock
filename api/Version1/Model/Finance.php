<?php

class Model_Finance extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'finance';
    }

    public function getTableKey($table)
    {
        return 'financeId';
    }

    public function count($type, $startTime, $endTime)
    {
        $sql = 'select count(*) as `count` '
            . 'from vich_finance f '
            . 'left join vich_companys c on c.companyId=f.companyId '
            . 'where f.flag=1 ';
        $param = array();
        if ($type) {
            $sql .= ' and f.type=:type';
            $param[':type'] = $type;
        }

        if ($startTime) {
            $sql .= ' and f.createTime>=:startTime';
            $param[':startTime'] = $startTime . ' 00:00:00';
        }

        if ($endTime) {
            $sql .= ' and f.createTime<=:endTime';
            $param[':endTime'] = $endTime . ' 23:59:59';
        }

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['selectAll'] != 1) {
            $sql .= ' and f.companyId=:companyId';
            $param[':companyId'] = DI()->userInfo['companyId'];
        }

        return $this->getORM()->queryAll($sql, $param);
    }

    public function getList($start, $page_size, $type, $startTime, $endTime)
    {
        $sql = 'select f.*,c.companyName, '
            .'(case f.type when 1 then "支出" when 2 then "收入" end) as typeDesc, '
            .'(case f.cate 
                when 1 then "水费" 
                when 2 then "电费"
                when 3 then "物流"
                when 4 then "工资"
                when 5 then "餐饮"
                when 6 then "配送"
                when 7 then "社保"
                when 8 then "采购"
                when 9 then "销售"
                when 10 then "固定资产"
                end) as cateDesc '
            . 'from vich_finance f '
            . 'left join vich_companys c on c.companyId=f.companyId ';
            $sql .= 'where f.flag=1 ';
        $param = array();

        if ($type) {
            $sql .= ' and f.type=:type';
            $param[':type'] = $type;
        }

        if ($startTime) {
            $sql .= ' and f.createTime>=:startTime';
            $param[':startTime'] = $startTime . ' 00:00:00';
        }

        if ($endTime) {
            $sql .= ' and f.createTime<=:endTime';
            $param[':endTime'] = $endTime . ' 23:59:59';
        }

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['selectAll'] != 1) {
            $sql .= ' and f.companyId=:companyId';
            $param[':companyId'] = DI()->userInfo['companyId'];
        }

        $sql .= ' order by f.createTime desc ';
        if ($page_size) {
            $sql .= " limit $start,$page_size";
        }

        $list = array();
        $supplier_model = new Model_Supplier();
        $customer_model = new Model_Customer();
        foreach ($this->getORM()->queryAll($sql, $param) as $row){
            $temp = $row;

            if($row['cate']==8){
                $supplier = $supplier_model->fetch($row['targetId']);
                $temp['targetName'] = $supplier['supplierName'];
            }
            if($row['cate']==9){
                $supplier = $customer_model->get($row['targetId']);
                $temp['targetName'] = $supplier['customerName'];
            }
            $list[] = $temp;
        }
        return $list;
    }

    public function getFinanceDetails($financeId)
    {
        $sql = 'select f.*,(case f.type when 1 then "支出" when 2 then "收入" end) as `typeDesc`, '
            .'(case f.cate 
                when 1 then "水费" 
                when 2 then "电费"
                when 3 then "物流"
                when 4 then "工资"
                when 5 then "餐饮"
                when 6 then "配送"
                when 7 then "社保"
                when 8 then "采购"
                when 9 then "销售"
                when 10 then "固定资产"
                end) as cateDesc '
            . 'from vich_finance f '
            . 'where f.financeId=:financeId ';
        $param[':financeId'] = $financeId;

        return $this->getORM()->queryAll($sql, $param);
    }
}