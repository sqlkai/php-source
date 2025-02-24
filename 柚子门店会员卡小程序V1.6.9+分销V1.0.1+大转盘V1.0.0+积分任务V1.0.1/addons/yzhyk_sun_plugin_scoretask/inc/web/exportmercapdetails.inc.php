<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$store=pdo_getall('yzhyk_sun_store',array('uniacid'=>$_W['uniacid']));

if(checksubmit('submit')){
       $cond['uniacid']=$_W['uniacid'];
       $store_id=$_GPC['store_id'];
       $mcd_type=$_GPC['mcd_type'];
       if($store_id!=999){
           $cond['store_id']=$store_id;
       }
       if($mcd_type!=999){
           $cond['mcd_type']=$mcd_type;
       }
       $mercapdetails=pdo_getall('yzhyk_sun_mercapdetails',$cond);
       if(!$mercapdetails){
           message('没有你选择的数据',$this->createWebUrl('mercapdetails',array()),'error');
       }
       $export_title =array('序号','商家','类型','金额','佣金(提现用)','备注信息');
       $export_list=array();
       $i=1;
        foreach($mercapdetails as $k => $v){
            $export_list[$k]["id"] = $i;
            $export_list[$k]["store_name"] = $v["store_name"];
            if($v['mcd_type']==1){
                $export_list[$k]["mcd_type"] ='订单收入';
            }else if($v['mcd_type']==2){
                $export_list[$k]["mcd_type"] ='微信提现';
            }else if($v['mcd_type']==3){
                $export_list[$k]["mcd_type"] ='审核失败收入';
            }
            $export_list[$k]["money"] = "￥".$v["money"];
            $export_list[$k]["paycommission"] = "￥".$v["paycommission"];
            $export_list[$k]["mcd_memo"] =$v["mcd_memo"];
            $i++;
        }
        exportToExcel('商家资金明细_'.date("YmdHis").'.csv',$export_title,$export_list);
        exit;
}
include $this->template('web/exportmercapdetails');

//导出方法
/**
 * @creator Jimmy
 * @data 2018/1/05
 * @desc 数据导出到excel(csv文件)
 * @param $filename 导出的csv文件名称 如'test-'.date("Y年m月j日").'.csv'
 * @param array $tileArray 所有列名称
 * @param array $dataArray 所有列数据
 */
function exportToExcel($filename, $tileArray=array(), $dataArray=array()){
    ini_set('memory_limit','512M');
    ini_set('max_execution_time',0);
    ob_end_clean();
    ob_start();
    header("Content-Type: text/csv");
    header("Content-Disposition:filename=".$filename);
    $fp=fopen('php://output','w');
    fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码(比如微信昵称(乱七八糟的))
    fputcsv($fp,$tileArray);
    $index = 0;
    foreach ($dataArray as $item) {
        // if($index==5000){
        //     $index=0;
        //     ob_flush();
        //     flush();
        // }
        $index++;
        fputcsv($fp,$item);
    }

    ob_flush();
    flush();
    ob_end_clean();
}