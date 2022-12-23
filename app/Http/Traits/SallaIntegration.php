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
        for($i = 1 ; $i <= $numberPages; $i++){
            $allData  = array_merge($allData , json_decode( Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
            ->get('https://api.salla.dev/admin/v2/products?page='.$i))->data);

        }
        return $allData;
    }
 
}
