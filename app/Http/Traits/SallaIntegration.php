<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait SallaIntegration
{
    public function getData(){
        $response = Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
        ->get('https://api.salla.dev/admin/v2/products');
        
        $numberPages =  $response['pagination']['totalPages'];
        $allData = [];
        $allData =  json_decode($response)->data;
        for($i = 2; $i <= $numberPages; $i++){
            $allData  = array_merge($allData , json_decode( Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
            ->get('https://api.salla.dev/admin/v2/products?page='.$i))->data);

        }
        return $allData;
    }

    public function StoreSallaProduct($data){
        Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
        ->asJson()->post('https://api.salla.dev/admin/v2/products',[
            'name' => $data['name'],
            'price' => $data['price'],
            'sku' => $data['sku'],
            'product_type' => $data['product_type'],
            'quantity' => $data['quantity'],
            'status' =>   $data['status'],
            'images' => [
                [
                    'original' =>  $data['main_image'],
                ]
            ],
            'description' => $data['description'],
        ]);
        return response()->json('sucess');
    }

    public function updateSallaProduct($data ,$id){
        Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
            ->asJson()->put('https://api.salla.dev/admin/v2/products/'.$id,[
                'name' => $data['name'],
                'price' => $data['price'],
                'sku' => $data['sku'],
                'product_type' => $data['product_type'],
                'quantity' => $data['quantity'],
                'status' =>   $data['status'],
                'images' => [
                    [
                        'original' =>  $data['main_image']  ?? null,
                    ]
                ],
                'description' => $data['description'],
            ]);
        return response()->json('sucess');
    }
 
}
