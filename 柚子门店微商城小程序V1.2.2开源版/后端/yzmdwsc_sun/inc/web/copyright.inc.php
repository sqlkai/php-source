<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
 $item=pdo_get('yzmdwsc_sun_system',array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
            $data['support']=$_GPC['support'];
            $data['bq_name']=$_GPC['bq_name'];
            $data['link_name']=$_GPC['link_name'];
            $data['link_logo']=$_GPC['link_logo'];
            $data['bq_logo']=$_GPC['bq_logo'];       
            $data['tz_appid']=trim($_GPC['tz_appid']);
            $data['tz_name']=$_GPC['tz_name'];
            $data['uniacid']=$_W['uniacid'];       
            if($_GPC['id']==''){                
                $res=pdo_insert('yzmdwsc_sun_system',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('copyright',array()),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('yzmdwsc_sun_system', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('copyright',array()),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
include $this->template('web/copyright');