<?php

namespace App\Console\Commands;

use App\Mail\SendBackup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pushes back up to email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::to("thembocharles123@gmail.com")->send(new SendBackup());
    }
}
