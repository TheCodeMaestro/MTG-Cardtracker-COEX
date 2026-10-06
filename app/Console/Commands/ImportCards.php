<?php

namespace App\Console\Commands;

use App\Models\Card;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCards extends Command
{
    protected $signature = 'cards:import
            {file : The path to the JSONL file to import}
            {--batch=100 : The number of cards to import in each batch}';

    protected $description = 'Imports cards from a filteredJSONL file into the database in batches.';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');
        $batchSize = (int) $this->option('batch');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return self::FAILURE;
        }

        $this->info("Starting import from: $file");
        $this->info("Batch size: $batchSize");

        // Open the file for reading
        $input = fopen($file, 'r');
        if (!$input) {
            $this->error("Could not open file: $file");
            return self::FAILURE;
        }

        $cardBatch = [];

        while (($line = fgets($input)) !== false) {

            $line = trim($line);

            // Ignore empty lines
            if ($line === '') {
                continue;
            }

            $data = json_decode($line, true, 512, JSON_THROW_ON_ERROR);

            // Convert the JSON data to match the cards table structure
            if ($data) {
                $cardBatch[] = [
                    'id' => $data['id'],
                    'oracle_id' => $data['oracle_id'] ?? null,
                    'card_name' => $data['name'],
                    'cmc' => $data['cmc'],
                    'color_identity' => json_encode($data['color_identity'] ?? []),
                    'type_line' => $data['type_line'],
                    'oracle_text' => $data['oracle_text'] ?? null,
                    'power' => $data['power'] ?? null,
                    'toughness' => $data['toughness'] ?? null,
                    'loyalty' => $data['loyalty'] ?? null,
                    'artist' => $data['artist'] ?? null,
                    'released_at' => $data['released_at'],
                    'set_name' => $data['set_name'],
                    'normal_image_url' => $data['image_uris']['normal'] ?? null,
                    'usd_price' => $data['prices']['usd'] ?? null,
                    'eur_price' => $data['prices']['eur'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert in batches when the batch size is reached
            if (count($cardBatch) >= $batchSize) {
                DB::table('cards')->insert($cardBatch);
                $this->info("Inserted batch of " . count($cardBatch) . " cards.");
                $cardBatch = [];
            }
        }

        // Insert any remaining cards
        if (!empty($cardBatch)) {
            DB::table('cards')->insert($cardBatch);
            $this->info("Inserted final batch of " . count($cardBatch) . " cards.");
        }

        fclose($input);
    }
}
