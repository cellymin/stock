<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:25
 */
class Domain_Invoice_CURD
{
    public function getList($page_no, $page_size, $keyword, $supplierId, $payStatus, $invoiceStatus, $type)
    {
        $model = new Model_Invoice();

        //总条数
        $row_count = $model->count($keyword, $supplierId, $payStatus, $invoiceStatus, $type);
        $row_count = $row_count ? $row_count[0]['count'] : 0;

        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $keyword, $supplierId, $payStatus, $invoiceStatus, $type);

        $rs = array(
            'row_count'  => $row_count,
            'total_page' => $total_page,
            'page_no'    => $page_no,
            'page_size'  => $page_size,
            'list'       => $list
        );
        return $rs;
    }

    public function get($invoiceIds, $type = 0)
    {
        $model = new Model_Invoice();
        $supplier_model = new Model_Supplier();
        $customer_model = new Model_Customer();

        $list = array('invoices'     => array(),
                      'totalMoney'   => 0,
                      'supplierId'   => 0,
                      'supplierName' => '',
                      'companyId'    => 0,
            'targetId'=>0,
        );


        foreach ($invoiceIds as $invoiceId) {
            $invoice = $model->get($invoiceId);
            $user = DI()->userInfo;

            if ($type && $user['userGroup'] != 1 && $invoice['companyId'] != $user['companyId']) {
                throw new PhalApi_Exception_BadRequest('没有权限，不能操作其他公司发票');
                break;
            }

            if ($type && !empty($invoice['financeId'])) {
                throw new PhalApi_Exception_BadRequest('不能包含已付款的发票');
                break;
            }

            if ($type == 0 && $user['userGroup'] != 1 && $user['selectAll'] != 1 && $invoice['companyId'] != $user['companyId']) {
                throw new PhalApi_Exception_BadRequest('没有权限，不能操作其他公司发票');
                break;
            }

            $list['invoices'][] = $invoice;
            $list['totalMoney'] += $invoice['totalMoney'];
            if ($list['companyId'] == 0) {
                $list['companyId'] = $invoice['companyId'];
            }

            if ($list['supplierId'] == 0) {
                if ($invoice['type'] == 1) {
                    $supplier = $supplier_model->fetch($invoice['supplierId']);
                    if (!$supplier) {
                        throw new PhalApi_Exception_BadRequest('供应商不存在');
                        break;
                    }

                    $list['supplierId'] = $supplier['supplierId'];
                    $list['supplierName'] = $supplier['supplierName'];
                    $list['targetId'] = $supplier['supplierId'];
                } else {
                    $customer = $customer_model->get($invoice['supplierId']);
                    if (!$customer) {
                        throw new PhalApi_Exception_BadRequest('客户不存在');
                        break;
                    }

                    $list['customerId'] = $customer['customerId'];
                    $list['customerName'] = $customer['customerName'];
                    $list['targetId'] = $customer['customerId'];
                }
            }
            if ($list['targetId'] != $invoice['supplierId']) {
                throw new PhalApi_Exception_BadRequest('不能选择不同对象的发票');
                break;
            }
        }

        return $list;
    }

    public function collect($data){
        $model = new Model_Invoice();

        $invoince = $model->get($data['invoiceId']);
        if(!$invoince){
            throw new PhalApi_Exception_BadRequest('发票不存在');
        }
        if ($invoince['invoiceStatus']==1) {
            throw new PhalApi_Exception_BadRequest('不能操作,发票已收');
        }
        $invoiceId = $data['invoiceId'];
        unset($data['invoiceId']);
        $rs =  $model->update($invoiceId,$data);
        if($rs!==false){
            return true;
        }
        throw new PhalApi_Exception_BadRequest('操作失败');
    }
}