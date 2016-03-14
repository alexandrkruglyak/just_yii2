<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        //site
        ['pattern'=>'site/informations', 'route'=>'site/informations'],
        ['pattern'=>'site/notuser', 'route'=>'site/notuser'],

        //tours
        ['pattern'=>'tours', 'route'=>'tours/default/index'],
        ['pattern'=>'tours/favorits', 'route'=>'tours/default/favorits'],
        ['pattern'=>'tour/order', 'route'=>'tours/default/order'],
        ['pattern'=>'tour/<slug>', 'route'=>'tours/default/view'],

        //tourfirms
        ['pattern'=>'tourfirms', 'route'=>'tourfirms/default/index'],
        ['pattern'=>'tourfirm/createreviews', 'route'=>'tourfirms/default/createreviews'],
        ['pattern'=>'tourfirm/<slug>', 'route'=>'tourfirms/default/view'],
        ['pattern'=>'tourfirm/<slug>/reviews', 'route'=>'tourfirms/default/reviews'],
        ['pattern'=>'tourfirm/<slug>/reviewcomments', 'route'=>'tourfirms/default/reviewcomm'],
        ['pattern'=>'tourfirms/savereviewcomments', 'route'=>'tourfirms/default/savereviewcomments'],
        ['pattern'=>'tourfirm/<slug>/managers', 'route'=>'tourfirms/default/managers'],
        ['pattern'=>'tourfirm/<slug>/tours', 'route'=>'tourfirms/default/tours'],
        ['pattern'=>'tourfirm/<slug>/contact', 'route'=>'tourfirms/default/contact'],
        ['pattern'=>'tourfirms/feedback', 'route'=>'tourfirms/default/feedback'],
        ['pattern'=>'tourfirm/<slug>/article', 'route'=>'tourfirms/default/article'],
        ['pattern'=>'tourfirms/savevotes', 'route'=>'tourfirms/default/savevotes'],

        //visa
        ['pattern'=>'visa', 'route'=>'visa/default/index'],
        ['pattern'=>'visa/favorits', 'route'=>'visa/default/favorits'],
        ['pattern'=>'visa/order', 'route'=>'visa/default/order'],
        ['pattern'=>'visa/<slug>', 'route'=>'visa/default/view'],

        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
        ['pattern'=>'articles', 'route'=>'article/default/index'],
        ['pattern'=>'article/<slug>', 'route'=>'article/default/view'],

        //Auth
        ['pattern'=>'signup', 'route'=>'user/sign-in/signup'],
        ['pattern'=>'logout', 'route'=>'user/sign-in/logout'],

        //Profile
        ['pattern'=>'profile/index','route'=>'/user/default/index'],
        ['pattern'=>'profile/tourfirms','route'=>'/user/tourfirms/index'],
        ['pattern'=>'profile/companiones','route'=>'/user/companiones/index'],
        ['pattern'=>'profile/settings','route'=>'/user/default/settings'],
        ['pattern'=>'profile/news','route'=>'/user/news/index'],
        ['pattern'=>'profile/visa','route'=>'/user/visa/index'],
        ['pattern'=>'profile/tours','route'=>'/user/tours/index'],
        ['pattern'=>'profile/managers','route'=>'/user/manager/index'],
        ['pattern'=>'profile/messages','route'=>'/user/default/messages'],
        ['pattern'=>'profile/tourfirmreviews','route'=>'/user/tourfirmreviews/index'],
        ['pattern'=>'profile/visafavorites','route'=>'/user/visafavorites/index'],
        ['pattern'=>'profile/toursfavorites','route'=>'/user/toursfavorites/index'],


        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];
