<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
	$info = pdo_get('yzmdwsc_sun_storein',array('uniacid' => $_W['uniacid'],'id'=>$_GPC['id']));
		if(checksubmit('submit')){
			$data['type']=$_GPC['type'];
			$data['money']=$_GPC['money'];
			$data['num']=$_GPC['num'];
			$data['uniacid']=$_W['uniacid'];
			if($_GPC['id']==''){
				$res=pdo_insert('yzmdwsc_sun_storein',$data);
				if($res){
					message('添加成功',$this->createWebUrl('in',array()),'success');
				}else{
					message('添加失败','','error');
				}
			}else{
				$res = pdo_update('yzmdwsc_sun_storein', $data, array('id' => $_GPC['id']));
				if($res){
					message('编辑成功',$this->createWebUrl('in',array()),'success');
				}else{
					message('编辑失败','','error');
				}
			}
		}
include $this->template('web/addin');