<?php

class Model_User extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'user';
    }

    public function getTableKey($table)
    {
        return 'user_id';
    }


    //获取审核人
    public function getReviewers($role)
    {
        $user_group = DI()->notorm->user_group->select('group_concat(group_id) as user_group')
            ->where('find_in_set(?,group_role)', $role)
            ->fetch();

        if ($user_group) {
            $where = 'find_in_set(user_group,?)';
            $param[] = $user_group['user_group'];

            $user = DI()->get('userInfo');
            if ($user['userGroup'] != 1) {
                $where .= ' and companyId=?';
                $param[] = $user['companyId'];
            }

            return DI()->notorm->user->select('user_id,user_name')
                ->where($where, $param)
                ->fetchAll();
        }
        return array();
    }

    public function getUserGroup($userId)
    {
        $sql = 'select g.group_role '
            . 'from vich_user u '
            . 'left join vich_user_group g on g.group_id=u.user_group '
            . 'where u.user_id=:userId';

        return DI()->notorm->user
            ->queryAll($sql, array(':userId' => $userId));
    }
}