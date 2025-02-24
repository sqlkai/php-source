<?php

global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$where="WHERE  a.uniacid=:uniacid and a.user_id !=''";
if($_GPC['keywords']){
  $op=$_GPC['keywords'];
  $where.=" and a.content LIKE  concat('%', :name,'%') ";  
  $data[':name']=$op;
}
$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
 $data[':uniacid']=$_W['uniacid'];
if($type=='all'){   
  $sql="select a.*,b.type_name,c.name as wname from " . tablename("yzqzk_sun_zx") . " a"  . " left join " . tablename("yzqzk_sun_zx_type") . " b on a.type_id=b.id" . " left join " . tablename("yzqzk_sun_user") . " c on a.user_id=c.id ".$where."  order by a.time desc ";
  $total=pdo_fetchcolumn("select count(*) as wname from " . tablename("yzqzk_sun_zx") . " a"  . " left join " . tablename("yzqzk_sun_zx_type") . " b on a.type_id=b.id" . " left join " . tablename("yzqzk_sun_user") . " c on a.user_id=c.id ".$where."  order by a.time desc ",$data);
}else{
    $where.= " and a.state=$state";
    $sql="select a.*,b.type_name,c.name as wname from " . tablename("yzqzk_sun_zx") . " a"  . " left join " . tablename("yzqzk_sun_zx_type") . " b on a.type_id=b.id" . " left join " . tablename("yzqzk_sun_user") . " c on a.user_id=c.id ".$where."  order by a.time desc ";
   
    $total=pdo_fetchcolumn("select count(*) as wname from " . tablename("yzqzk_sun_zx") . " a"  . " left join " . tablename("yzqzk_sun_zx_type") . " b on a.type_id=b.id" . " left join " . tablename("yzqzk_sun_user") . " c on a.user_id=c.id ".$where."  order by a.time desc",$data);
}

$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);

$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
    $res=pdo_delete('yzqzk_sun_zx',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl('zxcheckmanager'), 'success');
        }else{
              message('删除失败！','','error');
        }
}
if($_GPC['op']=='tg'){
    $res=pdo_update('yzqzk_sun_zx',array('state'=>2,'sh_time'=>date('Y-m-d H:i:s')),array('id'=>$_GPC['id']));
    if($res){
         message('通过成功！', $this->createWebUrl('zxcheckmanager'), 'success');
        }else{
              message('通过失败！','','error');
        }
}
if($_GPC['op']=='jj'){
    $res=pdo_update('yzqzk_sun_zx',array('state'=>3,'sh_time'=>date('Y-m-d H:i:s')),array('id'=>$_GPC['id']));
    if($res){
         message('拒绝成功！', $this->createWebUrl('zxcheckmanager'), 'success');
        }else{
         message('拒绝失败！','','error');
        }
}
include $this->template('web/zxcheckmanager');