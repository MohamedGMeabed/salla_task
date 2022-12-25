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
            foreach($this->data as $product){
                
                Product::updateOrCreate(
                    [
                        'id' =>$product->id,
                    ],
                    [
                    'id'          => $product->id,
                    'sku'         => $product->sku,
                    'price'       => $product->price->amount,
                    'name'        => $product->name,
                    'description' => $product->description,
                    'main_image'  => $product->main_image,
                    'status'      => $product->status,
                ]);
            }
            return true;
        }catch(Exception $ex){
            dd($ex);
        }
    }
}
