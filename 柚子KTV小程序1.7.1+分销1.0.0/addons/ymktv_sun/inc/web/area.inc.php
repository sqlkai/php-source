<?php
global $_GPC, $_W;
load()->func('tpl');
$GLOBALS['frames'] = $this->getMainMenu();
$list = pdo_getall('ymktv_sun_area',array('uniacid' => $_W['uniacid']),array(),'','num ASC');
if($_GPC['id']){
    $res=pdo_delete('ymktv_sun_area',array('id'=>$_GPC['id']));
    if($res){
        message('删除成功',$this->createWebUrl('area',array()),'success');
    }else{
        message('删除失败','','error');
    }
}
include $this->template('web/area');