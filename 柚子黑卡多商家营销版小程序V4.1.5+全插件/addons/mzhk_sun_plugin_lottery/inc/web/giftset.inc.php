<?php
global $_GPC, $_W;

$GLOBALS['frames'] = $this->getMainMenu();

   $list = pdo_get('mzhk_sun_plugin_lottery_system',array('uniacid'=>$_W['uniacid']));
        if(checksubmit('submit')){
           
            $data['is_tel']=$_GPC['is_tel'];
            $data['uniacid']=$_W['uniacid'];

            if($_GPC['id']==''){
                $res=pdo_insert('mzhk_sun_plugin_lottery_system',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('giftset',array()),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('mzhk_sun_plugin_lottery_system', $data, array('id' => $_GPC['id'],'uniacid'=>$_W['uniacid']));
                if($res){
                    message('编辑成功',$this->createWebUrl('giftset',array()),'success');
                }else{
                message('编辑失败','','error');
                }
            }
        }

include $this->template('web/giftset');