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

    /***
     * 根据库存预警生成采购清单
     * @param messageid 数组
     */
    public static function purchase_list_info($messageaId){
        $db = self::__instance();
        $kc = array();
        $kcinfo = array();
        $kinfo = array();
        if(strlen($messageaId)>0){
            $sql = "select * from vich_messages where flag=0 and messageId in (".$messageaId.")";
            $stmt = $db->prepare($sql);
            $info = $stmt->execute();
            $infolist = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($infolist as $k=>$v){
            $kc = explode(',',$v['content']);
            //return $kc;
            foreach ($kc as $kk=>$vv){
                $kcinfo = explode(':',$vv);
                if($kk==0){
                    $kinfo[$v['messageId']]['depotName']= $kcinfo[1];
                }else if($kk==1){
                    $kinfo[$v['messageId']]['goodsName']= $kcinfo[1];
                }else if($kk==2){
                    $kinfo[$v['messageId']]['goodsCnt']= $kcinfo[1];
                }
             }
            }
            return $kinfo;
        }else{
            return false;
        }
    }
    /***
     * 处理库存预警，改变消息状态
     * @param messageid 数组 action done
     */
    public static function purchase_done($messageaId){
        $db = self::__instance();
        $sql = "update vich_messages set flag=1 where flag=0 and messageId in (".$messageaId.")";
        $stmt = $db->prepare($sql);
        $res = $stmt->execute();
        return $res;

    }
}