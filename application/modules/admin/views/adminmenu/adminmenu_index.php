<!doctype html>
<html>
<head>
<base href="<?=site_url('');?>">
<title>管理菜单列表页面</title>
<?php $this->load->module('admin/index/page_header');?>
<link href="<?php echo STATIC_PATH;?>b2b_index/css/font_icon.css" rel="stylesheet" />
</head>
<body>
<div class="wrap J_check_wrap">
  <div class="nav">
      <ul>
          <li class="current"><a href="<?php echo site_url('admin/index/adminmenu')?>">菜单管理</a></li>
          <li><a href="<?php echo site_url('admin/index/adminmenu_add')?>">添加菜单</a></li>
      </ul>
  </div>
  <form method="post" action="">
    <div class="table_list" id="content">
      <table width="100%" data-uri="<?php echo site_url('admin/index/ajax_menu_status');?>">
        <thead>
          <tr>
            <td style="width:8%">操作</td>
            <td>菜单名称</td>
            <td>排序</td>
            <td>菜单模块/控制器/方法</td>
            <td>菜单状态</td>
          </tr>
        </thead>

        <tbody>
          <?php foreach($res as $k=>$v):?>
            <tr>
              <td class="btn_min">
                    <div class="operat hidden">
                        <a class="icon-cog action" href="javascript:;">处理</a>
                        <div class="menu_select">
                            <ul>
                                <li><a class="icon-pencil" href="<?php echo site_url('admin/index/adminmenu_edit?id='.$v['id']) ?>">编辑</a></li>
                                <li><a class="icon-remove-2 doDel" href="javascript:;" data-uri="<?php echo site_url('admin/index/ajax_remove_adminmenu?id='.$v['id'])?>">删除</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
              <td onclick="zhankai(<?php echo $v['id']?>)"><?php echo $v['name'];?></td>
              <td><input type="text" class="sort" value="<?php echo $v['sort_order']?>" alt="<?php echo $v['id']?>" size="5" onchange="edit_sort(this)" ></td>
              <td><?php echo $v['app'].'/'.$v['controller'].'/'.$v['action']?></td>
              <td><img class="pointer" data-id="<?php echo $v['id']?>" style="cursor: pointer;" data-field="status" data-value="<?php echo $v['status']?>" src="<?php echo STATIC_PATH.'b2b_index/images/icons/icon_'.$v['status'].'.png'?>" /></td>
            </tr>
            <?php foreach($v['list'] as $k1=>$v1):?>
              <tr style="display: none" class="level_<?php echo $v['id']?>">
                <td class="btn_min">
                  <div class="operat hidden">
                    <a class="icon-cog action" href="javascript:;">处理</a>
                    <div class="menu_select">
                      <ul>
                        <li><a class="icon-pencil" href="<?php echo site_url('admin/index/adminmenu_edit?id='.$v1['id']) ?>">编辑</a></li>
                        <li><a class="icon-remove-2 doDel" href="javascript:;" data-uri="<?php echo site_url('admin/index/ajax_remove_adminmenu?id='.$v1['id'])?>">删除</a></li>
                      </ul>
                    </div>
                  </div>
                </td>
                <td onclick="zhankai2(<?php echo $v1['id']?>)">&nbsp;&nbsp;&nbsp;&nbsp;├─ <?php echo $v1['name'];?></td>
                <td><input type="text" class="sort" value="<?php echo $v1['sort_order']?>" alt="<?php echo $v1['id']?>" size="5" onchange="edit_sort(this)"></td>
                <td><?php echo $v1['app'].'/'.$v1['controller'].'/'.$v1['action']?></td>
                <td><img class="pointer" data-id="<?php echo $v1['id']?>" style="cursor: pointer;" data-field="status" data-value="<?php echo $v1['status']?>" src="<?php echo STATIC_PATH.'b2b_index/images/icons/icon_'.$v1['status'].'.png'?>" /></td>
              </tr>
              <?php foreach($v1['list'] as $k2=>$v2):?>
                <tr style="display: none" class="level_<?php echo $v['id']?> leveo_<?php echo $v['id']?> level_<?php echo $v1['id']?>">
                  <td class="btn_min">
                    <div class="operat hidden">
                      <a class="icon-cog action" href="javascript:;">处理</a>
                      <div class="menu_select">
                        <ul>
                          <li><a class="icon-pencil" href="<?php echo site_url('admin/index/adminmenu_edit?id='.$v2['id']) ?>">编辑</a></li>
                          <li><a class="icon-remove-2 doDel" href="javascript:;" data-uri="<?php echo site_url('admin/index/ajax_remove_adminmenu?id='.$v2['id'])?>">删除</a></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├─ <?php echo $v2['name'];?></td>
                  <td><input type="text" class="sort" value="<?php echo $v2['sort_order']?>" alt="<?php echo $v2['id']?>" size="5" onchange="edit_sort(this)"></td>
                  <td><?php echo $v2['app'].'/'.$v2['controller'].'/'.$v2['action']?></td>
                  <td><img class="pointer" data-id="<?php echo $v2['id']?>" style="cursor: pointer;" data-field="status" data-value="<?php echo $v2['status']?>" src="<?php echo STATIC_PATH.'b2b_index/images/icons/icon_'.$v2['status'].'.png'?>" /></td>
                </tr>
              <?php endforeach;?>
            <?php endforeach;?>
          <?php endforeach;?>



        </tbody>
      </table>
    </div>
  </form>
</div>
<script type="text/javascript">
  function zhankai(id){
    if($(".level_"+id).eq(0).css('display')=='none'){
      $(".level_"+id).show();
      $(".leveo_"+id).hide();
    }else{
      $(".level_"+id).hide();
    }
  }
  function zhankai2(id){
    $(".level_"+id).toggle();
  }
  function edit_sort(obj){
    var id = obj.alt;
    var sort_order = obj.value;
    var data = 'id='+id+'&sort_order='+sort_order;
    $.ajax({
      type: "POST",
      url : "<?php echo site_url('admin/index/edit_sort')?>",
      data: data,
      success:function(result){
       if(result==1){
          window.location.href="<?php echo site_url('admin/index/adminmenu')?>";
       }else{
         alert('修改失败!请重试');return false;
       }
      }
        //var res=eval('(' + result + ')');
      });

  }

</script>
</body>
</html>