<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Arellano
 */
class Member extends BaseModel{
    //put your code here
    public static function pathPhoto($memberId)
    {
        return $memberId.'.jpg';
    }
}