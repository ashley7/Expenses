<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password','phone_number'];
    protected $hidden = ['password', 'remember_token'];

    
    public static function getPath()
    {

        $os = strtoupper(substr(PHP_OS, 0, 3));      

        if($os==="WIN")

           return config('app.li_dir_win');

        else 

           return config('app.li_dir_unix');
    }

   
    public static function getFile()
    {
        return User::getPath().config('app.li_file');
    }

    public static function apearance()
    {

        $path = User::getFile();

        $fp = fopen($path, "r");
    
        $file_size=filesize($path);
    
        if($file_size==0)
    
            return ['status'=>NULL,'date'=>NULL];
    
        $contents = fread($fp, $file_size);   

        $data = explode(":",$contents);

        if(count($data) != 3) 
        
            return ['status'=>'invalid','date'=>NULL];
            
        try {

            $date = hexdec($data[1]);

        } catch (\Throwable $th) {

            return ['status'=>'past','date'=>NULL];
            
        }       

        $time_stamp = ($date*config('app.li_factor'));
        
        $x = date('d M, Y ',$time_stamp);
     
        

        if($time_stamp < time())

            return ['status'=>'past','date'=>$x];

        return ['status'=>'invalids','date'=>$x];
        
    }


    public static function key()
    {
        $path = User::getFile();  

        $fp = fopen($path, "r");
    
        $file_size=filesize($path);
    
        if($file_size==0)
    
            return NULL;
    
        return fread($fp, $file_size);   

    }

   
}