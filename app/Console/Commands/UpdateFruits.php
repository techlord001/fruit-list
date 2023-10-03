<?php

namespace App\Console\Commands;

use App\Http\Controllers\FruitController;
use Illuminate\Console\Command;

class UpdateFruits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:fruits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call updateFruitFromJson method in FruitController to update fruits from JSON';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FruitController::updateFruitFromJson();

        $this->info('Fruits updated successfully!');
    }
}
