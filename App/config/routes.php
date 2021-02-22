<?
return [

    '' => [
        'controller' => 'main',
        'action' => 'redirect',
    ],

    'page=\d{1,}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'add' => [
        'controller' => 'main',
        'action' => 'add',
    ],

    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],

    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],

    'admin/panel=\d{1,}' => [
        'controller' => 'admin',
        'action' => 'panel',
    ],

    'admin/edit' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
];