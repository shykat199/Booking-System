<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Meilisearch\Client;

class ConfigureUniversitySearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meilisearch:configure-universities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client('http://127.0.0.1:7700');
        $index = $client->index('universities');

        $index->updateSearchableAttributes([
            'name',
            'description',
            'cricos',
            'country',
            'city',
            'studyAreas',
        ]);

        $index->updateDisplayedAttributes(['*']);

        $this->info('Meilisearch configuration for universities updated successfully.');
    }
}
