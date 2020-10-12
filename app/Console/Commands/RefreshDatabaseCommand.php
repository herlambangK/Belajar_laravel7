<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is usefull refresh all database and all database and seed the default data';

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
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        
        // $categories = collect(['Framework','Code']);
        // $categories->each( function($c){
        //     \App\Category::create([
        //         'name'=> $c,
        //         'slug' => \Str::slug($c),
        //     ]);
        // });

        // $tags = collect(['Laravel','Fundation', 'Slim', 'Bug', 'Help']);
        // $tags->each( function($c){
        //     \App\Tag::create([
        //         'name'=> $c,
        //         'slug' => \Str::slug($c),
        //     ]);
        // });
        $this->call('db:seed');  //databaseseeder.php
        $this->info('All database has been refreshed and seeded');
    }
}