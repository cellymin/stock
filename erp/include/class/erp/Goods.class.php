<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

/**
 * 产品类
 * Class Goods
 */
class Goods extends Base
{
    //产品供应商价格
    public static function suppliersGoodsTop($goodsId, $year = "")
    {
        if (empty($goodsId)) {
            return array();
        }
        $db = self::__instance();

        if (empty($year)) {
            $year = date("Y", time());
        }

        $first = $year . "-01-01 00:00:00";
        $end = $year . "-12-31 23:59:59";

        $sql = 'select og.supplierId,s.supplierName,s.supplierTel,og.goodsCnt,og.goodsPrice,og.createTime
                from vich_orders_ip_goods og 
                left join vich_orders_ip o on o.orderId=og.orderId
                left join vich_suppliers s on s.supplierId=og.supplierId
                where o.flag=3 and og.goodsId=:goodsId and og.createTime>=:first and og.createTime<=:end order by og.createTime asc';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':goodsId', $goodsId);
        $stmt->bindParam(':first', $first);
        $stmt->bindParam(':end', $end);
        $stmt->execute();

        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($list) {
            return $list;
        }

        return array();
    }

    //首页图表
    public static function indexChart()
    {
        $db = self::__instance();

        $sql = "select sum(totalMoney) as money,sum(totalCnt) as cnt,MONTH(createTime) as mth
                from vich_orders_ip
                where createCompany=" . $_SESSION[UserSession::SESSION_NAME]['companyId'] . " and createTime>='" . date('Y-01-01 00:00:00') . "' group by mth";

        $list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if($list){
            return $list;
        }
        return array();
    }

    //查询商品信息
    public static function getGoodsInfo($goodsId){
        if(empty($goodsId)){
            return false;
        }

        $db = self::__instance();
        $sql = "select g.*,gc.cateNo,gc.cateName 
                from vich_goods g 
                left join vich_goods_cates gc on gc.cateId=g.goodsCateId
                where g.flag=1 and g.goodsId=:goodsId";
        $stmt = $db->prepare($sql);
        $stmt->execute(array('goodsId'=>$goodsId));

        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rs){
            return $rs;
        }
        return array();
    }

    //导入
    static function loadData(){
        try{
            //读取excel
            $inputFileType = PHPExcel_IOFactory::identify($_FILES['excel']['tmp_name']);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($_FILES['excel']['tmp_name']);
        }catch (Exception $e){
            return '加载文件发生错误';
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();  // 取得总行数
        $highestColumn = $sheet->getHighestColumn();  // 取得总列数

        $cat1No = array();  //一级分类编号
        $cat2No = array(); //二级分类编号
        $cat3No = array(); //三级分类编号
        $unitNo = array(); //四级分类编号
        $ready = array();


        for ($row = 1; $row <= $highestRow; $row++){
            //一次取一行
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            //这里得到的rowData都是一行的数据
            $data = $rowData[0];
//            var_dump($data);
            if($row>1){
                //查询一级分类ID
//              if(empty($data[4]) || empty($data[5]) || empty($data[6])){
//                  return '第'.$row.'行缺少分类编号';
//                  break;
//              }
//              if(empty($data[7])){
//                  return '第'.$row.'行缺少单位编号';
//                  break;
//              }
                $ready[] = $data;
            }
        }

        //所属公司
        $createCompany = $_SESSION[UserSession::SESSION_NAME]['companyId'];
        $createUser = $_SESSION[UserSession::SESSION_NAME]['user_id'];
        $createTime = date('Y-m-d H:i:s');

        $db = self::__instance();


        $db->beginTransaction();

        foreach ($ready as $v){
            if(!isset($cat1No[$v[4]])){
                $sql = "select cateId from vich_goods_cates where cateNo = '{$v[4]}'";
                $row = $db->query($sql)->fetch();
//              if(!$row){
//                  $db->rollback();
//                  return '一级分类编号'.$v[4].'不存在';
//                  break;
//              }
                $cat1No[$v[4]] = $row?$row['catId']:0;
            }
            if(!isset($cat2No[$v[5]])){
                $sql = "select cateId from vich_goods_cates where cateNo = '{$v[5]}'";
                $row = $db->query($sql)->fetch();
//              if(!$row){
//                  $db->rollback();
//                  return '二级分类编号'.$v[5].'不存在';
//                  break;
//              }
                $cat2No[$v[5]] = $row?$row['catId']:0;
            }
            if(!isset($cat3No[$v[6]])){
                $sql = "select cateId from vich_goods_cates where cateNo = '{$v[6]}'";
                $row = $db->query($sql)->fetch();
//              if(!$row){
//                  $db->rollback();
//                  return '三级分类编号'.$v[6].'不存在';
//                  break;
//              }
                $cat3No[$v[6]] = $row?$row['catId']:0;
            }
            if(!isset($unitNo[$v[7]])){
                $sql = "select unitId from vich_goods_units where unitNo= '{$v[7]}'";
                $row = $db->query($sql)->fetch();
//              if(!$row){
//                  $db->rollback();
//                  return '单位编号'.$v[7].'不存在';
//                  break;
//              }
                $unitNo[$v[7]] = $row?$row['unitId']:0;
            }

            $goodsBarCode = self::getBarCode();
            //插入数据
            $sql = "insert into vich_goods(goodsSn,goodsBarCode,goodsName,goodsSpec,goodsCateId1,goodsCateId2,goodsCateId,goodsUnitId,productionDate,flag,createCompany,createUser,createTime) values('{$v[0]}','{$goodsBarCode}','{$v[2]}','{$v[3]}','{$cat1No[$v[4]]}','{$cat2No[$v[5]]}','{$cat3No[$v[6]]}','{$unitNo[$v[7]]}','{$v['8']}',1,'{$createCompany}','{$createUser}','{$createTime}')";

            $db->exec($sql);
        }
        $db->commit();

        return true;
    }

    static function getBarCode(){
        $db = self::__instance();

        $sql = "select * from vich_codes where createUser={$_SESSION[UserSession::SESSION_NAME]['user_id']}";
        $row = $db->query($sql)->fetch();
        if(!$row){
            $sql = "insert into vich_codes(createUser) values({$_SESSION[UserSession::SESSION_NAME]['user_id']})";
            $db->exec($sql);
            return self::getBarCode();
        }

        $sql = "delete from vich_codes where createUser={$_SESSION[UserSession::SESSION_NAME]['user_id']}";
        $db->exec($sql);

        return $row['code'];
    }
}