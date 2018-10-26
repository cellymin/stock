<{include file ="header.tpl"}>


<div class="form_div">
    <div style="overflow: hidden;text-align: right;padding-right: 90px;">
        <form action="" method="get" >
            <select name="year" id="yearSelect" >
                <{foreach from=$years key=index item=y}>
                <option value="<{$y}>" <{if $_GET.year==$y}>selected<{/if}>><{$y}>年度</option>
                <{/foreach}>
            </select>
            <input type="hidden" name="goodsId" value="<{$_GET.goodsId}>">
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
            <{foreach from=$priceTop item=s}>
                <tr>
                    <td>G<{$s.supplierId}></td>
                    <td><{$s.supplierName}></td>
                    <td><{$s.supplierTel}></td>
                    <td>&yen;<{$s.minPrice}></td>
                </tr>
            <{/foreach}>
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
    var myChartData = <{$myChart}>;
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
    var myChart2Data = <{$myChart2}>;
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
</script>