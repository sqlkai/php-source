<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$info=pdo_get('yzkm_sun_news',array('id'=>$_GPC['id']));
$city=pdo_getall('yzkm_sun_hotcity',array('uniacid'=>$_W['uniacid']),array(),'','time ASC');
//var_dump($info);die;
if(checksubmit('submit')){
        $data['title']=$_GPC['title'];
        $data['num']=$_GPC['num'];
        //$data['img']=$_GPC['img'];
        $data['state']=$_GPC['state'];
        $data['type']=$_GPC['type'];
        $data['cityname']=$_COOKIE["cityname"];
        $data['details']=html_entity_decode($_GPC['details']);
        $data['time']=time();
        $data['uniacid']=$_W['uniacid'];
     if($_GPC['id']==''){  
        $res=pdo_insert('yzkm_sun_news',$data);
        if($res){
             message('添加成功！', $this->createWebUrl('innews'), 'success');
        }else{
             message('添加失败！','','error');
        }
    }else{
        $res=pdo_update('yzkm_sun_news',$data,array('id'=>$_GPC['id']));
        if($res){
             message('编辑成功！', $this->createWebUrl('innews'), 'success');
        }else{
             message('编辑失败！','','error');
        }
    }
}
include $this->template('web/inaddnews');