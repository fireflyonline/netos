<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = '自定义菜单';
$this->params['breadcrumbs'][] = ['label' =>  $this->title];
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?= Url::to(['/wechat/custom-menu/index'])?>"> 自定义菜单</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="panel-body">
                            <div class="ibox float-e-margins">
                                <div class="ibox-tools">
                                    <a class="btn btn-primary btn-xs" id="getNewMenu">
                                        <i class="fa fa-cloud-download"></i>  同步菜单
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="<?php echo Url::to(['edit','type'=>1])?>">
                                        <i class="fa fa-plus"></i>  创建默认菜单
                                    </a>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>标题</th>
                                            <th>匹配规则</th>
                                            <th>是否在微信生效</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($models as $model){ ?>
                                            <tr>
                                                <td><?php echo $model->id?></td>
                                                <td><?php echo $model->title?></td>
                                                <td>全部粉丝</td>
                                                <td>
                                                    <?php if($model->status == 1){ ?>
                                                        <font color="green">菜单生效中</font>
                                                    <?php }else{ ?>
                                                        <a href="<?php echo Url::to(['save','id' => $model->id])?>" class="color-default">生效并置顶</a>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo Yii::$app->formatter->asDatetime($model->append)?></td>
                                                <td>
                                                    <a href="<?php echo Url::to(['edit','id'=>$model->id])?>"><span class="btn btn-info btn-sm">编辑</span></a>&nbsp
                                                    <?php if($model->status == -1){ ?>
                                                        <a href="<?php echo Url::to(['delete','id'=>$model->id])?>" onclick="rfDelete(this);return false;"><span class="btn btn-warning btn-sm">删除</span></a>&nbsp
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php echo LinkPager::widget([
                                                'pagination'        => $pages,
                                                'maxButtonCount'    => 5,
                                                'firstPageLabel'    => "首页",
                                                'lastPageLabel'     => "尾页",
                                                'nextPageLabel'     => "下一页",
                                                'prevPageLabel'     => "上一页",
                                            ]);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    // 获取资源
    $("#getNewMenu").click(function(){
        rfAffirm('同步中,请不要关闭当前页面');
        sync();
    });

    // 同步粉丝资料
    function sync(offset = 0,count = 20){
        $.ajax({
            type:"get",
            url:"<?= Url::to(['sync'])?>",
            dataType: "json",
            success: function(data){
                if(data.code == 200) {
                    rfAffirm(data.message);
                    window.location.reload();
                }else{
                    rfAffirm(data.message);
                }
            }
        });
    }
</script>