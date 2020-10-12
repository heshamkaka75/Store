<?php

        function lang($phrase) {

            static $lang = array(
                'home' => 'الرئيسية',
                'about' => 'عنا',
                'cate' => 'الاقسام',
                'items' => 'مواد',
                'members' => 'الاعضاء',
                'statistics' => 'الاحصائيات',
                'comments' => 'التعليقات',
                'logs' => 'السجلات',
                'hesham' => 'هشام',
                'edit_profile' => 'تعديل',
                'setting' => 'الضبط',
                'logout' => 'الخروج',
                '' => '',
                '' => ''

            );
                return $lang[$phrase];
        }

?>