<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class profileHandler extends Controller{
    public function handleProfile() {
        $names = $_POST['names'];
        $user = 'user_'.get_current_user_id();
        foreach($names as $name){
            $value = $_POST[$name];
            $update = array();
            while( have_rows('voedingsstoffen', $user )){
                the_row();
                $update[$name] = $value;
            };
            update_field( 'voedingsstoffen', $update, $user);
        };
    }
}
