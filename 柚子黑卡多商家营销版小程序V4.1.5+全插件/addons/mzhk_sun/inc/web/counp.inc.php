<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
//$list = pdo_getall('mzhk_sun_type',array('uniacid' => $_W['uniacid']),array(),'','num ASC');
$info = pdo_getall('mzhk_sun_coupon',array('uniacid'=>$_W['uniacid']));

if($_GPC['op']=='delete'){
    if($_W['ispost']){
        $res=pdo_update('mzhk_sun_coupon',array('isdelete'=>1),array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']));
        // $res=pdo_delete('mzhk_sun_coupon',array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']));
        if($res){
            message('操作成功',$this->createWebUrl('counp',array()),'success');
        }else{
            message('操作失败','','error');
        }
    }
}
if($_GPC['op']=='change'){
    $res=pdo_update('mzhk_sun_coupon',array('state'=>$_GPC['state']),array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']));
    if($res){
        message('操作成功',$this->createWebUrl('counp',array()),'success');
    }else{
        message('操作失败','','error');
    }
}

include $this->template('web/counp');