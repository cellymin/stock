<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

class Chart extends Base{
	
	//采购明细汇总表
	public static function chart1Count($keyword, $companyId, $startTime, $endTime){
		$db = self::__instance();
		$sql = "select count(*) as count from vich_orders_ip as a 
				left join vich_orders_ip_goods as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = b.goodsId
				where a.flag=3 and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') ";
		if(!empty($companyId)) $sql.=" and a.createCompany='$companyId' ";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
		$row = $db->query($sql)->fetch();
		return $row['count'];
	}	
	public static function chart1($start, $page_size, $keyword, $companyId, $startTime, $endTime){
		$db=self::__instance();
		$limit ="";
		if($page_size){
			$limit =" limit $start, $page_size ";
		}
		$sql = "select a.orderId from vich_orders_ip as a 
				left join vich_orders_ip_goods as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = b.goodsId
				where a.flag=3 and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') ";
		if(!empty($companyId)) $sql.=" and a.createCompany='$companyId' ";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
		$sql.= " order by orderId desc".$limit;
		
		$row = $db->query($sql)->fetch();
		$orderId = 0;
		if($row){
			$orderId = $row['orderId'];
			$sql = "select
					c.orderNo, b.goodsSn, a.goodsId, a.goodsPrice, a.goodsCnt, b.goodsSpec, b.goodsName, c.reviewerTime
					from vich_orders_ip_goods as a
					left join vich_goods as b on b.goodsId = a.goodsId 
					left join vich_orders_ip as c on c.orderId = a.orderId
					where a.orderId='$orderId'";
			$list = $db->query($sql)->fetchAll();
			if($list){
				return $list;
			}
		}		
		return array();
	}
	
	
	//库存明细汇总
	public static function chart2Count($keyword, $depotId, $depotSubId, $companyId){
		$db = self::__instance();
		$sql = "select count(*) as count 
				from vich_depot_goods as a
				left join vich_goods as b on b.goodsId = a.goodsId
				where 1=1
				";
		if(!empty($keyword)) $sql.=" and (b.goodsSn like '%$keyword%' or b.goodsName like '%$keyword%') ";
		if(!empty($depotId)) $sql.=" and a.depotId='$depotId' ";
		if(!empty($depotSubId)) $sql.=" and a.depotSubId='$depotSubId' ";
		if(!empty($companyId)) $sql.=" and a.createCompany = '$companyId' ";
		$row = $db->query($sql)->fetch();
		return $row['count'];
	}
	
	public static function chart2($start, $page_size, $keyword, $depotId, $depotSubId, $companyId){
		$db=self::__instance();
		$limit ="";
		if($page_size){
			$limit =" limit $start, $page_size ";
		}
		
		$sql = "select a.goodsId, b.goodsSn, a.goodsCnt, b.goodsName, b.goodsSpec, c.depotName, d.depotSubName, e.companyName
				from vich_depot_goods as a
				left join vich_goods as b on b.goodsId = a.goodsId
				left join vich_depots as c on c.depotId = a.depotId
				left join vich_depot_subs as d on d.depotSubId = a.depotSubId
				left join vich_companys as e on e.companyId = a.createCompany
				where 1=1
				";
		if(!empty($keyword)) $sql.=" and (b.goodsSn like '%$keyword%' or goodsName like '%$keyword%') ";
		if(!empty($depotId)) $sql.=" and a.depotId='$depotId' ";
		if(!empty($depotSubId)) $sql.=" and a.depotSubId='$depotSubId' ";
		if(!empty($companyId)) $sql.=" and a.createCompany = '$companyId' ";
		$sql.=" order by a.goodsId desc ".$limit;

		$list = $db->query($sql)->fetchAll();
		if($list){
			return $list;
		}
		return array();
	}
	
	//调库查询
	public static function chart3Count($keyword, $depotId, $table, $startTime, $endTime){
		$db = self::__instance();
		$subTable = $table.'_goods';
		$sql = "select count(*) as count 
				from {$table} as a 
				left join {$subTable} as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = b.goodsId
				where a.flag=3 and a.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') ";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
		$row = $db->query($sql)->fetch();
		return $row['count'];
	}
	public static function chart3($start, $page_size, $keyword, $depotId, $table, $startTime, $endTime){
		$db=self::__instance();
		$subTable = $table.'_goods';
		$limit ="";
		if($page_size){
			$limit =" limit $start, $page_size ";
		}
		$sql = "select a.orderId 
				from {$table} as a 
				left join {$subTable} as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = b.goodsId
				where a.flag=3 and a.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') ";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
		
		$row = $db->query($sql)->fetch();
		$orderId = 0;
		if($row){
			$orderId = $row['orderId'];
			$sql = "select
					a.goodsId, a.goodsPrice, a.goodsCnt, b.goodsSpec, b.goodsName, c.reviewerTime, c.orderNo
					from $subTable as a
					left join vich_goods as b on b.goodsId = a.goodsId 
					left join {$table} as c on c.orderId = a.orderId
					where a.orderId='$orderId'";
			$list = $db->query($sql)->fetchAll();
			
			if($list){
				return $list;
			}
		}		
		return array();
	}
	
	//入库,出库明细
	public static function chart4Count($keyword, $depotId, $table, $startTime, $endTime){
		$db = self::__instance();
		$subTable = $table.'_goods';
		
		$sql = "select count(*) as count
				from {$subTable} as a
				left join {$table} as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = a.goodsId
				where a.depotId='$depotId' and b.flag=3 and b.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') 
				";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(b.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(b.reviewerTime,'%Y%m%d')<='$endTime' ";
		
		$row = $db->query($sql)->fetch();
		return $row['count'];
	}
	public static function chart4($start, $page_size, $keyword,  $depotId, $table, $startTime, $endTime){
		$db=self::__instance();
		$subTable = $table.'_goods';
		$limit ="";
		if($page_size){
			$limit =" limit $start, $page_size ";
		}
		$sql = "select a.goodsId, a.goodsCnt, c.goodsSpec, c.goodsName, c.goodsSn, b.reviewerTime, b.orderNo
				from {$subTable} as a
				left join {$table} as b on b.orderId = a.orderId
				left join vich_goods as c on c.goodsId = a.goodsId
				where a.depotId='$depotId' and b.flag=3 and b.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%') 
				";
		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(b.reviewerTime,'%Y%m%d')>='$startTime' ";
		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(b.reviewerTime,'%Y%m%d')<='$endTime' ";
		$sql.= " order by a.orderId desc".$limit;
		$list = $db->query($sql)->fetchAll();
			
		if($list){
			return $list;
		}	
		return array();
	}

	//出库明细
//	public static function chart5Count($keyword, $depotId, $table, $startTime, $endTime){
//		$db = self::__instance();
//		$subTable = $table.'_goods';
//		$sql = "select count(*) as count 
//				from {$table} as a 
//				left join $subTable as b on b.orderId=a.orderId 
//				left join vich_goods as c on c.goodsId = b.goodsId
//				where a.flag=3 and b.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%')
//				";
//		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
//		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
//		$row = $db->query($sql)->fetch();
//		return $row['count'];
//	}
//	public static function chart5($start, $page_size, $keyword, $depotId, $table, $startTime, $endTime){
//		$db=self::__instance();
//		$subTable = $table.'_goods';
//		$limit ="";
//		if($page_size){
//			$limit =" limit $start, $page_size ";
//		}
//		$sql = "select a.orderId 
//				from {$table} as a 
//				left join $subTable as b on b.orderId=a.orderId 
//				left join vich_goods as c on c.goodsId = b.goodsId
//				where a.flag=3 and b.depotId='$depotId' and (c.goodsSn like '%$keyword%' or c.goodsName like '%$keyword%')
//				";
//		if(!empty($startTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')>='$startTime' ";
//		if(!empty($endTime)) $sql.=" and FROM_UNIXTIME(a.reviewerTime,'%Y%m%d')<='$endTime' ";
//		$sql.= " order by a.orderId desc".$limit;
//		
//		$row = $db->query($sql)->fetch();
//		$orderId = 0;
//		if($row){
//			$orderId = $row['orderId'];
//			$sql = "select
//					a.goodsId, a.goodsPrice, a.goodsCnt, b.goodsSpec, b.goodsName, c.reviewerTime, c.orderNo
//					from $subTable as a
//					left join vich_goods as b on b.goodsId = a.goodsId 
//					left join vich_orders_ip as c on c.orderId = a.orderId
//					where a.orderId='$orderId'";
//			$list = $db->query($sql)->fetchAll();
//			
//			if($list){
//				return $list;
//			}
//		}		
//		return array();
//	}

	//材料入库、出库、盘存汇总表
	public static function report1($companyId, $cateId){
		$db = self::__instance();
		$sql = "select a.goodsId, a.goodsName, b.unitName 
				from vich_goods as a
				left join vich_goods_units as b on b.unitId = a.goodsUnitId
				where 1=1
				";
		if(!empty($cateId)){
			$sql.=" and a.goodsCateId1=$cateId ";
		}
		$i=0; $list = array();
		foreach($db->query($sql) as $row){
			$goodsId = $row['goodsId'];
			$list[$i]['goodsId'] = $goodsId;
			$list[$i]['goodsName'] = $row['goodsName'];
			$list[$i]['unitName'] = $row['unitName'];
			$list[$i]['pdCount'] = self::pd($goodsId, $companyId, 1);
			$list[$i]['ipCount'] = self::ip($goodsId, $companyId);
			$list[$i]['oyCount'] = self::oy($goodsId, $companyId);
			$list[$i]['pdCount1'] = self::pd($goodsId, $companyId, 0);
			$i++;
		}		
		return $list;
	}
	
	//查看上月盘点
	public static function pd($goodsId, $companyId, $type=1){
		$db = self::__instance();
		$sql = "select count(*) as `count`, IFNULL(round(avg(goodsPrice),2),0) as `avg`
				from vich_orders_pd_goods as a 
				left join vich_orders_pd as b on b.orderId = a.orderId
				where a.goodsId=$goodsId and b.flag=3 ";
		if($type==1){ //本月
			$sql.=" and date_format(a.createTime,'%Y-%m')=date_format(now(),'%Y-%m') ";
		}else{ // 上一个月
			$sql.="and PERIOD_DIFF(date_format(now(),'%Y%m'),date_format(a.createTime,'%Y%m') ) =1";
		}
		if(!empty($companyId)){
			$sql.=" and a.createCompany=$companyId ";
		}
		$row = $db->query($sql)->fetch();
		return $row;
	}
	//本月采购入库
	public static function ip($goodsId, $companyId){
		$db = self::__instance();
		$sql = "select count(*) as `count`, IFNULL(round(avg(goodsPrice),2),0) as `avg`
				from vich_orders_ip_goods as a 
				left join vich_orders_ip as b on b.orderId = a.orderId
				where a.goodsId=$goodsId and b.flag=3 and date_format(a.createTime,'%Y-%m')=date_format(now(),'%Y-%m')";
		if(!empty($companyId)){
			$sql.=" and a.createCompany=$companyId ";
		}
		$row = $db->query($sql)->fetch();
		return $row;
	}
	//本月出库
	public static function oy($goodsId, $companyId){
		$db = self::__instance();
		$sql = "select count(*) as `count`, IFNULL(round(avg(goodsPrice),2),0) as `avg`
				from vich_orders_oy_goods as a 
				left join vich_orders_oy as b on b.orderId = a.orderId
				where a.goodsId=$goodsId and b.flag=3 and date_format(a.createTime,'%Y-%m')=date_format(now(),'%Y-%m')";
		if(!empty($companyId)){
			$sql.=" and a.createCompany=$companyId ";
		}
		$row = $db->query($sql)->fetch();
		return $row;
	}
}
