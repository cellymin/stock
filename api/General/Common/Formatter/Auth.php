<?php

/**
 * 权限验证
 * Class Common_Formatter_Auth
 */

class Common_Formatter_Auth implements PhalApi_Request_Formatter
{
    public function parse($value, $rule) {
        //权限验证
        $referer = DI()->request->get('referer');
        $user = $value;
        if(!$referer || !$user){
            throw new PhalApi_Exception_BadRequest(T('invalid auth'), 8);
        }

        $menu = DI()->notorm->menu_url->select('*')->where('menu_url=?',$referer)->fetch();
        if (empty($menu)) {
            throw new PhalApi_Exception_BadRequest(T('invalid auth'), 3);
        }

        $user_info = DI()->notorm->user->select('*')->where('user_id=?', $user)->fetch();
        if (empty($user_info) || empty($user_info['user_group'])) {
            throw new PhalApi_Exception_BadRequest(T('invalid user'), 3);
        }

        $user_group = DI()->notorm->user_group->select('*')->where('group_id=?', $user_info['user_group'])->fetch();
        if (empty($user_group) || empty($user_group['group_role'])) {
            throw new PhalApi_Exception_BadRequest(T('invalid auth'), 3);
        }

        $user_role = explode(',',$user_group['group_role']);
        if(!in_array($menu['menu_id'],$user_role)){
            throw new PhalApi_Exception_BadRequest(T('invalid auth'), 3);
        }

        $info = array(
            'userId'=>$user,
            'companyId'=>$user_info['companyId'],
            'departmentId'=>$user_info['departmentId'],
            'employeeId'=>$user_info['employeeId'],
            'selectAll'=>$user_info['selectAll']
        );

        return $info;
    }
}