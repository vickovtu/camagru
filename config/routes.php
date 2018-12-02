<?php
return array(
    'instal'                => 'instal/index',
	'camagru/([0-9]+)' 		=> 'camagru/view',
    'camagru'          		=> 'camagru/index',
    'gallery/([0-9]+)' 		=> 'gallery/view',
    'gallery/page-([0-9]+)' => 'gallery/list/$1',
    'gallery'				=> 'gallery/list',
    'camera/add'            => 'camera/add',
    'foto/comment'          => 'foto/comment',
    'foto/delike'           => 'foto/delike',
    'foto/addlike'          => 'foto/addlike',
    'camera'           		=> 'camera/index',
    'account/edit'          => 'account/edit',
    'account/delete'        => 'account/delete',
    'account/delimg'        => 'account/delimg',
    'account'         		=> 'account/index',
    'user/register'			=> 'user/register',
    'user/login'			=> 'user/login',
    'user/logout'           => 'user/logout',
    'user/reg/([0-9a-zA-Z@.]+)'              => 'user/reg/$1',
    ''                 		=> 'camagru/index',
);
?>
