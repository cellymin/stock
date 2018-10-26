<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

/**
 * 库位类
 * Class DepotSub
 */
class DepotSub extends Base
{
    //获取公司库位
    public static function getCompanyDepotSub($start, $page_size, $keyword, $depotId)
    {
        $db = self::__instance();

        $sql = 'select ds.*,co.companyName,d.depotName from vich_depot_subs ds 
                left join vich_companys co on co.companyId=ds.companyId
                left join vich_depots d on d.depotId=ds.depotId
                where ds.companyId=' . $_SESSION[UserSession::SESSION_NAME]['companyId'] . ' and ds.flag=1
                and ds.depotSubName like :keyword';

        $param[":keyword"] = '%' . $keyword . '%';
        if ($depotId) {
            $sql .= ' and ds.depotId=:depotId';
            $param[":depotId"] = $depotId;
        }
        if ($page_size) {
            $sql .= " limit $start,$page_size";
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($param);

        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($list) {
            return $list;
        }
        return array();
    }

    //统计公司库位
    public static function countCompanyDepotSub($keyword, $depotId)
    {
        $db = self::__instance();

        $sql = 'select count(*) as `count` 
                from vich_depot_subs ds 
                where ds.companyId=' . $_SESSION[UserSession::SESSION_NAME]['companyId'] . ' and ds.flag=1
                and ds.depotSubName like :keyword';
        $param[":keyword"] = '%' . $keyword . '%';

        if ($depotId) {
            $sql .= ' and ds.depotId=:depotId';
            $param[":depotId"] = $depotId;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($param);

        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count) {
            return $count['count'];
        }
        return 0;
    }

    public static function getDepotSubById($depotSubId){
        $db = self::__instance();
        $row = $db->select('vich_depot_subs','*',array('depotSubId'=>$depotSubId));
        if($row){
            return $row[0];
        }
        return array();
    }
}