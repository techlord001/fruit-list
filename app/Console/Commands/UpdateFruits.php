<?php

namespace App\Console\Commands;

use App\Services\FruitService;
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

    protected $fruitService;

    public function __construct(FruitService $fruitService)
    {
        parent::__construct();

        $this->fruitService = $fruitService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->fruitService->updateFruitFromJson();

        $this->info('Fruits updated successfully!');
    }
}
