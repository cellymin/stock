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
	public static function add($input_data){
		$db = self::__instance();
		$arr = array();
		$goodsSn = $input_data['goodsSn'];
		$count = $db->count('vich_goods', array('goodsSn'=>$goodsSn));
		if($count>0){
			$arr['goodsId'] = '';
			$arr['msg'] = '产品货号重复';
			return $arr;
		}
		
		$goodsBarCode = $input_data['goodsBarCode'];
		$count = $db->count('vich_goods', array('goodsBarCode'=>$goodsBarCode));
		if($count>0){
			$arr['goodsId'] = '';
			$arr['msg'] = '产品条码重复';
			return $arr;
		}
		
		$goodsId = $db->insert('vich_goods', $input_data);
		
		$arr['goodsId'] = $goodsId;
		$arr['msg'] = '添加成功';
		return $arr;
	}
	
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
    
    //打印
    public static function prints($goodsId){
    	$db = self::__instance();
    	$goodsId = rtrim($goodsId,',');
		$sql = "select goodsId,goodsSn,goodsBarCode,goodsName,goodsSpec from vich_goods where goodsId in($goodsId) order by goodsSn desc";
		$list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		if($list){
			return $list;
		}
		return array();
    }
}