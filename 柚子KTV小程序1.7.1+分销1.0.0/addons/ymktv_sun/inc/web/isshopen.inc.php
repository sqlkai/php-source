<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$item=pdo_get('ymktv_sun_tab',array('uniacid'=>$_W['uniacid']));
if(checksubmit('submit')){           
    $data['is_shopen']=$_GPC['is_shopen'];
    $data['uniacid']=$_W['uniacid'];

    if($_GPC['id']==''){
        $res=pdo_insert('ymktv_sun_tab',$data);
        if($res){
            message('编辑成功',$this->createWebUrl('isshopen',array()),'success');
        }else{
            message('编辑成功','','error');
        }
    }else{
        $res = pdo_update('ymktv_sun_tab', $data, array('id' => $_GPC['id']));
        if($res){
            message('编辑成功',$this->createWebUrl('isshopen',array()),'success');
        }else{
            message('编辑失败','','error');
        }
    }
}
include $this->template('web/isshopen');