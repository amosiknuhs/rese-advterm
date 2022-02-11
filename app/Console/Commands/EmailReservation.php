<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmMail;
use App\Models\Reserve;


class EmailReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email of today\'s reservation';

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
        $reservations = Reserve::where('date', date('Y-m-d'))->with('user', 'shop')->get();
        if (!$reservations->isEmpty()) {
            foreach ($reservations as $reserve) {
                $request = array(
                    'subject' => 'ご予約確認',
                    'user_name' => $reserve->user->name,
                    'shop_name' => $reserve->shop->name,
                    'time' => $reserve->time->format('H:i'),
                    'number' => $reserve->number
                );
                Mail::to($reserve->user->email)->send(new ConfirmMail($request));
            }
        }
    }
}
