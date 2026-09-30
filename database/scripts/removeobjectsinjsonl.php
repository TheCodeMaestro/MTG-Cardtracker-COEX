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
$allowedDataFields = [
    'id', 'object', 'layout', 'oracle_id', 'cmc', 'color_identity',
    'colors', 'loyalty', 'mana_cost', 'name', 'oracle_text', 'power',
    'toughness', 'type_line', 'artist', 'flavor_text', 'released_at',
    'set_name', 'set',
    'prices' => ['usd', 'eur'],
    'image_uris' => ['small', 'normal', 'png']
    ];

while (($line = fgets($input)) !== false) {
    $lineNumber++;

    $line = trim($line);

    // Ignore empty lines
    if ($line === '') {
        continue;
    }

    try {
        // Converts JSON line into a PHP array
        $data = json_decode($line, true, 512, JSON_THROW_ON_ERROR);

        // Keeps allowed sets
        if (!isset($data['set']) || !in_array($data['set'], $allowedSets, true)) {
            continue;
        }

        // Keeps printed cards
        if (!isset($data['games']) || !in_array('paper', $data['games'], true)) {
            continue;
        }

        $filteredData = [];

        // Stores allowed data fields into filteredData array
        foreach ($allowedDataFields as $field => $subFields) {
            if (is_int($field)) {
                $field = $subFields;
                if (array_key_exists($field, $data)) {
                    $filteredData[$field] = $data[$field];
                }
                continue;
            }
            // Handles data in nested fields
            if (array_key_exists($field, $data)) {
                $filteredData[$field] = [];

                foreach ($subFields as $subField) {
                    if (array_key_exists($subField, $data[$field])) {
                        $filteredData[$field][$subField] = $data[$field][$subField];
                    }
                }
            }
        }

        // Convert and write one JSON line
        fwrite(
            $output,
            json_encode(
                $filteredData,
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
