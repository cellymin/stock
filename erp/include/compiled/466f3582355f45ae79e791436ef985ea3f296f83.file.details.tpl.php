<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 09:43:21
         compiled from "C:\wamp\www\jxc.com\erp\include\template\order\details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1040459fd1b39c61bf3-16617129%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '466f3582355f45ae79e791436ef985ea3f296f83' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\order\\details.tpl',
      1 => 1508308628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1040459fd1b39c61bf3-16617129',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'js_confirm' => 0,
    'order' => 0,
    'toReview' => 0,
    'type' => 0,
    'userId' => 0,
    'review' => 0,
    'modify_url' => 0,
    'delete_url' => 0,
    'v' => 0,
    'index' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd1b3b708279_85638635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd1b3b708279_85638635')) {function content_59fd1b3b708279_85638635($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->tpl_vars['js_confirm']->value;?>

<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;" > 打印</button>
        <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>
        <?php if (($_smarty_tpl->tpl_vars['order']->value['flag']==0||$_smarty_tpl->tpl_vars['order']->value['flag']==-3)) {?>
            <button type="submit" class="btn btn-primary layerModel" style="float: right;margin-bottom: 20px;" action="1" title="提交审核"
                    layerUrl="<?php echo $_smarty_tpl->tpl_vars['toReview']->value;?>
" layerW="360px" layerH="200px" layerT="2"
                    layerD="type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&orderId=<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
"> 提交审核
            </button>
        <?php }?>
        <?php if (($_smarty_tpl->tpl_vars['order']->value['flag']==1&&$_smarty_tpl->tpl_vars['userId']->value==$_smarty_tpl->tpl_vars['order']->value['reviewer'])) {?>
            <button type="submit" class="btn btn-primary layerModel" style="float: right;margin-bottom: 20px;" action="1" title="审核"
                    layerUrl="<?php echo $_smarty_tpl->tpl_vars['review']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['type']->value=='PURCHASE_IN') {?>layerW="400px" layerH="460px"<?php } else { ?>layerW="350px" layerH="300px"<?php }?> layerT="2"
                    layerD="type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&orderId=<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
"> 审核
            </button>
        <?php }?>
        <?php if (in_array($_smarty_tpl->tpl_vars['order']->value['flag'],array(0,1,-3))&&!in_array($_smarty_tpl->tpl_vars['type']->value,array('OTHER_IN','OTHER_OUT'))) {?>
            <button type="submit" class="btn btn-primary layerModel"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;" action="1" title="商品"
                    layerUrl="goods_search" layerW="850px" layerH="500px" layerT="2"
                    layerD="type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&orderId=<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
<?php if (($_smarty_tpl->tpl_vars['type']->value=='ALLOT_OUT'||$_smarty_tpl->tpl_vars['type']->value=='USE_OUT')) {?>&depotId=<?php echo $_smarty_tpl->tpl_vars['order']->value['depotId'];?>
<?php }?>"><i class="icon-search"></i> 产品
            </button>
            <button type="submit" class="btn btn-primary layerModel"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;" action="2" title="订单产品"
                    layerUrl="<?php echo $_smarty_tpl->tpl_vars['modify_url']->value;?>
" layerW="450px" layerH="550px" layerT="2"
                    layerD="type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&orderId=<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
"><i class="icon-pencil"></i> 修改
            </button>
            <button type="submit" class="btn btn-primary layerModel" action="3" title="删除商品"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;">
                <i class="icon-trash"></i> 删除
            </button>
        <?php }?>
    </div>
    <div id="oorder">
        <div id="order_head">
            <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
">
            <input type="hidden" name="url" value="plan_order_add">
            <table class="table">
                <tr>
                    <td>订单编号</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['orderNo'];?>
</td>
                    <td>创建时间</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['createTime'];?>
</td>
                </tr>
                <tr>
                    <td>操作员</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['user_name'];?>
</td>
                    <td>状态</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['status'];?>
</td>
                </tr>
                <tr>
                    <td>总金额</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['totalMoney'];?>
</td>
                    <td>总数量</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['totalCnt'];?>
</td>
                </tr>
                <tr>
                    <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))) {?>
                    <td>供应商</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['supplierName'];?>
</td>
                    <?php } elseif (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_IN','ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))) {?>
                    <td>仓库</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['depotName'];?>
</td>
                    <?php } else { ?>
                    <td>客户</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['order']->value['customerName'];?>
</td>
                    <?php }?>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>备注</td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['order']->value['remark'];?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="m-demo">
            <table>
                <thead>
                <tr>
                    <th class="td40 avoid-this">#</th>
                    <th class="td120">名称</th>
                    <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))) {?>
                    <th class="td80">规格</th>
                    <th class="td80">单位</th>
                    <?php } else { ?>
                    <th class="td150">批次号</th>
                    <?php }?>
                    <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))) {?>
                    <th class="td120">供应商</th>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['type']->value=='PURCHASE_IN'||$_smarty_tpl->tpl_vars['type']->value=='SALE_OUT') {?>
                    <th class="td100">仓库</th>
                    <?php }?>
                    <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN'))) {?>
                    <th class="td100">库位</th>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['type']->value=='INVENTORY') {?>
                    <th class="td80">盘点数量</th>
                    <?php } else { ?>
                    <th class="td80">数量</th>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['type']->value=='INVENTORY') {?>
                    <th class="td80">库存数量</th>
                    <?php }?>
                    <th class="td90">价格</th>
                    <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT'))) {?>
                    <th class="td85">部门</th>
                    <th class="td85">领用人</th>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['type']->value=='PLAN') {?>
                    <th class="td100">计划到货日期</th>
                    <?php }?>
                    <th class="avoid-this">备注</th>
                </tr>
                </thead>
            </table>
            <div class="scroll">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['delete_url']->value;?>
.php">
                    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
">
                    <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                    <table class="" id="data_list">
                        <tbody>
                        <tr>
                            <td style="padding: 0;margin: 0">
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['order']->value['goods']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <table cellspacing="0" cellpadding="0" class="table" style="margin:0;border-top:none;border-left:none;border-right:none;">
                                    <tbody>
                                    <tr data-id="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" datatype="1">
                                        <td class="td40 avoid-this"><input type="checkbox" name="id[]" data-name="id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"></td>
                                        <td class="td120"><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsName'];?>
</td>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))) {?>
                                        <td class="td80"><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsSpec'];?>
</td>
                                        <td class="td80"><?php echo $_smarty_tpl->tpl_vars['v']->value['unitName'];?>
</td>
                                        <?php } else { ?>
                                        <td class="td150"><?php echo $_smarty_tpl->tpl_vars['v']->value['orderSubNo'];?>
</td>
                                        <?php }?>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))) {?>
                                        <td class="td120"><?php echo $_smarty_tpl->tpl_vars['v']->value['supplierName'];?>
</td>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='PURCHASE_IN'||$_smarty_tpl->tpl_vars['type']->value=='SALE_OUT') {?>
                                        <td class="td100"><?php echo $_smarty_tpl->tpl_vars['v']->value['depotName'];?>
</td>
                                        <?php }?>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN'))) {?>
                                        <td class="td100"><?php echo $_smarty_tpl->tpl_vars['v']->value['depotSubName'];?>
</td>
                                        <?php }?>
                                        <td class="td80"><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsCnt'];?>
</td>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='INVENTORY') {?>
                                        <td class="td80"><?php echo $_smarty_tpl->tpl_vars['v']->value['depotGoodsCnt'];?>
</td>
                                        <?php }?>
                                        <td class="td90"><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsPrice'];?>
</td>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT'))) {?>
                                        <td class="td85"><?php echo $_smarty_tpl->tpl_vars['v']->value['departmentName'];?>
</td>
                                        <td class="td85"><?php echo $_smarty_tpl->tpl_vars['v']->value['employeeName'];?>
</td>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='PLAN') {?>
                                        <td class="td100"><?php echo date('Y-m-d',strtotime($_smarty_tpl->tpl_vars['v']->value['arrivalTime']));?>
</td>
                                        <?php }?>
                                        <td class="avoid-this">
                                            <?php if ($_smarty_tpl->tpl_vars['v']->value['remark']) {?>
                                            <a><i title="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" class="icon-comment"></i></a>
                                            <?php } else { ?>
                                            <a style="color: #888"><i title="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" class="icon-comment"></i></a>
                                            <?php }?>
                                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" name="remark">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php if ((($_smarty_tpl->tpl_vars['index']->value+1)%23)==0) {?>
                                <div style="page-break-after:always;"></div>
                                <table class="pageHead" style="display: none;border: none">
                                    <thead>
                                    <tr>
                                        <th class="td40 avoid-this">#</th>
                                        <th class="td120">名称</th>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))) {?>
                                        <th class="td80">规格</th>
                                        <th class="td80">单位</th>
                                        <?php } else { ?>
                                        <th class="td150">批次号</th>
                                        <?php }?>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))) {?>
                                        <th class="td120">供应商</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='PURCHASE_IN') {?>
                                        <th class="td100">仓库</th>
                                        <?php }?>
                                        <?php if (!in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN'))) {?>
                                        <th class="td100">库位</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='INVENTORY') {?>
                                        <th class="td80">盘点数量</th>
                                        <?php } else { ?>
                                        <th class="td80">数量</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='INVENTORY') {?>
                                        <th class="td80">库存数量</th>
                                        <?php }?>
                                        <th class="td90">价格</th>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_OUT','USE_OUT'))) {?>
                                        <th class="td85">部门</th>
                                        <th class="td85">领用人</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value=='PLAN') {?>
                                        <th class="td100">计划到货日期</th>
                                        <?php }?>
                                        <th class="avoid-this">备注</th>
                                    </tr>
                                    </thead>
                                </table>
                                <?php }?>
                                <?php } ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

        </div>
    </div>


</div>
<script>
    jQuery(function($) { 'use strict';
        $("#orderPrint").on('click', function() {
            $('.pageHead').show();
            $(".form_div").print({
                //是否包含父文档的样式，默认为true
                globalStyles : true,
                //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
                mediaPrint : false,
                //外部样式
                stylesheet : '<?php echo @constant('ADMIN_URL');?>
/assets/css/print.css',
                //Print in a hidden iframe
                iframe : false,
                //不想打印的元素的jQuery选择器
                noPrintSelector : ".avoid-this",
                //Add this at top
                prepend : 'Hello World',
                //将内容添加到打印内容的后面
                append : '11111',
                //回调方法
                deferred: $.Deferred().done(function() {
                    console.log('Printing done', arguments);
                    $('.pageHead').hide();
                })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
    });
</script>

<?php }} ?>
