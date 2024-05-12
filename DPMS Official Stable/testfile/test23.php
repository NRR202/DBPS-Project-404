<?php

// Sample data
$data = [95, 90, 97, 92, 98, 100, 88, 96];

// Filter data greater than 94
$filtered_data = array_filter($data, function($value) {
    return $value > 96;
});

// Sort filtered data in descending order
rsort($filtered_data);

?>

<table border="1">
    <tr>
        <th>Rank</th>
        <th>Entry</th>
    </tr>
    <?php 
    // Counter for ranking
    $rank = 1; 
    foreach ($filtered_data as $entry): 
    ?>
    <?php if ($rank <= 3): ?>
    <tr>
        <td><?php echo $rank; ?></td>
        <td><?php echo $entry; ?></td>
    </tr>
    <?php endif; ?>
    <?php 
        // Stop loop after top 3 entries
        if ($rank >= 3) break; 
        $rank++;
    ?>
    <?php endforeach; ?>
</table>
