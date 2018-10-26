<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

/**
 * 消息设置类
 * Class MSetting
 */
class MsgSetting extends Base
{
    public static function setGoods($depotId, $depotSubId, $goodsCateId, $goodsId, $minWarnNum)
    {
        if (empty($depotId) || empty($depotSubId) || empty($goodsCateId) || empty($goodsId) || empty($minWarnNum)) {
            return false;
        }

        $db = self::__instance();

        $input = array(
            'depotId'       => $depotId,
            'depotSubId'    => $depotSubId,
            'goodsId'       => $goodsId,
            'goodsCateId'   => $goodsCateId,
            'minWarnNum'    => $minWarnNum,
            'flag'          => 1,
            'createCompany' => $_SESSION[UserSession::SESSION_NAME]['companyId'],
            'createUser'    => $_SESSION[UserSession::SESSION_NAME]['user_id'],
            'createTime'    => date('Y-m-d H:i:s')
        );

        return $db->insert('vich_msetting_depot', $input);
    }


    public static function setGoodsIsExists($depotSubId, $goodsId)
    {
        $db = self::__instance();
        $condition = array(
            'AND' => array(
                'depotSubId'    => $depotSubId,
                'goodsId'       => $goodsId,
                'createCompany' => $_SESSION[UserSession::SESSION_NAME]['companyId'],
                'flag'          => 1
            )
        );
        $set = $db->select('vich_msetting_depot', '*', $condition);
        return empty($set);
    }


    public static function countSetGoods($keyword)
    {
        $db = self::__instance();

        $sql = "select count(*) as `count` 
                from vich_msetting_depot msd 
                left join vich_goods g on msd.goodsId=g.goodsId
                where msd.flag=1 and msd.createCompany=:companyId and (g.goodsName like :keyword or g.searchKey like :keyword)";
        $keyword = '%' . $keyword . '%';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyId', $_SESSION[UserSession::SESSION_NAME]['companyId']);
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rs) {
            return $rs['count'];
        }
        return 0;
    }

    public static function listSetGoods($start, $page_size, $keyword)
    {
        $db = self::__instance();

        $sql = "select msd.*,g.goodsName,ds.depotSubName,co.companyName
                from vich_msetting_depot msd
                left join vich_goods g on g.goodsId=msd.goodsId
                left join vich_depot_subs ds on ds.depotSubId=msd.depotSubId
                left join vich_companys co on co.companyId=msd.createCompany
                where msd.flag=1 and (g.goodsName like :keyword or g.searchKey like :keyword)";

        $selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
        $userGroup = $_SESSION[UserSession::SESSION_NAME]['user_group'];
        $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];

        $param[':keyword'] = '%' . $keyword . '%';

        if ($userGroup != 1 && $selectAll != 1) {
            $sql .= " and msd.createCompany=:companyId";
            $param[':companyId'] = $companyId;
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

    public static function getSetGoods($id)
    {
        $db = self::__instance();

        $condition = array(
            'AND' => array('id' => $id)
        );
        $selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
        $userGroup = $_SESSION[UserSession::SESSION_NAME]['user_group'];
        $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];

        if ($userGroup != 1 && $selectAll != 1) {
            $condition['AND']['createCompany'] = $companyId;
        }

        $rs = $db->select('vich_msetting_depot', '*', $condition);
        if ($rs) {
            return $rs[0];
        }
        return array();
    }

    public static function editSetGoods($id, $input)
    {
        if (empty($id) || empty($input) || !is_array($input)) {
            return false;
        }

        $db = self::__instance();
        return $db->update('vich_msetting_depot', $input, array('id' => $id));
    }

    public static function setPrice($goodsCateId, $goodsId, $upPercent,$downPercent)
    {
        if (empty($goodsCateId) || empty($goodsId) || empty($upPercent) || empty($downPercent)) {
            return false;
        }

        $db = self::__instance();

        return $db->insert('vich_msetting_price', array(
            'goodsCateId'   => $goodsCateId,
            'goodsId'       => $goodsId,
            'upPercent'   => $upPercent,
            'downPercent' => $downPercent,
            'flag'          => 1,
            'createCompany' => $_SESSION[UserSession::SESSION_NAME]['companyId'],
            'createUser'    => $_SESSION[UserSession::SESSION_NAME]['user_id'],
            'createTime'    => date('Y-m-d H:i:s')
        ));
    }

    public static function setPriceIsExists($goodsId)
    {
        $db = self::__instance();
        $condition = array(
            'AND' => array(
                'goodsId'       => $goodsId,
                'createCompany' => $_SESSION[UserSession::SESSION_NAME]['companyId'],
                'flag'          => 1
            )
        );
        $set = $db->select('vich_msetting_price', '*', $condition);

        return empty($set);
    }

    public static function countSetPrice($keyword)
    {
        $db = self::__instance();

        $sql = "select count('*') as `count` 
                from vich_msetting_price msp
                left join vich_goods g on g.goodsId=msp.goodsId
                where msp.flag=1 and msp.createCompany=:companyId and (g.goodsName like :keyword or g.searchKey like :keyword)";

        $keyword = '%' . $keyword . '%';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyId', $_SESSION[UserSession::SESSION_NAME]['companyId']);
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rs) {
            return $rs['count'];
        }
        return 0;
    }

    public static function listSetPrice($start, $page_size, $keyword)
    {
        $db = self::__instance();

        $sql = "select msp.*,co.companyName,g.goodsName
                from vich_msetting_price msp
                left join vich_goods g on g.goodsId=msp.goodsId
                left join vich_companys co on co.companyId=msp.createCompany
                where msp.flag=1 and (g.goodsName like :keyword or g.searchKey like :keyword)";

        $selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
        $userGroup = $_SESSION[UserSession::SESSION_NAME]['user_group'];
        $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];

        $param[':keyword'] = '%' . $keyword . '%';

        if ($userGroup != 1 && $selectAll != 1) {
            $sql .= " and msp.createCompany=:companyId";
            $param[':companyId'] = $companyId;
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

    public static function getSetPrice($id)
    {
        $db = self::__instance();

        $condition = array(
            'AND' => array('id' => $id)
        );
        $selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
        $userGroup = $_SESSION[UserSession::SESSION_NAME]['user_group'];
        $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];

        if ($userGroup != 1 && $selectAll != 1) {
            $condition['AND']['createCompany'] = $companyId;
        }

        $rs = $db->select('vich_msetting_price', '*', $condition);
        if ($rs) {
            return $rs[0];
        }
        return array();
    }

    public static function editSetPrice($id, $input)
    {
        if (empty($id) || empty($input) || !is_array($input)) {
            return false;
        }

        $db = self::__instance();
        return $db->update('vich_msetting_price', $input, array('id' => $id));
    }
}

