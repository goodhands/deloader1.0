<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wordpress;

class WPImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordpress:import {page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import my blog posts from a wordpress website';

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
        $page = ($this->argument('page')) ? $this->argument('page') : 1;
        $wp = new Wordpress();
        $wp->importPosts($page);
    }
}
