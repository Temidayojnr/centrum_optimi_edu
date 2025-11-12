<?php

namespace App\Console\Commands;

use App\Models\Donation;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateDonationTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donations:generate-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate secure tokens for existing donations that do not have tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $donations = Donation::whereNull('token')->get();

        if ($donations->isEmpty()) {
            $this->info('All donations already have tokens.');
            return Command::SUCCESS;
        }

        $this->info("Found {$donations->count()} donations without tokens.");
        $progressBar = $this->output->createProgressBar($donations->count());
        $progressBar->start();

        foreach ($donations as $donation) {
            do {
                $token = Str::random(32);
            } while (Donation::where('token', $token)->exists());

            $donation->update(['token' => $token]);
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info("Successfully generated tokens for {$donations->count()} donations.");

        return Command::SUCCESS;
    }
}
