<?php

use yii\helpers\Html;

$user_info = \common\models\User::find()->where(['id' => Yii::$app->user->identity->getId()])->asArray()->one();

?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header blue-skin">
                <div class="dropdown profile-element"> <span>
                        <?= Html::img('/backend/web/img/avatar2.jpg',['class' => 'img-circle','width' => '70']);?>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Админ</strong>
                             </span> <span class="text-info text-xs block"> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <?php $menuItems = [

                ['label' => 'Все пользователи', 'url' => ['/user/index'], 'icon' => 'fa fa-user-plus'],
                ['label' => 'Пользователи', 'url' => ['/user/users'], 'icon' => 'fa fa-users'],
                ['label' => 'Запрос на авторство', 'url' => ['/author-requests/index'], 'icon' => 'fa fa-book'],
                ['label' => 'Заказы', 'url' => ['/orders/index'], 'icon' => 'fa fa-shopping-cart'],
//                ['label' => 'Теги', 'url' => ['/tags/index'], 'icon' => 'building'],
                ['label' => 'Категории', 'url' => ['/category/index'], 'icon' => 'fa fa-list-alt'],
                [
                    'label' => 'Администрирование',
                    'template' => '<a href="{url}"><i class="fa fa-bars"></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Все пользователи', 'url' => ['/control/user']],
                        ['label' => 'Назначение', 'url' => ['/control/assignment']],
                        ['label' => 'Роли', 'url' => ['/control/role']],
                        ['label' => 'Разрешения', 'url' => ['/control/permission']],
                        ['label' => 'Маршруты', 'url' => ['/control/route']],
                        ['label' => 'Правила', 'url' => ['/control/rule']],
                    ]
                ],

//                [
//                    'label' => 'Заказы',
//                    'template' => '<a href="{url}"><i class="fa fa-bars"></i><span class="nav-label ">{label}</span> <span
//                            class="fa arrow"></span></a>',
//                    'url' => '#',
//                    'items' => [
//                        ['label' => 'Пользователи', 'url' => ['/admin/user']],
//
//
//                    ]
//                ],

            ];
            $menuItems = \mdm\admin\components\Helper::filter($menuItems)
            ?>
            <!--            <?//= \common\widgets\CustomNav::widget([
            //                'options' => ['tag' => false],
            //                'items' => $menuItems,
            //                'iconTemplate' => '<a href="{url}"><i class="fa fa-{icon}"></i><span class="nav-label ">{label}</span></a>',
            //                'linkTemplate' => '<a href="{url}"></i>{label}</a>',
            //                'submenuTemplate' => "\n<ul class='nav nav-second-level collapse out'>\n{items}\n</ul>\n",
            //
            //            ]);
            //            ?>-->

            <?= smartysoft\inspinia\widgets\InspiniaMenu::widget([
                'options' => ['tag' => false],
                'items' => $menuItems,
                'submenuTemplate' => "\n<ul class='nav nav-second-level collapse out'>\n{items}\n</ul>\n",

            ]);
            ?>

        </ul>

    </div>
</nav>
