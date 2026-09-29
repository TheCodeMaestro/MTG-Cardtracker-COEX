<?php

// Input and output file paths
$inputFile  = 'default-cards-20260929090555.jsonl';
$outputFile = 'output.jsonl';

$input = fopen($inputFile, 'r');
$output = fopen($outputFile, 'w');

if ($input === false) {
    die("Could not open input file: $inputFile\n");
}

if ($output === false) {
    fclose($input);
    die("Could not open output file: $outputFile\n");
}

$lineNumber = 0;
$keptCards = 0;

$allowedSets = ['dtk', 'frf', 'ktk'];

while (($line = fgets($input)) !== false) {
    $lineNumber++;

    $line = trim($line);

    // Ignore empty lines
    if ($line === '') {
        continue;
    }

    try {
        // Convert JSON line into a PHP array
        $data = json_decode($line, true, 512, JSON_THROW_ON_ERROR);

        // Keep allowed sets
        if (!isset($data['set']) || !in_array($data['set'], $allowedSets, true)) {
            continue;
        }

        // Keep printed cards
        if (!isset($data['games']) || !in_array('paper', $data['games'], true)) {
            continue;
        }

        // Removes unnecessary objects
        unset(
            $data['legalities'],
            $data['related_uris'],
            $data['purchase_uris'],
            $data['all_parts']
        );

        // Convert and write one JSON line
        fwrite(
            $output,
            json_encode(
                $data,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ) . PHP_EOL
        );

        $keptCards++;

    } catch (JsonException $e) {
        fwrite(
            STDERR,
            "Invalid JSON on line $lineNumber: {$e->getMessage()}\n"
        );
    }
}

fclose($input);
fclose($output);

echo "Processed $lineNumber lines.\n";
echo "Kept $keptCards cards from sets: " . implode(', ', $allowedSets) . ".\n";
