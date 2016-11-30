<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Brand;
use App\Group;
use App\Product;
use App\ProductsSku;
use App\Stock;
use App\ProductStock;

use Illuminate\Support\Facades\Log;
use \Suppliers\Adapters\ProductStruct;


class processProduct extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $brand = Brand::firstOrCreate([
           'brand_name' => $this->product["brand"]
        ]);

        $group = Group::firstOrCreate([
            'group_name' => $this->product["group"]
        ]);

        $product = Product::where(["model" => $this->product["key"]])->first();

        if(!$product) {
            $product = Product::create([
                "brand_id"              => $brand->id,
                "group_id"              => $group->id,
                "model"                 => $this->product["key"],
                "name"                  => $this->product["desc"],
                "description"           => $this->product["desc"],
                "price"                 => $this->product["price"],
                "quantity"              => $this->product["qty"],
                "image"                 => $this->product["image"],
                "warranty"              => $this->product["warranty"],
                "discount"              => $this->product["offerPrice"],
                "currencyRate"          => $this->product["currencyRate"],
                "promotionDescription"  => $this->product["promotionDescription"],
                "promotionDateEnd"      => $this->product["promotionDateEnd"]
            ]);
        }

        $total_products_per_sku = 0;

        foreach ($this->product["branches"] as $branch) {
            $stock = Stock::firstOrCreate([
                "supplier_id"   => $this->product["supplier_id"],
                "stock_name"    => $branch["branch"],
            ]);

            ProductStock::updateOrCreate([
                "stock_id"      => $stock->stock_id,
                "product_id"    => $product->id,
                "quantity"      => $branch["qty"]
            ]);

            $total_products_per_sku += $branch["qty"];
        }


        ProductsSku::updateOrCreate([
            "product_id"    => $product->id,
            "supplier_id"   => $this->product["supplier_id"],
            "sku"           => $this->product["code"],
            "price"         => $this->product["price"],
            "quantity"      => $total_products_per_sku
        ]);


    }
}
