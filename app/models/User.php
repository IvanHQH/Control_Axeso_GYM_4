<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];    
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    protected $fillable = array('name', 'password');  

    /*public static function setCustomerSelect($idUser,$nameBranchOffice)
    {
        $user = User::find($idUser);        
        $client = BranchOffice::Where('name',$nameBranchOffice)->get(); 
        $user->client_id = $client[0]->id;
        $user->save();
    }*/


    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }        
        
}
