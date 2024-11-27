<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateBatchUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-batch-user-data';

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
        $batchUsers = DB::table('batch_user')->get();

    foreach ($batchUsers as $batchUser) {
        $batchIds = json_decode($batchUser->batch_ids, true);
        $subBatchIds = json_decode($batchUser->sub_batches_ids, true);

        if (is_array($batchIds)) {
            foreach ($batchIds as $batchId) {
                DB::table('batch_user')->insert([
                    'user_id' => $batchUser->user_id,
                    'batch_ids' => $batchId,
                    'role' => $batchUser->role,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        if (is_array($subBatchIds)) {
            foreach ($subBatchIds as $subBatchId) {
                DB::table('batch_user')->insert([
                    'user_id' => $batchUser->user_id,
                    'sub_batches_ids' => $subBatchId,
                    'role' => $batchUser->role,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    $this->info('Batch and Sub-Batch data migration completed.');
    }
}
