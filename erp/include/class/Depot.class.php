<?php
class Depot extends Base{
	// 表名
    private static $table_name = 'depots';

    // 查询字段
    private static $columns = 'depotId,depotName,depotNo,companyId,employeeId';

    //状态定义
	const ACTIVE = 1;
	const DEACTIVE = 0;
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	//获取仓库信息
    public static function getAllDepot($start='',$page_size=''){
        $db = self::__instance();
        $limit = "";
        if($page_size){
            $limit = " LIMIT $start,$page_size";
        }
        $sql = "SELECT depotId,depotName,depotNo,companyId,employeeId FROM ".self::getTableName()." WHERE flag=1 ORDER BY depotId DESC $limit";
        		$list=$db->query($sql)->fetchAll();
		if(!empty($list)){
			foreach($list as &$item){
				//$item['login_time']=Common::getDateTime($item['login_time']);
			}
		}

		if ($list) {
			return $list;
		}
		return array ();

    }
    //通过仓库id获取库位id
    public static function getDepotSubByDepotId($depotId){
	    $depotId = intval($depotId);
        $db = self::__instance();
        $subs = $db->query("SELECT depotSubName,depotSubNo FROM vich_depot_subs WHERE flag=1 AND depotId=".$depotId)->fetchAll();
        return $subs;
    }
    /*
     * 获取供应商信息
     * */
    public static function getAllSuppliers($start='',$page_size='')
    {
        $db = self::__instance();
        $limit = "";
        if($page_size){
            $limit = " LIMIT $start,$page_size";
        }
        $sql = "SELECT supplierId,supplierName,supplierUserName FROM vich_suppliers WHERE flag=1 ORDER BY supplierId DESC $limit";
        $list=$db->query($sql)->fetchAll();
        if(!empty($list)){
            foreach($list as &$item){
                //$item['login_time']=Common::getDateTime($item['login_time']);
            }
        }

        if ($list) {
            return $list;
        }
        return array();

    }

    //获取所有库位信息
//	public static function getAllDepotSubs( $start ='' ,$page_size='' ) {
//		$db=self::__instance();
//		$limit ="";
//		if($page_size){
//			$limit =" limit $start,$page_size ";
//		}
//		//$sql = "select * ,coalesce(g.group_name,'已删除') from ".self::getTableName()." u left join ".UserGroup::getTableName()." g on u.user_group = g.group_id order by u.user_id desc $limit";
//		$sql = "SELECT depotSubId,depotId,depotSubName,depotSubNo FROM ".self::getTableName()." ORDER BY depotSubId DESC";
//		$list=$db->query($sql)->fetchAll();
//		if(!empty($list)){
//			foreach($list as &$item){
//				//$item['login_time']=Common::getDateTime($item['login_time']);
//			}
//		}
//
//		if ($list) {
//			return $list;
//		}
//		return array ();
//	}
//	public static function updateUser($user_id,$user_data) {
//
//		if (! $user_data || ! is_array ( $user_data )) {
//			return false;
//		}
//		$db=self::__instance();
//		$condition=array("user_id"=>$user_id);
//
//		$id = $db->update ( self::getTableName(), $user_data, $condition );
//		return $id;
//	}
//
//	/**
//	* 批量修改用户，如批量修改用户分组
//	* user_ids 可以为无key数组，也可以为1,2,3形势的字符串
//	*/
//	public static function batchUpdateUsers($user_ids,$user_data) {
//
//		if (! $user_data || ! is_array ( $user_data )) {
//			return false;
//		}
//		if(!is_array($user_ids)){
//			$user_ids=explode(',',$user_ids);
//		}
//		$db=self::__instance();
//		$condition=array("user_id"=>$user_ids);
//
//		$id = $db->update ( self::getTableName(), $user_data, $condition );
//		return $id;
//	}
//
//

	

}