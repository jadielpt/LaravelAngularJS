<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeProject\OAuth;

use Auth;
/**
 * Description of Verifier
 *
 * @author Jadiel Cordeiro Filho
 */
class Verifier {
    public function verify($username,$password)
    {
        $credentials = [
            'email'    =>$username,
            'password' =>$password,
        ];
        
        if (Auth::once($credentials)){
            return Auth::user()->id;
        }
        
        return false;
    }
}
