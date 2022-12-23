<?php

namespace App\Console\Commands;

use App\Http\Traits\SallaIntegration;
use App\Jobs\ProductProcess;
use Exception;
use Illuminate\Console\Command;

class pullProducts extends Command
{
    use SallaIntegration;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salla:pull-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pull products from salla';

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
        try{            
            $data = $this->getData();
            dispatch(new ProductProcess($data));
            return true;
        }catch(Exception $ex){
            dd($ex);
        }
    }

}
