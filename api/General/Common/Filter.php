<?php

/**
 * 自定义拦截器
 * Class Common_Filter]
 */
class Common_Filter implements PhalApi_Filter
{
    protected $signName;

    public function __construct($signName = 'sign') {
        $this->signName = $signName;
    }

    public function check() {
        $allParams = DI()->request->getAll();
        if (empty($allParams)) {
            return;
        }

        $sign = isset($allParams[$this->signName]) ? $allParams[$this->signName] : '';
        unset($allParams[$this->signName]);

        $expectSign = $this->encryptAppKey($allParams);

        if ($expectSign != $sign) {
            DI()->logger->debug('Wrong Sign', array('needSign' => $expectSign));
            throw new PhalApi_Exception_BadRequest(T('wrong sign'), 6);
        }
        //请求过期
        if (!isset($allParams['timestamp']) || (time() - $allParams['timestamp']) > 3) {
            DI()->logger->debug('invalid timestamp',array('timestamp'=>time()));
            throw new PhalApi_Exception_BadRequest(T('invalid timestamp'), 8);
        }

        //权限验证
        $referer = DI()->request->get('referer');
        $user = DI()->request->get('user');
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
            'selectAll'=>$user_info['selectAll'],
            'userGroup'=>$user_info['user_group']
        );

        DI()->set('userInfo',$info);
    }


    public function encryptAppKey($params) {
        ksort($params);

        $params['service'] = isset($params['service']) ? $params['service'] : '';
        unset($params['service']);

        $paramsStrExceptSign = '';
        foreach ($params as $val) {
            $paramsStrExceptSign .= $val;
        }

        $secrect = DI()->config->get('sys.crypt.secrect');

        return md5($paramsStrExceptSign . $secrect);
    }
}