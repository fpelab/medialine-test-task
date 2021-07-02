<?php

return [
    'class' => 'yii\web\GroupUrlRule',
    'prefix' => 'v1',
    'rules' => [
        'POST link/create' => 'link/create',
        'GET link/<hash>' => 'link/view',
        [
            'class' => 'app\modules\api\v1\config\ErrorUrlRule'
        ]
    ]
];
