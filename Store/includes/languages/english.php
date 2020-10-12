<?php

        function lang($phrase) {

            static $lang = array(
                'home'          => 'Home',
                'about'         => 'About',
                'cate'          => 'Categories',
                'items'         => 'Items',
                'members'       => 'Members',
                'statistics'    => 'Statistics',
                'comments'    => 'Comments',
                'logs'          => 'Logs',
                'hesham'        => 'Hesham',
                'edit_profile'  => 'Edit Profile',
                'setting'       => 'Setting',
                'logout'        => 'Logout',
                ''              => '',
                ''              => ''

            );
                return $lang[$phrase];
        }

?>