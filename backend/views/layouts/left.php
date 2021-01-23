<?php

use mdm\admin\components\MenuHelper;
use dmstr\widgets\Menu;
use yii\bootstrap\Nav;
?>

<aside class="main-sidebar">

    <section class="sidebar">
        <?php
        $callback = function($menu){

            $data = json_decode($menu['data'], true);
            $items = $menu['children'];

            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标，默认图标大家可以自己随便修改
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;

            return $return;
        };
        /*//这里我们对一开始写的菜单menu进行了优化
        echo dmstr\widgets\Menu::widget( [
            'options' => ['class' => 'sidebar-menu'],
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
        ] ); */?>
        <?=
        Menu::widget([
            'options' => ['class' => 'sidebar-menu', 'data-widget'=> 'tree'],
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback)
        ]);
        ?>

    </section>

</aside>
