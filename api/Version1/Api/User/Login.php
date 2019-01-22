<?php
class Api_User_Login extends PhalApi_Api
{
    protected function filterCheck()
    {
    }
    public function getRules()
    {
        return array(
            'go'=>array(
                'user_name'=>array('name'=>'user_name','type'=>'string','min'=>1,'required'=>true),
                'password'=>array('name'=>'password','type'=>'string','min'=>1,'required'=>true),
            )
        );
    }

    public function go()
    {
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];
        $rs=array('code'=>0,'data'=>'','msg'=>'');
        $domain=new Domain_User_CURD();

        $user_info=$domain->checkPassword($user_name,$password);
        if ($user_info){
            $rs['code']=1;
            $rs['data']=$user_info;
            $rs['msg']='登录成功';
            return $rs;
        }else{
            $rs['msg']='登录失败';
            return $rs;
        }
    }
}