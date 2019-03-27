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
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );
        return $rs;
    }

    public function get($invoiceIds, $type = 0)
    {
        $model = new Model_Invoice();
        $supplier_model = new Model_Supplier();
        $customer_model = new Model_Customer();

        $list = array('invoices' => array(),
            'totalMoney' => 0,
            'supplierId' => 0,
            'supplierName' => '',
            'taxrate' => '',
            'companyId' => 0,
            'targetId' => 0,
            'adjustamount' => '',
            'trueInvoiceNo' => '',
        );
        $invoiceNo = array();
        foreach ($invoiceIds as $invoiceId) {
            $invoice = $model->get($invoiceId);
            if(empty($invoice)){
                break;
            }
            $user = DI()->userInfo;
            if (!empty($invoice['trueInvoiceNo'])) {
                $invoiceNo[] = $invoice['trueInvoiceNo'];
            }
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
                    $list['taxrate'] = $supplier['taxrate'];
                    $list['adjustamount'] = $invoice['adjustamount'];
                    $list['trueInvoiceNo'] = $invoice['trueInvoiceNo'];
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
        $invoiceNo = array_unique($invoiceNo);
        if (count($invoiceNo) > 1 && $type) {
            throw new PhalApi_Exception_BadRequest('不能操作发票号不一样的发票');
        }
        return $list;
    }
    /*
     * 获取含税价总价
     *
     */
    public function getPriceHan($invoiceId){
        if(!empty($invoiceId)){
            if(is_array($invoiceId)){
               $idsstr = implode(',',$invoiceId);
               $sql = "SELECT ig.* FROM `vich_invoices` i
                       INNER JOIN vich_orders_ip ip ON i.orderId = ip.orderId
                       INNER JOIN vich_orders_ip_goods ig ON ip.orderId = ig.orderId
                       WHERE i.flag = 1 AND i.type = '1' AND ip.flag = 3 AND ig.flag = 1 AND i.invoiceId IN (".$idsstr.")";
               $res = DI()->notorm->invoices->queryAll($sql);
               if(empty($res)){
                   return false;
               }
               $totalpri = 0;
               foreach ($res as $k){
                   if($k['usecostpri']>0){
                       $totalpri += $k['goodsCnt'] * $k['usecostpri'];
                   }else{
                       $totalpri += $k['goodsCnt'] * $k['goodsPrice'];
                   }
               }
               return $totalpri;
            }
        }

    }
    /*
     * 获取含有invoiceId 的所有关联发票id
     */
    public function getListInfo($invoiceId,$type=0)
    {
        $heprinum = 0;
        $model = new Model_Invoice();
        $invoice = array();
        $invoiceids = array();
        foreach ($invoiceId as $k => $v) {
            $res = DI()->notorm->invoices_adjust->select('id,ids,adjustpri,trueInvoiceNo')->where("FIND_IN_SET($v,ids)")->fetchRows();
            if (!empty($res)) {
                if( !empty($invoice[0])){
                    if(!in_array($res[0]['id'],$invoice[0]) ){
                        $heprinum = floatval($res[0]['adjustpri']) + $heprinum;
                    }
                }else{
                    $heprinum = floatval($res[0]['adjustpri']) + $heprinum;
                }
                $invoice[0][] = $res[0]['id'];
                $invoiceids[] = $res[0]['ids'];
                $invoicepri[] = $res[0]['adjustpri'];
                $trueInvoiceNo[] = $res[0]['trueInvoiceNo'];
            }
            unset($res);
        }
        if (empty($invoice)) {
            return $invoice;
        }
        $invoice = array_unique($invoice);
        $invoiceids = array_unique($invoiceids);
        $invoicepri = array_unique($invoicepri);
        $trueInvoiceNo = array_unique($trueInvoiceNo);
        if ((count($invoice) > 1 || count($invoiceids) > 1 || count($invoicepri) > 1 )&& $type) { //两张合并发票单
            // return 1;
            throw new PhalApi_Exception_BadRequest('不能操作两张已合并发票');
        }
        if (!empty($invoiceids) && $type) {
            $invoice[1] = $invoiceids[0];//关联发票id
        }else if(!empty($invoiceids) && !$type){
            $invoice['invoiceids'] = $invoiceids;
        }
        if (!empty($invoicepri) && $type) {
            $invoice[2] = $invoicepri[0]; //调整金额
        }else if(!empty($invoicepri) && !$type){
            $invoice['adjprilist'] = $heprinum;
        }
        if (!empty($trueInvoiceNo) && $type) {
            $invoice[3] = $trueInvoiceNo[0]; //调整金额
        }else if(!empty($trueInvoiceNo) && !$type){
            $invoice['trueInvoiceNo'] = $trueInvoiceNo;
        }
        return $invoice;
    }

    public function collect($data)
    {
        $model = new Model_Invoice();

        $invoince = $model->get($data['invoiceId']);
        if (!$invoince) {
            throw new PhalApi_Exception_BadRequest('发票不存在');
        }
        if ($invoince['invoiceStatus'] == 1) {
            throw new PhalApi_Exception_BadRequest('不能操作,发票已收');
        }
        $invoiceId = $data['invoiceId'];
        unset($data['invoiceId']);
        $rs = $model->update($invoiceId, $data);
        if ($rs !== false) {
            return true;
        }
        throw new PhalApi_Exception_BadRequest('操作失败');
    }

    /**
     * @param $data
     * @return bool
     * @throws PhalApi_Exception_BadRequest
     * 多张发票合并修改
     */
    public function collectList($data, $lionid = '')
    {
        //调整金额
        $doadj = substr(trim($data['adjustamount']), 0, 1);
        $adj = floatval(substr(trim($data['adjustamount']), 1)); //操作的金额
        $trueadj = $data['adjustamount'];
        $trueInvoiceNo = $data['trueInvoiceNo'];
        // $data['adjustamount'] = '';
        // $data['trueInvoiceNo'] = '';

        if (empty($data['invoiceId'])) {
            throw new PhalApi_Exception_BadRequest('没有数据');
        }
        try {
            DI()->notorm->beginTransaction('db_demo');
            //发票关联表，插入数组
            $resid = DI()->notorm->invoices_adjust->select('ids')->where('id', $lionid)->fetchRow();
            if (!empty($resid)) { //关联表中已有id 存在
                $invoiceIds = explode(',', $resid['ids']);
                if (!empty($data['invoiceId'])) {
                    //合并所有发票id
                    $invoiceIds = array_unique(array_merge($invoiceIds, $data['invoiceId']));
                }
                asort($invoiceIds);
            } else {
                $invoiceIds = $data['invoiceId'];
            }

            $invoiceAdj = array(
                'ids' => implode(',', $invoiceIds),
                'adjustpri' => trim($trueadj),
                'trueInvoiceNo' => trim($trueInvoiceNo),
                'flag' => 1
            );
            $model = new Model_Invoice();
            if (!empty($invoiceIds)) {
                foreach ($invoiceIds as $k => $v) {
                    $invoince = $model->get($v);
                    if (!$invoince) {
                        throw new PhalApi_Exception_BadRequest('发票不存在');
                    }
                    if ($invoince['invoiceStatus'] == 1) {
                        throw new PhalApi_Exception_BadRequest($invoince['invoiceNo'] . '不能操作,发票已收');
                    }
                    $data['invoiceId'] = $v;
                    $model->update($v, $data);
                }
            }
            //调整发票关联表
            if (empty($lionid)) {
                $ifcuntrueno = DI()->notorm->invoices_adjust->select('id')->where('trueInvoiceNo', $trueInvoiceNo)->fetchRow();
                if (!empty($ifcuntrueno)) {
                    throw new PhalApi_Exception_BadRequest('发票号已存在');
                }
                $invoiceAdj['createtime'] = date('Y-m-d', time());
                $res = DI()->notorm->invoices_adjust->insert($invoiceAdj);
            } else {
                $invoiceAdj['updatetime'] = date('Y-m-d', time());
                $res = DI()->notorm->invoices_adjust->where('id', $lionid)->update($invoiceAdj);
            }
            DI()->notorm->commit('db_demo');
            return true;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }
    }

    public function getIndoById($invoiceId)
    {
        $model = new Model_Invoice();
        $rr = $model->getIndoById($invoiceId);
        return $rr;
    }

    public function updateVerify($invoiceId)
    {
        $model = new Model_Invoice();
        $data['ifverify'] = 1;
        try {
            DI()->notorm->beginTransaction("db_demo");
            foreach ($invoiceId as $k => $v) {
                $model->update($v, $data);
            }
            DI()->notorm->commit('db_demo');
            return true;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }
    }

}