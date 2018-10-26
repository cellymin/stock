<?php

class Domain_Finance_CURD
{
    public function insert($data)
    {
        //生成财务支出
        $finance = array(
            'type'          => $data['type'],
            'cate'          => $data['cate'],
            'money'         => $data['money'],
            'targetId'      => 0,
            'remark'        => $data['remark'],
            'flag'          => 1,
            'companyId'     => DI()->userInfo['companyId'],
            'createCompany' => DI()->userInfo['companyId'],
            'createUser'    => DI()->userInfo['userId'],
            'createTime'    => date('Y-m-d H:i:s'),
            'invoiceIds'    => 0
        );

        $list = array();
        if ($data['cate'] == 8 || $data['cate'] == 9) {
            //采购 销售财务
            if (empty($data['invoiceIds'])) {
                throw new PhalApi_Exception_BadRequest('参数错误,未知发票', 0);
            }

            $domian = new Domain_Invoice_CURD();
            $list = $domian->get($data['invoiceIds'], 1);
            if ($list['invoices']) {
                $finance['targetId'] = $list['targetId'];
                $finance['companyId'] = $list['companyId'];
                $finance['invoiceIds'] = $data['invoiceIds'];
                $finance['money'] = $list['totalMoney'];
            }
        }

        try {
            DI()->notorm->beginTransaction('db_demo');

            $model = new Model_Finance();
            $financeId = $model->insert($finance);
            if (!$financeId) {
                throw new PDOException('保存失败', 1);
            }

            if ($data['cate'] == 8 || $data['cate'] == 9) {
                //更新发发票
                $model = new Model_Invoice();
                foreach ($list['invoices'] as $invoice) {
                    $input = array(
                        'financeId' => $financeId,
                        'payStatus' => 1,
                    );
                    $id = $model->update($invoice['invoiceId'], $input);
                    if ($id === false) {
                        throw new PDOException('保存失败', 1);
                        break;
                    }
                }
            }

            DI()->notorm->commit('db_demo');
            return $financeId;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }

    }


    public function getList($page_no, $page_size, $type, $startTime, $endTime)
    {
        $model = new Model_Finance();

        //总条数
        $row_count = $model->count($type, $startTime, $endTime);
        $row_count = $row_count ? $row_count[0]['count'] : 0;

        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $type, $startTime, $endTime);

        $rs = array(
            'row_count'  => $row_count,
            'total_page' => $total_page,
            'page_no'    => $page_no,
            'page_size'  => $page_size,
            'list'       => $list
        );

        return $rs;
    }

    public function get($financeId)
    {
        $model = new Model_Finance();

        $finance = $model->getFinanceDetails($financeId);
        if (!$finance) {
            throw new PhalApi_Exception_BadRequest('财务不存在', 0);
        }


        $model = new Model_Invoice();
        $invoices = $model->selectByFinanceId($financeId);

        $finance[0]['invoices'] = array();
        $finance[0]['invoicesTotalMoney'] = 0;
        if ($invoices) {
            $finance[0]['invoices'] = $invoices;
            foreach ($invoices as $invoice) {
                $finance[0]['invoicesTotalMoney'] += $invoice['totalMoney'];
            }
            if($finance[0]['cate']==8){
                $supplier_model = new Model_Supplier();
                $supplier = $supplier_model->fetch($finance[0]['targetId']);
                $finance[0]['supplierName'] = $supplier['supplierName'];
            }
            if($finance[0]['cate']==9){
                $customer_model = new Model_Customer();
                $customer = $customer_model->get($finance[0]['targetId']);
                $finance[0]['customerName'] = $customer['customerName'];
            }
        }

        return $finance[0];
    }

    public function update($data)
    {
        $finance = $this->get($data['financeId']);

        try {
            DI()->notorm->beginTransaction('db_demo');

            //更新财务
            $input = array(
                'remark'        => $data['remark'],
                'payStatus'     => $data['payStatus'],
                'invoiceStatus' => $data['invoiceStatus'],
            );

            if ($data['payStatus'] == 1) {
                $input['money'] = $data['money'];
            }
            if ($data['invoiceStatus'] == 1) {
                $input['invoiceImgs'] = $data['invoiceImgs'];
            }
            if ($data['invoiceStatus'] == 0) {
                $input['endTime'] = $data['endTime'];
                $input['noticeTime'] = $data['noticeTime'];
            }

            $model = new Model_Finance();

            $financeId = $model->update($data['financeId'], $input);
            if ($financeId === false) {
                throw new PDOException('保存失败', 1);
            }

            //更新发发票
            $model = new Model_Invoice();
            foreach ($finance['invoices'] as $invoice) {
                $input = array(
                    'payStatus'     => $data['payStatus'],
                    'invoiceStatus' => $data['invoiceStatus'],
                );
                if ($data['invoiceStatus'] == 0) {
                    $input['endTime'] = $data['endTime'];
                    $input['noticeTime'] = $data['noticeTime'];
                }
                $id = $model->update($invoice['invoiceId'], $input);
                if ($id === false) {
                    throw new PDOException('保存失败', 1);
                    break;
                }
            }

            DI()->notorm->commit('db_demo');
            return $financeId;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }
    }
}