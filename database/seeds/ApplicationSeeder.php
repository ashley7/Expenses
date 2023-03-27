<?php

use App\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = User::getPath();       

        if(!is_dir($path))  
        
            mkdir($path, 0777,true);

        $file=$path.config('app.li_file');

        if (!file_exists($file))   {

            fopen($file, "w"); 

            exec("sudo chmod 0777 ".$file);

        } 
    }
}
