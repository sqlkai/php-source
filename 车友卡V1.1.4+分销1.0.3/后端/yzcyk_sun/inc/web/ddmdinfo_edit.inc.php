<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$item=pdo_get('yzcyk_sun_order',array('id'=>$_GPC['id']));
$detail=pdo_getall('yzcyk_sun_order_detail',array('order_id'=>$item['id']));
$order_status=$_GPC['order_status'];
foreach($detail as $v){
  	 $item['goods_name'].=$v['gname'].'、'.$v['spec_value']." ".$v['spec_value1'].' x'.$v['num']."|";
}
if(checksubmit('submit')){
   if($_W['ispost']){
     $order=pdo_get('yzcyk_sun_order',array('id'=>$_GPC['id']));
      if($order['order_status']==0&&$order_status>0){
        pdo_update('yzcyk_sun_order',array('pay_time'=>time()),array('id'=>$_GPC['id']));
      } 
      $res = pdo_update('yzcyk_sun_order',array('order_status'=>$_GPC['order_status']),array('id'=>$_GPC['id']));
       if($res){
           message('修改成功',$this->createWebUrl('orderinfo',array()),'success');
       }else{
           message('修改失败','','error');
       }
   }
}
include $this->template('web/ddmdinfo_edit');