<?php

namespace App\Console\Commands;

use App\Enums\TransactionType;
use App\Models\DetailKotor;
use App\Services\PostingService;
use Illuminate\Console\Command;

class PostingCommand extends Command
{
    use PostingService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:posting';

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
        $data = [];

        $code = generateCode('FIXCMD');
        $start = now()->addDay(-1)->format('Y-m-d');
        $end = date('Y-m-d');

        $data = DetailKotor::query()
        ->where('tanggal', '>=', $start)
        ->where('tanggal', '<=', $end)
        ->get()
        ->map(function($item) use ($code){

            return [
                'code' => $code,
                'customer' => $item->customer_code,
                'jenis' => $item->jenis_id,
                'tanggal' => $item->tanggal,
                'type' => TransactionType::KOTOR,
                'kotor' => $item->qty,
                'qc' => $item->qc,
                'bersih' => $item->bc,
                'pending' => $item->pending,
                'plus' => $item->plus,
                'minus' => $item->minus,
            ];
        })->toArray() ?? [];

        $this->save($data, null, $start, $end, TransactionType::KOTOR);

        $this->info('posting completed successfully!');
    }
}
