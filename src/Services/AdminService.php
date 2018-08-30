<?php
namespace App\Services;

use Symfony\Component\Config\Definition\Exception\Exception;

class AdminService
{
    public function checkAdminPassword($result, $password)
    {
        try{
            if($result['password'] == $password){

                return $result['name'];
            }
            return false;

        }catch (Exception $e){
            echo "Error";
        }
    }
}