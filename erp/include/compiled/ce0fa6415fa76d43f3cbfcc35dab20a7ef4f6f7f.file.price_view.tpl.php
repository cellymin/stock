<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:28:34
         compiled from "D:\wwwroot\erp\include\template\purchase\price_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1394759fd33e2f25168-55310221%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce0fa6415fa76d43f3cbfcc35dab20a7ef4f6f7f' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\purchase\\price_view.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1394759fd33e2f25168-55310221',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'years' => 0,
    'y' => 0,
    '_GET' => 0,
    'priceTop' => 0,
    's' => 0,
    'myChart' => 0,
    'myChart2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd33e30599c1_55014981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd33e30599c1_55014981')) {function content_59fd33e30599c1_55014981($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="form_div">
    <div style="overflow: hidden;text-align: right;padding-right: 90px;">
        <form action="" method="get" >
            <select name="year" id="yearSelect" >
                <?php  $_smarty_tpl->tpl_vars['y'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['y']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['y']->key => $_smarty_tpl->tpl_vars['y']->value) {
$_smarty_tpl->tpl_vars['y']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['y']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['y']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['year']==$_smarty_tpl->tpl_vars['y']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['y']->value;?>
年度</option>
                <?php } ?>
            </select>
            <input type="hidden" name="goodsId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['goodsId'];?>
">
        </form>
    </div>
    <div id="data_charts" style="width: 100%;height:250px;margin-bottom: 40px;"></div>
    <div style="width: 40%;float: left">
        <table class="table  table-striped" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>供应商</th>
                    <th>联系方式</th>
                    <th>参考价格</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priceTop']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
                <tr>
                    <td>G<?php echo $_smarty_tpl->tpl_vars['s']->value['supplierId'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['s']->value['supplierName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['s']->value['supplierTel'];?>
</td>
                    <td>&yen;<?php echo $_smarty_tpl->tpl_vars['s']->value['minPrice'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="width: 50%;float: right">
        <div id="supplier_chart"  style="width: 100%;height:250px"></div>
    </div>
</div>
<script>

    var myChart = echarts.init(document.getElementById('data_charts'));
    var colors = ['#5793f3', '#d14a61', '#675bba'];
    var myChartData = <?php echo $_smarty_tpl->tpl_vars['myChart']->value;?>
;
    option = {
        color: colors,

        tooltip: {
            trigger: 'none',
            axisPointer: {
                type: 'cross'
            }
        },
        title:{
            text:'测试商品',
            padding:[5,60]
        },
        legend: {
            data:['采购价格', '采购数量']
        },
        grid: {
            top: 70,
            bottom: 50
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                axisLine: {
                    onZero: false,
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisPointer: {
                    label: {
                        formatter: function (params) {
                            return '数量  ' + params.value
                                    + (params.seriesData.length ? '：' + params.seriesData[0].data : '');
                        }
                    }
                },
                data: myChartData.axis
            },
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                axisLine: {
                    onZero: false,
                    lineStyle: {
                        color: colors[0]
                    }
                },
                axisPointer: {
                    label: {
                        formatter: function (params) {
                            return ' 金额 ' + params.value
                                    + (params.seriesData.length ? '：' + params.seriesData[0].data : '');
                        }
                    }
                },
                data: myChartData.axis
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name:'采购价格',
                type:'line',
                xAxisIndex: 1,
                smooth: true,
                data: myChartData.series_data1
            },
            {
                name:'采购数量',
                type:'line',
                smooth: true,
                data: myChartData.series_data2
            }
        ]
    };

    myChart.setOption(option);


    var myChart2 = echarts.init(document.getElementById('supplier_chart'));
    var myChart2Data = <?php echo $_smarty_tpl->tpl_vars['myChart2']->value;?>
;
    option = {
        title : {
            text: '采购总量占比',
            x:'left'
        },
        legend: {
            x : 'letf',
            y : 'bottom',
            data:myChart2Data.legend_data
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        calculable : true,
        series : [
            {
                name:'采购比例',
                type:'pie',
                radius : [30, 110],
                center : ['50%', '50%'],
                roseType : 'area',
                data:myChart2Data.series_data
            }
        ]
    };
    myChart2.setOption(option);


    $("#yearSelect").change(function () {
        $(this).parent('form').submit();
    })
</script><?php }} ?>
