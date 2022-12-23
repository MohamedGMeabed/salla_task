<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SallaIntegration;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    use SallaIntegration;
    private $productInterface;
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }
    public function index()
    {
         return view('admin.products.index');
    }

    public function data(){
        $products = Product::select('*');
        return Datatables::of($products)
        ->make(true);
        return $products;
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        try{   
            DB::beginTransaction();       
            $data = $request->all();
            $data['status'] = $request->main_image ? 'sale' : 'hidden' ;
            $product = $this->productInterface->store($data);

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
                        'original' =>  $product->main_image,
                    ]
                ],
                'description' => $data['description'],
            ]);
            DB::commit();
            return redirect()->route('products.index')->with(['success' => 'Product Saved Successfully']);
        }catch(Exception $ex){
            DB::rollBack();
            return back()->with(['error' => 'Error Occured']);
        }
    }

    public function edit($id){
        $product = $this->productInterface->find($id);
        return view('admin.products.edit',compact('product'));
    }

    public function update(Request $request){
        try{   
            DB::beginTransaction();       
            $data = $request->all();
            $data['status'] = $request->main_image ? 'sale' : 'hidden' ;
            $product = $this->productInterface->find($request->id);
            $product = $this->productInterface->update($request->id , $data);

            Http::withToken('WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00')
            ->asJson()->put('https://api.salla.dev/admin/v2/products/'.$request->id,[
                'name' => $data['name'],
                'price' => $data['price'],
                'sku' => $data['sku'],
                'product_type' => $data['product_type'],
                'quantity' => $data['quantity'],
                'status' =>   $data['status'],
                'images' => [
                    [
                        'original' =>  $product->main_image,
                    ]
                ],
                'description' => $data['description'],
            ]);
            DB::commit();
            return redirect()->route('products.index')->with(['success' => 'Product Updated Successfully']);
        }catch(Exception $ex){
            DB::rollBack();
            return back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function delete(Request $request){
        $this->productInterface->delete($request->id);
        return response()->json('success');
    }

    public function pullData(){
        Artisan::call('salla:pull-products');
        return redirect()->route('products.index')->with(['success' => 'Products Pull Successfully']); 
    }
}
