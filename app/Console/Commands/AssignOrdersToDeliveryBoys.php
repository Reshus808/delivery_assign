<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DeliveryBoy;
use App\Models\Order;
use Carbon\Carbon;

class AssignOrdersToDeliveryBoys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delivery-cron-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingOrders = Order::where('status', 'pending')->get();
        $deliveryBoys = DeliveryBoy::all();
        foreach ($deliveryBoys as $boy) {
            $activeOrders = Order::where('delivery_boy_id', $boy->id)
                ->where('assigned_at', '>=', now()->subMinutes(30))
                ->count();

            if ($activeOrders == 0) {
                $ordersToAssign = $pendingOrders->splice(0, $boy->max_capacity);

                foreach ($ordersToAssign as $order) {
                    $order->delivery_boy_id = $boy->id;
                    $order->assigned_at = now();
                    $order->status = 'assigned';
                    $order->save();
                }
            }
        }
    }
}
