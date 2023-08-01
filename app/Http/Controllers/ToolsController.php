<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\Log;
use App\Models\User;
use File;

class ToolsController extends Controller
{
    public static function checkOvertime()
    {
        // $date = "2023-05-26 10:25:11";
        // echo date('Y-m-d H:i:s', strtotime($date. ' + 2 days'));
        $now = date('Y-m-d H:i:s');
        $users = Order::whereIn('status_order', ['onprogress'])->orderBy('created_at', 'DESC')->get();
        // dd($users);
        foreach ($users as $key => $user) {
            $open = date('Y-m-d H:i:s', strtotime($user->tanggal_ambil. ' + 2 days'));
            if ($now > $maxDate) {
                try {
                    Order::where('id', $order->id)->update([
                        'penulis_id'   => NULL,
                        'status_order' => 'overtime',
                        'klaim' => 0
                    ]);
                } catch (\Exception $e) {
                    dd($e);
                }

                try {
                    $log = new Log();
                    $log->order_id = $order->id;
                    $log->penulis_id = $order->penulis_id;
                    $log->status = 'overtime';
                    $log->save();
                } catch (\Exception $e) {   
                    dd($e);
                }
            }
        }
    }

    public static function checkAvailableUpload()
    {
        $now = date('Y-m-d H:i:s');
        $users = User::where('status', 'registered')->where('role', 'penulis')->get();
        // dd($users);
        foreach ($users as $key => $user) {
            $open = date('Y-m-d H:i:s', strtotime($user->tanggal_artikel. ' + 30 days'));
            // echo $now. " >= " .$open;
            if ($now >= $open) {
                try {
                    User::where('id', $user->id)->update([
                        'artikel' => 0
                    ]);
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }
    }

}

