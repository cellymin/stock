<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

/**
 * 报表类
 * Class Report
 */
class Report extends Base
{
    //各部门领用明细表
    public static function usingReport($companyId,$keyword, $startTime, $endTime,$departmentId,$page_no)
    {
        $db = self::__instance();

        //查询领用商品
        $sql = "select DISTINCT(oy.goodsId),g.goodsName,g.goodsCateId,g.goodsSn,c.cateName,oy.departmentId,d.departmentName
                 ,e.companyId,e.companyName,f.unitId,f.unitName,oy.goodsCnt,oy.goodsPrice,oy.createTime
                from vich_orders_oy_goods oy
                left join vich_goods g on g.goodsId=oy.goodsId
                left join vich_goods_cates c on c.cateId=g.goodsCateId
                left join vich_departments d on oy.departmentId = d.departmentId
                left join vich_companys e on e.companyId = oy.createCompany
                left join vich_goods_units f on f.unitId = goodsUnitId
                left join vich_orders_oy h on oy.orderId= h.orderId
                where oy.flag=1 and e.flag=1 and d.flag=1 and f.flag=1 and (g.goodsSn like '%$keyword%' or g.goodsName like '%$keyword%')";
        $bindParam = array();
        if(!$startTime){
            $time=date('Y-01-01');
            $sql .=" and oy.createTime>='$time'";
        }
        if ($companyId) {
            $sql .= ' and oy.createCompany='.$companyId;
            $bindParam['companyId'] = $companyId;
        }
        if ($startTime) {
            $sql .= " and oy.createTime>='$startTime' ";
            $bindParam['startTime'] = $startTime;
        }
        if ($endTime) {
            $sql .= " and oy.createTime<='$endTime' ";
            $bindParam['endTime'] = $endTime;
        }
        if($departmentId){
            $sql .= ' and oy.departmentId='.$departmentId;
            $bindParam['departmentId'] = $departmentId;
        }
        $count = count($db->query($sql)->fetchAll());
        if($count>0){
            $row_count = $count;//总条数
            $page_size = 20;
            $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
            $total_page = $total_page < 1 ? 1 : $total_page;//页数
            $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;//当前页
            $start = ($page_no - 1) * $page_size;
        }
        $limit = "";
        if ($page_size) {
            $sql .= " limit $start,$page_size";
        }
        $stmt = $db->prepare($sql);
        $stmt->execute($bindParam);
        $goods = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //查询所有公司
        if($companyId>0){
            $com = $db->select('vich_companys', 'companyId,companyName', array('companyId'=>$companyId));
            $comall = $db->select('vich_companys', 'companyId,companyName', array('flag' => 1));
        }else{
            $com = $db->select('vich_companys', 'companyId,companyName', array('flag' => 1));
        }

        //查询所有部门
        if($departmentId>0){
            $deps = $db->select('vich_departments', 'departmentId,departmentName', array('departmentId'=>$departmentId));
            $depsall = $db->select('vich_departments', 'departmentId,departmentName', array('flag' => 1));
        }else{
            $deps = $db->select('vich_departments', 'departmentId,departmentName', array('flag' => 1));
        }

        $list = array();
        if($comall){
            foreach ($comall as $d){
                $list['com'][ $d['companyId']]=$d['companyName'];
            }
        }else if($com){
            foreach ($com as $d){
                $list['com'][ $d['companyId']]=$d['companyName'];
            }
        }

        if($depsall){
            foreach ($depsall as $d){
                $list['deps'][ $d['departmentId']]=$d['departmentName'];
            }
        }else if($deps){
            foreach ($deps as $d){
                $list['deps'][ $d['departmentId']]=$d['departmentName'];
            }
        }
        if (!$deps) {
            return array();
        }
        if (!$goods && !$depsall && !$deps) {
            return array();
        }else if(!$goods && $depsall){
            return $list;
        }

        $list['total'] = 0;
        $departments = array();
        $list['goods'] = $goods;
        $list['row_count'] = $row_count;
        $list['total_page'] = $total_page;
        $list['page_no'] = $page_no;
        $list['page_size'] = $page_size;
        return $list;
    }
    //各部门领用明细表
    public static function usingReportold($companyId, $startTime, $endTime,$departmentId)
    {
        $db = self::__instance();

        //查询领用商品
        $sql = "select DISTINCT(oy.goodsId),g.goodsName,g.goodsCateId,c.cateName
                from vich_orders_oy_goods oy
                left join vich_goods g on g.goodsId=oy.goodsId
                left join vich_goods_cates c on c.cateId=g.goodsCateId
                where oy.flag=1";

        $bindParam = array();
        if ($companyId) {
            $sql .= ' and oy.createCompany=:companyId';
            $bindParam['companyId'] = $companyId;
        }
        if ($startTime) {
            $sql .= ' and oy.createTime>=:startTime';
            $bindParam['startTime'] = $startTime;
        }
        if ($endTime) {
            $sql .= ' and oy.createTime<=:endTime';
            $bindParam['endTime'] = $endTime;
        }
        if($departmentId){
            $sql .= ' and oy.departmentId=:departmentId';
            $bindParam['departmentId'] = $departmentId;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($bindParam);
        $goods = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //查询所有部门
        if($departmentId>0){
            $deps = $db->select('vich_departments', 'departmentId,departmentName', array('departmentId'=>$departmentId));
            $depsall = $db->select('vich_departments', 'departmentId,departmentName', array('flag' => 1));
        }else{
            $deps = $db->select('vich_departments', 'departmentId,departmentName', array('flag' => 1));
        }

        $list = array();
        if($depsall){
            foreach ($depsall as $d){
                $list['deps'][ $d['departmentId']]=$d['departmentName'];
            }
        }else if($deps){
            foreach ($deps as $d){
                $list['deps'][ $d['departmentId']]=$d['departmentName'];
            }
        }
        if (!$deps) {
            return array();
        }
        if (!$goods && !$depsall) {
            return array();
        }else if(!$goods && $depsall){
            return $list;
        }

        $list['total'] = 0;
        $departments = array();
        foreach ($goods as $g) {
            if (!isset($list[$g['goodsCateId']])) {
                $list[$g['goodsCateId']]['cateId'] = $g['cateId'];
                $list[$g['goodsCateId']]['cateName'] = $g['cateName'];
                $list[$g['goodsCateId']]['moneys'] = array();
                $list[$g['goodsCateId']]['subTotal'] = 0;
            }

            foreach ($deps as $d) {
                if (!isset($departments[$d['departmentId']])) {
                    $departments[$d['departmentId']]['departmentId'] = $d['departmentId'];
                    $departments[$d['departmentId']]['departmentName'] = $d['departmentName'];
                    $departments[$d['departmentId']]['subTotal'] = 0;
                }

                if (!isset($list[$g['goodsCateId']]['moneys'][$d['departmentId']])) {
                    $list[$g['goodsCateId']]['moneys'][$d['departmentId']]['departmentId'] = $d['departmentId'];
                    $list[$g['goodsCateId']]['moneys'][$d['departmentId']]['departmentName'] = $d['departmentName'];
                    $list[$g['goodsCateId']]['moneys'][$d['departmentId']]['money'] = 0;
                }

                $sql = "select sum(goodsPrice*goodsCnt) as `money` from vich_orders_oy_goods 
                        where goodsId={$g['goodsId']} and departmentId={$d['departmentId']} and flag=1";

                $bindParam = array();
                if ($companyId) {
                    $sql .= ' and createCompany=:companyId';
                    $bindParam['companyId'] = $companyId;
                }
                if ($startTime) {
                    $sql .= ' and createTime>=:startTime';
                    $bindParam['startTime'] = $startTime;
                }
                if ($endTime) {
                    $sql .= ' and createTime<=:endTime';
                    $bindParam['endTime'] = $endTime;
                }

                $stmt = $db->prepare($sql);
                $stmt->execute($bindParam);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $list[$g['goodsCateId']]['moneys'][$d['departmentId']]['money'] += ($result && $result['money']) ? $result['money'] : 0;
                $list[$g['goodsCateId']]['subTotal'] += ($result && $result['money']) ? $result['money'] : 0;
                $departments[$d['departmentId']]['subTotal'] += ($result && $result['money']) ? $result['money'] : 0;
                $list['total'] += ($result && $result['money']) ? $result['money'] : 0;
            }
        }

        $list['departments'] = $departments;

        return $list;
    }
    //领用汇总表
    public static function usingReportTotal($companyId, $startTime, $endTime)
    {
        $db = self::__instance();
        $sql = "select og.goodsPrice,og.goodsCnt,g.goodsId,g.goodsCateId1,gc.cateName,de.departmentId,de.departmentName 
                from vich_orders_oy_goods og
                left join vich_goods g on g.goodsId=og.goodsId
                left join vich_goods_cates gc on gc.cateId=g.goodsCateId1
                left join vich_departments de on de.departmentId=og.departmentId
                where og.flag=1";

        $bindParam = array();
        if ($companyId) {
            $sql .= ' and og.createCompany=:companyId';
            $bindParam['companyId'] = $companyId;
        }
        if(!$startTime){
            $time=date('Y-01-01');
            $sql .=" and oy.createTime>='$time'";
        }
        if ($startTime) {
            $sql .= ' and og.createTime>=:startTime';
            $bindParam['startTime'] = $startTime;
        }
        if ($endTime) {
            $sql .= ' and og.createTime<=:endTime';
            $bindParam['endTime'] = $endTime;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($bindParam);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($row) {
            $sql = 'select cateId,cateName from vich_goods_cates where flag=1 and parentId=0 order by cateSort';
            $cates = array();
            foreach ($db->query($sql) as $item) {
                $cates[$item['cateId']] = array(
                    'cateId'   => $item['cateId'],
                    'cateName' => $item['cateName'],
                    'money'    => 0,
                );
            }
            if (!$cates) {
                return array();
            }

            $arr = array();
            $temp = $cates;
            $sql = 'select departmentId,departmentName from vich_departments where flag=1';

            foreach ($db->query($sql) as $dep) {
                $arr[$dep['departmentId']] = array(
                    'departmentId'   => $dep['departmentId'],
                    'departmentName' => $dep['departmentName'],
                    'goods'          => $temp,
                );

                foreach ($row as $v) {
                    if ($v['departmentId'] == $dep['departmentId'] && isset($arr[$dep['departmentId']]['goods'][$v['goodsCateId1']])) {
                        $cates[$v['goodsCateId1']]['money'] += $v['goodsPrice'] * $v['goodsCnt'];
                        $arr[$dep['departmentId']]['goods'][$v['goodsCateId1']]['money'] += $v['goodsPrice'] * $v['goodsCnt'];
                    }
                }
            }

            if ($arr) {
                return array('total' => $cates, 'list' => $arr);
            }
        }
        return array();
    }

    public static function busReport($cateId, $companyId, $depotId, $date)
    {
        $db = self::__instance();

        $starttime = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-01 00:00:00';
        $endtime = date('Y-m-d', strtotime('+1 month -1 days', strtotime(substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-01 0:0:0'))) . ' 23:59:59';

        $thisMonth = date('Y-m-d', time());
        if (strtotime($thisMonth) >= strtotime($endtime)) {
            //当前时间大于查询月月末 即查询的非本月
            $time_where = " AND og.createTime>'{$endtime}' AND og.createTime<='{$thisMonth}'";
        } else { //查询的是本月
            $thisMonth = date('Y-m-01', time());
            $time_where = " AND og.createTime>='" . $thisMonth . "' ";
        }
        $cate_where = '';
        $com_where = '';
        $ids_where = '';
        $buy = array();
        $out = array();
        $in = array();
        $using = array();
        $idin = array();
        $odout = array();
        $deport = array();
        $localin = array();
        $localidin = array();
        $localout = array();
        $localodout = array();
        $ids = array();
        if ($cateId){
            $sql="SELECT parentId FROM vich_goods_cates WHERE cateId=".$cateId;
            $parentId=$db->query($sql)->fetch();
            if ($parentId['parentId']==0){
                $cate_where = ' AND g.goodsCateId1=' . $cateId;
            }else{
                $cate_where = ' AND g.goodsCateId2=' . $cateId;
            }
        }
        if ($companyId) {
            $com_where = ' AND og.createCompany=' . $companyId;
        }
        if ($depotId) {
            $depot_where = ' AND og.depotId=' . $depotId;
        }
        if (strtotime($thisMonth) >= strtotime($endtime)) {
            //非当月
            //查询月月初到月末的所有入库
            $time_where_area = " AND og.createTime>='{$starttime}' AND og.createTime<='{$endtime}'";
            if (!empty($depotId)) {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_ip_goods og 
                LEFT JOIN vich_orders_ip ip ON og.orderId = ip.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND ip.flag = 3 {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_iq_goods og 
                LEFT JOIN vich_orders_iq iq ON og.orderId = iq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND iq.flag = 3 {$time_where_area} {$cate_where} {$com_where} {$depot_where}";
            } else {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_ip_goods og 
                LEFT JOIN vich_orders_ip ip ON og.orderId = ip.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND ip.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_id_goods og 
                LEFT JOIN vich_orders_id id ON og.orderId = id.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND id.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_iq_goods og 
                LEFT JOIN vich_orders_iq iq ON og.orderId = iq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND iq.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}";
            }
            foreach ($db->query($sql) as $i) {
                if (!isset($localin[$i['goodsId']])) {
                    $localin[$i['goodsId']]['count'] = 0;
                    $localin[$i['goodsId']]['money'] = 0;
                }

                $localin[$i['goodsId']]['money'] += $i['goodsPrice'] * $i['goodsCnt'];
                $localin[$i['goodsId']]['count'] += $i['goodsCnt'];
                $ids[] = $i['goodsId'];
            }
//return $localin;
            //查询月月初到月末的调拨入库
            if (!empty($depotId)) {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_id_goods og 
                LEFT JOIN vich_orders_id id ON og.orderId = id.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND id.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}";
                foreach ($db->query($sql) as $i) {
                    if (!isset($localidin[$i['goodsId']])) {
                        $localidin[$i['goodsId']]['count'] = 0;
                        $localidin[$i['goodsId']]['money'] = 0;
                    }
                    $localidin[$i['goodsId']]['money'] += $i['goodsPrice'] * $i['goodsCnt'];
                    $localidin[$i['goodsId']]['count'] += $i['goodsCnt'];
                    $ids[] = $i['goodsId'];
                }
            }

            //查询月月初到月末的出库//
            if (!empty($depotId)) {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oq_goods og 
                LEFT JOIN vich_orders_oq oq ON og.orderId = oq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oq.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oy_goods og 
                LEFT JOIN vich_orders_oy oy ON og.orderId = oy.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oy.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_so_goods og 
                LEFT JOIN vich_orders_so so ON og.orderId = so.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND so.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}";
            } else {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_od_goods og 
                LEFT JOIN vich_orders_od od ON og.orderId = od.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND od.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}  
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oq_goods og 
                LEFT JOIN vich_orders_oq oq ON og.orderId = oq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oq.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oy_goods og 
                LEFT JOIN vich_orders_oy oy ON og.orderId = oy.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oy.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_so_goods og 
                LEFT JOIN vich_orders_so so ON og.orderId = so.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND so.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}";
            }

            foreach ($db->query($sql) as $ot) {
                if (!isset($localout[$ot['goodsId']])) {
                    $localout[$ot['goodsId']]['count'] = 0;
                    $localout[$ot['goodsId']]['money'] = 0;
                }
                $localout[$ot['goodsId']]['money'] += $ot['goodsPrice'] * $ot['goodsCnt'];
                $localout[$ot['goodsId']]['count'] += $ot['goodsCnt'];
                $ids[] = $ot['goodsId'];
            }

            //查询月月初到月末的调拨出库
            if (!empty($depotId)) {
                $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_od_goods og 
                LEFT JOIN vich_orders_od od ON og.orderId = od.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND od.flag = 3  {$time_where_area} {$cate_where} {$com_where} {$depot_where}  ";
                foreach ($db->query($sql) as $ot) {
                    if (!isset($odout[$ot['goodsId']])) {
                        $localodout[$ot['goodsId']]['count'] = 0;
                        $localodout[$ot['goodsId']]['money'] = 0;
                    }
                    $localodout[$ot['goodsId']]['money'] += $ot['goodsPrice'] * $ot['goodsCnt'];
                    $localodout[$ot['goodsId']]['count'] += $ot['goodsCnt'];
                    $ids[] = $ot['goodsId'];
                }
            }
        }
        //查询月月末到现在的所有入库
        if (!empty($depotId)) {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_ip_goods og 
                LEFT JOIN vich_orders_ip ip ON og.orderId = ip.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND ip.flag = 3 {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_iq_goods og 
                LEFT JOIN vich_orders_iq iq ON og.orderId = iq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND iq.flag = 3 {$time_where} {$cate_where} {$com_where} {$depot_where}";
        } else {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_ip_goods og 
                LEFT JOIN vich_orders_ip ip ON og.orderId = ip.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND ip.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_id_goods og 
                LEFT JOIN vich_orders_id id ON og.orderId = id.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND id.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_iq_goods og 
                LEFT JOIN vich_orders_iq iq ON og.orderId = iq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND iq.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}";
        }
        foreach ($db->query($sql) as $i) {
            if (!isset($in[$i['goodsId']])) {
                $in[$i['goodsId']]['count'] = 0;
                $in[$i['goodsId']]['money'] = 0;
            }
            $in[$i['goodsId']]['money'] += $i['goodsPrice'] * $i['goodsCnt'];
            $in[$i['goodsId']]['count'] += $i['goodsCnt'];
            $ids[] = $i['goodsId'];
        }

        //调拨入库
        if (!empty($depotId)) {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_id_goods og 
                LEFT JOIN vich_orders_id id ON og.orderId = id.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND id.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}";
            foreach ($db->query($sql) as $i) {
                if (!isset($in[$i['goodsId']])) {
                    $idin[$i['goodsId']]['count'] = 0;
                    $idin[$i['goodsId']]['money'] = 0;
                }
                $idin[$i['goodsId']]['money'] += $i['goodsPrice'] * $i['goodsCnt'];
                $idin[$i['goodsId']]['count'] += $i['goodsCnt'];
                $ids[] = $i['goodsId'];
            }
        }

        //查询本月出库//
        if (!empty($depotId)) {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oq_goods og 
                LEFT JOIN vich_orders_oq oq ON og.orderId = oq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oq.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oy_goods og 
                LEFT JOIN vich_orders_oy oy ON og.orderId = oy.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oy.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_so_goods og 
                LEFT JOIN vich_orders_so so ON og.orderId = so.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND so.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}";
        } else {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_od_goods og 
                LEFT JOIN vich_orders_od od ON og.orderId = od.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND od.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}  
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oq_goods og 
                LEFT JOIN vich_orders_oq oq ON og.orderId = oq.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oq.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oy_goods og 
                LEFT JOIN vich_orders_oy oy ON og.orderId = oy.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND oy.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}
                UNION ALL
                SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_so_goods og 
                LEFT JOIN vich_orders_so so ON og.orderId = so.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND so.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}";
        }

        foreach ($db->query($sql) as $ot) {
            if (!isset($out[$ot['goodsId']])) {
                $out[$ot['goodsId']]['count'] = 0;
                $out[$ot['goodsId']]['money'] = 0;
            }
            $out[$ot['goodsId']]['money'] += $ot['goodsPrice'] * $ot['goodsCnt'];
            $out[$ot['goodsId']]['count'] += $ot['goodsCnt'];
            $ids[] = $ot['goodsId'];
        }

        //调拨出库
        if (!empty($depotId)) {
            $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_od_goods og 
                LEFT JOIN vich_orders_od od ON og.orderId = od.orderId
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND od.flag = 3  {$time_where} {$cate_where} {$com_where} {$depot_where}  ";
            foreach ($db->query($sql) as $ot) {
                if (!isset($odout[$ot['goodsId']])) {
                    $odout[$ot['goodsId']]['count'] = 0;
                    $odout[$ot['goodsId']]['money'] = 0;
                }
                $odout[$ot['goodsId']]['money'] += $ot['goodsPrice'] * $ot['goodsCnt'];
                $odout[$ot['goodsId']]['count'] += $ot['goodsCnt'];
                $ids[] = $ot['goodsId'];
            }
        }
        $sql1 = "SELECT og.goodsId FROM `vich_depot_goods` og
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 {$com_where} {$depot_where} {$cate_where}
                GROUP BY goodsId HAVING SUM(goodsCnt)>0";
        foreach ($db->query($sql1) as $ii) {
            $ids[] = $ii['goodsId'];
        }
        $ids = array_unique($ids);
        if (!empty($ids)) {
            $ids = implode(',', $ids);
            $ids_where = 'AND og.goodsId in(' . $ids . ')';
        }
        //当前库存量
        $sql = "SELECT og.goodsId,og.goodsPrice,og.goodsCnt,g.goodsName,goodsSn,gn.unitName
                FROM vich_depot_goods og
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                LEFT JOIN vich_goods_units gn on gn.unitId=g.goodsUnitId
                WHERE (og.flag=1 {$cate_where} {$com_where} {$depot_where} and og.goodsCnt>0) {$ids_where} ORDER BY og.createTime DESC";
        foreach ($db->query($sql) as $d) {
            if (!isset($deport[$d['goodsId']])) {
                $deport[$d['goodsId']]['goodsId'] = $d['goodsId'];
                $deport[$d['goodsId']]['goodsName'] = $d['goodsName'];
                $deport[$d['goodsId']]['unitName'] = $d['unitName'];
                $deport[$d['goodsId']]['goodsSn'] = $d['goodsSn'];
                $deport[$d['goodsId']]['count'] = 0;
                $deport[$d['goodsId']]['money'] = 0;
            }
            $deport[$d['goodsId']]['money'] += $d['goodsPrice'] * $d['goodsCnt'];
            $deport[$d['goodsId']]['count'] += $d['goodsCnt'];
        }
        $list = array();
        $total = array(
            'last' => array('count' => 0, 'money' => 0),
            'buy' => array('count' => 0, 'money' => 0),
            'using' => array('count' => 0, 'money' => 0),
            'transin' => array('count' => 0, 'money' => 0),
            'transout' => array('count' => 0, 'money' => 0),
            'depot' => array('count' => 0, 'money' => 0),
        );
        if (strtotime($thisMonth) >= strtotime($endtime)) { //非当月
            if (!empty($depotId)) {
                if ($deport) {
                    foreach ($deport as $g) {
                        $list[$g['goodsId']] = array(
                            'goodsName' => $g['goodsName'],
                            'goodsSn' => $g['goodsSn'],
                            'unitName' => $g['unitName'],     //计量单位
                            'last' => array(                  //查询月上月结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count']
                                    + $localout[$g['goodsId']]['count'] - $localin[$g['goodsId']]['count'] + $localodout[$g['goodsId']]['count'] - $localidin[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money']
                                    + $localout[$g['goodsId']]['money'] - $localin[$g['goodsId']]['money'] + $localodout[$g['goodsId']]['count'] - $localidin[$g['goodsId']]['money'],
                            ),
                            'buy' => array(                  //查询月入库
                                'count' => $localin[$g['goodsId']]['count'],
                                'money' => $localin[$g['goodsId']]['money'],
                            ),
                            'using' => array(                  //查询月出库
                                'count' => $localout[$g['goodsId']]['count'],
                                'money' => $localout[$g['goodsId']]['money'],
                            ),
                            'transin' => array(                  //查询月调拨入库
                                'count' => $localidin[$g['goodsId']]['count'],
                                'money' => $localidin[$g['goodsId']]['money'],
                            ),
                            'transout' => array(                  //查询月调拨出库
                                'count' => $localodout[$g['goodsId']]['count'],
                                'money' => $localodout[$g['goodsId']]['money'],
                            ),
                            'depot' => array(                  //查询月月末结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money'],
                            ),
                        );
                        $total['last']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count']
                            + $localout[$g['goodsId']]['count'] - $localin[$g['goodsId']]['count'] + $localodout[$g['goodsId']]['count'] - $localidin[$g['goodsId']]['count'];
                        $total['last']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money']
                            + $localout[$g['goodsId']]['money'] - $localin[$g['goodsId']]['money'] + $localodout[$g['goodsId']]['count'] - $localidin[$g['goodsId']]['money'];
                        $total['buy']['count'] += $localin[$g['goodsId']]['count'];
                        $total['buy']['money'] += $localin[$g['goodsId']]['money'];
                        $total['using']['count'] += $localout[$g['goodsId']]['count'];
                        $total['using']['money'] += $localout[$g['goodsId']]['money'];
                        $total['transin']['count'] += $localidin[$g['goodsId']]['count'];
                        $total['transin']['money'] += $localidin[$g['goodsId']]['money'];
                        $total['transout']['count'] += $localodout[$g['goodsId']]['count'];
                        $total['transout']['money'] += $localodout[$g['goodsId']]['money'];
                        $total['depot']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count'];
                        $total['depot']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money'];
                    }
                }
            } else {
                if ($deport) {
                    foreach ($deport as $g) {
                        $list[$g['goodsId']] = array(
                            'goodsName' => $g['goodsName'],
                            'goodsSn' => $g['goodsSn'],
                            'unitName' => $g['unitName'],     //计量单位
                            'last' => array(                  //上月结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $localout[$g['goodsId']]['count'] - $localin[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $localout[$g['goodsId']]['money'] - $localin[$g['goodsId']]['money'],
                            ),
                            'buy' => array(                  //本月入库
                                'count' => $localin[$g['goodsId']]['count'],
                                'money' => $localin[$g['goodsId']]['money'],
                            ),
                            'using' => array(                  //本月出库
                                'count' => $localout[$g['goodsId']]['count'],
                                'money' => $localout[$g['goodsId']]['money'],
                            ),
                            'transin' => array(                  //本月调拨入库
                                'count' => $localidin[$g['goodsId']]['count'],
                                'money' => $localidin[$g['goodsId']]['money'],
                            ),
                            'transout' => array(                  //本月调拨出库
                                'count' => $localodout[$g['goodsId']]['count'],
                                'money' => $localodout[$g['goodsId']]['money'],
                            ),
                            'depot' => array(                  //本月结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'],
                            ),
                        );
                        $total['last']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $localout[$g['goodsId']]['count'] - $localin[$g['goodsId']]['count'];
                        $total['last']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $localout[$g['goodsId']]['money'] - $localin[$g['goodsId']]['money'];
                        $total['buy']['count'] += $localin[$g['goodsId']]['count'];
                        $total['buy']['money'] += $localin[$g['goodsId']]['money'];
                        $total['using']['count'] += $localout[$g['goodsId']]['count'];
                        $total['using']['money'] += $localout[$g['goodsId']]['money'];
                        $total['depot']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'];
                        $total['depot']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'];
                    }
                }
            }

        } else { //当月
            if (!empty($depotId)) {
                if ($deport) {
                    foreach ($deport as $g) {
                        $list[$g['goodsId']] = array(
                            'goodsName' => $g['goodsName'],
                            'goodsSn' => $g['goodsSn'],
                            'unitName' => $g['unitName'],     //计量单位
                            'last' => array(                  //上月结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money'],
                            ),
                            'buy' => array(                  //本月入库
                                'count' => $in[$g['goodsId']]['count'],
                                'money' => $in[$g['goodsId']]['money'],
                            ),
                            'using' => array(                  //本月出库
                                'count' => $out[$g['goodsId']]['count'],
                                'money' => $out[$g['goodsId']]['money'],
                            ),
                            'transin' => array(                  //本月调拨入库
                                'count' => $idin[$g['goodsId']]['count'],
                                'money' => $idin[$g['goodsId']]['money'],
                            ),
                            'transout' => array(                  //本月调拨出库
                                'count' => $odout[$g['goodsId']]['count'],
                                'money' => $odout[$g['goodsId']]['money'],
                            ),
                            'depot' => array(                  //本月结存
                                'count' => $deport[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'],
                            ),
                        );
                        $total['last']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['count'];
                        $total['last']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'] + $odout[$g['goodsId']]['count'] - $idin[$g['goodsId']]['money'];
                        $total['buy']['count'] += $in[$g['goodsId']]['count'];
                        $total['buy']['money'] += $in[$g['goodsId']]['money'];
                        $total['using']['count'] += $out[$g['goodsId']]['count'];
                        $total['using']['money'] += $out[$g['goodsId']]['money'];
                        $total['transin']['count'] += $idin[$g['goodsId']]['count'];
                        $total['transin']['money'] += $idin[$g['goodsId']]['money'];
                        $total['transout']['count'] += $odout[$g['goodsId']]['count'];
                        $total['transout']['money'] += $odout[$g['goodsId']]['money'];
                        $total['depot']['count'] += $deport[$g['goodsId']]['count'];
                        $total['depot']['money'] += $deport[$g['goodsId']]['money'];
                    }
                }
            } else {
                if ($deport) {
                    foreach ($deport as $g) {
                        $list[$g['goodsId']] = array(
                            'goodsName' => $g['goodsName'],
                            'goodsSn' => $g['goodsSn'],
                            'unitName' => $g['unitName'],     //计量单位
                            'last' => array(                  //上月结存
                                'count' => $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'],
                            ),
                            'buy' => array(                  //本月入库
                                'count' => $in[$g['goodsId']]['count'],
                                'money' => $in[$g['goodsId']]['money'],
                            ),
                            'using' => array(                  //本月出库
                                'count' => $out[$g['goodsId']]['count'],
                                'money' => $out[$g['goodsId']]['money'],
                            ),
                            'transin' => array(                  //本月调拨入库
                                'count' => $idin[$g['goodsId']]['count'],
                                'money' => $idin[$g['goodsId']]['money'],
                            ),
                            'transout' => array(                  //本月调拨出库
                                'count' => $odout[$g['goodsId']]['count'],
                                'money' => $odout[$g['goodsId']]['money'],
                            ),
                            'depot' => array(                  //本月结存
                                'count' => $deport[$g['goodsId']]['count'],
                                'money' => $deport[$g['goodsId']]['money'],
                            ),
                        );
                        $total['last']['count'] += $deport[$g['goodsId']]['count'] + $out[$g['goodsId']]['count'] - $in[$g['goodsId']]['count'];
                        $total['last']['money'] += $deport[$g['goodsId']]['money'] + $out[$g['goodsId']]['money'] - $in[$g['goodsId']]['money'];
                        $total['buy']['count'] += $in[$g['goodsId']]['count'];
                        $total['buy']['money'] += $in[$g['goodsId']]['money'];
                        $total['using']['count'] += $out[$g['goodsId']]['count'];
                        $total['using']['money'] += $out[$g['goodsId']]['money'];
                        $total['depot']['count'] += $deport[$g['goodsId']]['count'];
                        $total['depot']['money'] += $deport[$g['goodsId']]['money'];
                    }
                }
            }
        }

        $kpri = array();
        $lionids = array();
        $lionpri = 0;
        $inlionids = '';
//        $sql = "SELECT  ip.orderId
//                FROM vich_orders_ip_goods og
//                LEFT JOIN vich_orders_ip ip ON og.orderId = ip.orderId
//                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
//                WHERE og.flag=1 AND ip.flag = 3 AND og.createTime>='{$thisMonth}' {$cate_where} {$com_where} {$depot_where} ORDER BY ip.orderId ";
//        foreach ($db->query($sql) as $v) {
//            if ($orderids == '') {
//                $orderids = $v['orderId'];
//            } else {
//                $orderids .= ',' . $v['orderId'];
//            }
//        }
//        if (empty($orderids)) {
//            return array('list' => '', 'total' => 0);
//        }
        if (strtotime($thisMonth) >= strtotime($endtime)) {
            //非当月
            //查询月月初到月末的所有入库
            $time_whereadj_area = " AND createTime>='{$starttime}' AND createTime<='{$endtime}'";
        } else {
            $thisMonth = date('Y-m-01', time());
            $time_whereadj_area = " AND createTime>='" . $thisMonth . "' ";
        }
        $sql = "SELECT ids,adjustpri FROM vich_invoices_adjust WHERE flag=1 {$time_whereadj_area} ";
        foreach ($db->query($sql) as $v) {
            $lionpri = $lionpri + floatval($v['adjustpri']);
            $aa[] = $v['adjustpri'];
            if ($v['ids']) {
                if ($inlionids == '') {
                    $inlionids = $v['ids'];
                } else {
                    $inlionids .= ',' . $v['ids'];
                }
            }
        }
        if ($inlionids) {
            $idin_where = ' AND i.invoiceId NOT IN ($inlionids) ';
        }
        $sql = "SELECT i.invoiceId,i.adjustamount FROM vich_invoices i WHERE
                 i.flag=1 AND i.type='1' AND i.adjustamount!='' {$time_whereadj_area} {$idin_where} GROUP BY i.orderId   ORDER BY i.invoiceId ";
        if($db->query($sql)){
            foreach ($db->query($sql) as $v) {
                $aa[] = $v['adjustamount'];
                if ($v['adjustamount']) {
                    $lionpri = $lionpri + floatval($v['adjustamount']);
                }
            }
        }
        return array('list' => $list, 'total' => $total, 'adjpri' => $lionpri);
    }


    public static function busTotalReport($companyId)
    {
        $db = self::__instance();

        $thisMonth = date('Y-m-d');

        $com_where = '';
        $buy = array();
        $out = array();
        $in = array();
        $using = array();
        $deport = array();

        if ($companyId) {
            $com_where = ' AND og.createCompany=' . $companyId;
        }
        //查询本月入库
        $sql = "SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_ip_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}
                UNION ALL
                SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_id_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}'  {$com_where}
                UNION ALL
                SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_iq_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}";


        foreach ($db->query($sql) as $i) {
            if (!isset($in[$i['goodsCateId1']])) {
                $in[$i['goodsCateId1']]['money'] = 0;
            }
            $in[$i['goodsCateId1']]['money'] += $i['goodsPrice'] * $i['goodsCnt'];
        }

        //查询本月出库
        $sql = "SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_od_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}
                UNION ALL
                SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oq_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}
                UNION ALL
                SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_oy_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}
                UNION ALL
                SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt 
                FROM vich_orders_so_goods og 
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=3 AND og.createTime>='{$thisMonth}' {$com_where}";
        foreach ($db->query($sql) as $ot) {
            if (!isset($out[$ot['goodsCateId1']])) {
                $out[$ot['goodsCateId1']]['money'] = 0;
            }
            $out[$ot['goodsCateId1']]['money'] += $ot['goodsPrice'] * $ot['goodsCnt'];
        }

        //当前库存量
        $sql = "SELECT g.goodsCateId1,og.goodsPrice,og.goodsCnt
                FROM vich_depot_goods og
                LEFT JOIN vich_goods g on g.goodsId=og.goodsId
                WHERE og.flag=1 AND og.createTime>='{$thisMonth}' {$com_where}";
        foreach ($db->query($sql) as $d) {
            if (!isset($deport[$d['goodsCateId1']])) {
                $deport[$d['goodsCateId1']]['goodsCateId1'] = $d['goodsCateId1'];
                $deport[$d['goodsCateId1']]['money'] = 0;
                $cate = self::getCateById($d['goodsCateId1']);

                $deport[$d['goodsCateId1']]['cateName'] = $cate?$cate['cateName']:'';
            }
            $deport[$d['goodsCateId1']]['money'] += $d['goodsPrice'] * $d['goodsCnt'];
        }
        $list = array();
        $total = array(
            'last'  => array('money' => 0),
            'buy'   => array('money' => 0),
            'using' => array('money' => 0),
            'depot' => array('money' => 0),
        );
        if ($deport) {
            foreach ($deport as $g) {
                $list[$g['goodsCateId1']] = array(
                    'cateName' => $deport[$g['goodsCateId1']]['cateName'],
                    'last'      => array(
                        'money' => $deport[$g['goodsCateId1']]['money'] + $out[$g['goodsCateId1']]['money'] - $in[$g['goodsCateId1']]['money'],
                    ),
                    'buy'       => array(                  //本月购入
                        'money' => $in[$g['goodsCateId1']]['money'],
                    ),
                    'using'     => array(                  //本月领用
                        'money' => $out[$g['goodsCateId1']]['money'],
                    ),
                    'depot'     => array(                  //本月结存
                        'money' => $deport[$g['goodsCateId1']]['money'],
                    ),
                );
                $total['last']['money'] += $deport[$g['goodsCateId1']]['money'] + $out[$g['goodsCateId1']]['money'] - $in[$g['goodsCateId1']]['money'];
                $total['buy']['money'] += $buy[$g['goodsCateId1']]['money'];
                $total['using']['money'] += $using[$g['goodsCateId1']]['money'];
                $total['depot']['money'] += $deport[$g['goodsCateId1']]['money'];
            }
        }

        return array('list'=>$list,'total'=>$total);
    }

    public static function getCateById($cateId){
        $db = self::__instance();
        $row = $db->select('vich_goods_cates','cateName',array('cateId'=>$cateId));
        if($row){
            return $row[0];
        }
        return array();
    }


}