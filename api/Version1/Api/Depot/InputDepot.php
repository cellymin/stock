<?php

class Api_Depot_InputDepot extends PhalApi_Api
{
    protected function filterCheck()
    {
    }
    public function getRules()
    {
        return array(
            'getList' => array(
                'depotId'=>array('name'=>'depotId','type'=>'int')
            ),
        );
    }

    public function getList()
    {
        $rs=array('code'=>0,'data'=>'','msg'=>'');
//        获取供应商列表
        $S_domain=new Domain_Supplier_CURD();
        $suppliers=$S_domain->appGetlist();
        $rs['data']['suppliers']=$suppliers;
//        获取仓库列表
        $D_domain=new Domain_Depot_CURD();
        $depots=$D_domain->getList();
        $rs['data']['depots']=$depots;
//        获取库位列表
        if(isset($_POST['depotId'])){
            $depotId=$_POST['depotId'];
        }
//        当选择仓库时，获取库位信息；否则提示请选择仓库
        if(isset($depotId)){
            $DS_domain=new Domain_DepotSub_Options();
            $depotSubs=$DS_domain->appGet($depotId);
            $rs['data']['depotSubs']=$depotSubs;
        }
        $rs['code']=1;
        $rs['msg']='获取成功';
        return $rs;
    }

    public function getGoodsInfo(){
        $rs=array('code'=>0,'data'=>'','msg'=>'');
        if ($_POST['depotId']&&$_POST['depotSubId']&&$_POST['supplierId']){
            $goods_domain=new Domain_Goods_CURD();
            $goods=$goods_domain->getGoods($_POST['goodsBarCode']);
            if ($goods){
                $rs['data']['goodsId']=$goods['goodsId'];
                $rs['data']['goodsName']=$goods['goodsName'];
                $rs['data']['lastPrice']=$goods['lastPrice'];
                $rs['code']=1;
                $rs['msg']='获取商品信息成功';
            }else{
                $rs['msg']='该商品不存在';
                return $rs;
            }
        }else{
            $rs['msg']='请选择完整入库信息';
            return $rs;
        }
    }

}