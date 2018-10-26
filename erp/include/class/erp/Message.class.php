<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

class Message extends Base
{
    public static function count($type){
        $db = self::__instance();

        $sql = "select count(*) as `count`
                from vich_messages m 
                where (m.companyId=:companyId and m.type=:type and m.type=3 and m.showType!=0 and m.flag=0) or (m.toUser=:userId and m.type=:type and m.flag=0)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyId',$_SESSION[UserSession::SESSION_NAME]['companyId']);
        $stmt->bindParam(':userId',$_SESSION[UserSession::SESSION_NAME]['user_id']);
        $stmt->bindParam(':type',$type);
        $stmt->execute();

        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count) {
            return $count['count'];
        }
        return array();
    }

    public static function warningMsg($start,$page_size,$type)
    {
        $db = self::__instance();

        $sql = "select m.*,u1.real_name,co.companyName,
                (case m.flag when 0 then '未读' when 1 then '已读' when -1 then '删除' end) as `status`
                from vich_messages m 
                left join vich_user u1 on u1.user_id=m.fromUser
                left join vich_companys co on co.companyId=m.companyId
                where (m.companyId=:companyId and m.type=:type and m.type=3 and m.showType!=0) or (m.toUser=:userId and m.type=:type)";
        $sql .= " order by m.createTime desc";

        if($page_size){
            $sql .= " limit $start,$page_size";
        }

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyId',$_SESSION[UserSession::SESSION_NAME]['companyId']);
        $stmt->bindParam(':userId',$_SESSION[UserSession::SESSION_NAME]['user_id']);
        $stmt->bindParam(':type',$type);
        $stmt->execute();

        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($list) {
            return $list;
        }
        return array();
    }
}