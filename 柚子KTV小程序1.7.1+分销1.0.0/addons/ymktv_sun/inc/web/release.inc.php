<?php

global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();

$tab = pdo_get('ymktv_sun_tab',array('uniacid'=>$_W['uniacid']),'is_shopen');

$where = " WHERE  a.uniacid=".$_W['uniacid'] . ' and b.type=2';
if(!empty($_GPC['keywords'])){
    $op=$_GPC['keywords'];
    $where.=" and b.orderNum LIKE  '%$op%'";
    $data[':name']=$op;
}

$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=5;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
// $data[':uniacid']=$_W['uniacid'];
if($type=='all'){
    $sql = ' SELECT * FROM ' . tablename('ymktv_sun_user') . ' u ' . ' JOIN ' . tablename('ymktv_sun_expert') . ' e ' . ' ON ' . ' e.user_id=u.openid' . ' WHERE ' . ' e.uniacid=' . $_W['uniacid'] . ' AND ' . ' u.uniacid=' . $_W['uniacid']  . ' AND' .' isshow=1 ' . ' ORDER BY release_time DESC';
    $lits = pdo_fetchall($sql);
    foreach ($lits as $k=>$v){
        $lits[$k]['is_shopen'] = pdo_getcolumn('ymktv_sun_tab',array('uniacid'=>$_W['uniacid']),'is_shopen');
        $lits[$k]['imgs'] = explode(',',$v['imgs']);
    }

}else{
    $type = $_GPC['isexamine'];
    $sql = ' SELECT * FROM ' . tablename('ymktv_sun_user') . ' u ' . ' JOIN ' . tablename('ymktv_sun_expert') . ' e ' . ' ON ' . ' e.user_id=u.openid' . ' WHERE ' . ' e.uniacid=' . $_W['uniacid'] . ' AND ' . ' u.uniacid=' . $_W['uniacid']  . ' AND ' . ' e.isexamine=' . $type . ' AND' .' isshow=1 ' . ' ORDER BY release_time DESC';
    $lits = pdo_fetchall($sql);
    foreach ($lits as $k=>$v){
        $lits[$k]['is_shopen'] = pdo_getcolumn('ymktv_sun_tab',array('uniacid'=>$_W['uniacid']),'is_shopen');
        $lits[$k]['imgs'] = explode(',',$v['imgs']);
    }
}

if($_GPC['op']=='delete'){
    $res=pdo_delete('ymktv_sun_expert',array('id'=>$_GPC['id']));
    if($res){
        message('删除成功！', $this->createWebUrl('release'), 'success');
    }else{
        message('删除失败！','','error');
    }
}

if($_GPC['op']=='delivery'){
    $res=pdo_update('ymktv_sun_expert',array('isexamine'=>1),array('id'=>$_GPC['id']));
    if($res){
        message('操作成功',$this->createWebUrl('release',array()),'success');
    }else{
        message('操作失败','','error');
    }
}
if($_GPC['op']=='receipt'){
    $res=pdo_update('ymktv_sun_expert',array('isexamine'=>0),array('id'=>$_GPC['id']));
    if($res){
        message('操作成功',$this->createWebUrl('release',array()),'success');
    }else{
        message('操作失败','','error');
    }
}




include $this->template('web/release');