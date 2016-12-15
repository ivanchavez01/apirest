<?php

namespace App\Console\Commands;

use App\Jobs\processProduct;
use Illuminate\Console\Command;
use Suppliers\Suppliers;

class productsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:queue {supplier} {brand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Products of web Service and set queues db';

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
     * @return mixed
     */
    public function handle()
    {
        $products = Suppliers::products()
            ->supplier("cva")
            ->params([
                "marca"     => ($this->argument('brand') != "") ? $this->argument('brand') : "%",
                //"grupo"     => "%",
                //"codigo"    => "%",
                //"clave"     => "%"
            ])
            ->get();

        $this->argument('supplier');

        if($this->argument("brand") != "")
            $this->info("Buscando la marca: " . $this->argument("brand"));

        foreach ($products->productsCollection as $product) {
            dispatch(new processProduct((array)$product));
        }

        $this->info('Se colocaron '.count($products->productsCollection)." colas de productos.");
    }
}
