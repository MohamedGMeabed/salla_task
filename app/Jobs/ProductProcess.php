<?php

namespace App\Jobs;

use App\Models\Product;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            foreach($this->data as $one){
                Product::updateOrCreate(
                    [
                        'id' =>$one->id,
                    ],
                    [
                    'id' =>$one->id,
                    'sku' =>$one->sku,
                    'price' =>$one->price->amount,
                    'name' =>$one->name,
                    'description' =>$one->description,
                    'main_image' =>$one->main_image,
                    'status' =>$one->status,
                ]);
            }
            return true;
        }catch(Exception $ex){
            dd($ex);
        }
    }
}
