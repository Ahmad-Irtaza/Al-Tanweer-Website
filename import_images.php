<?php
require_once __DIR__ . '/config/database.php';

/**
 * Script to import images from folders into the database
 * Maps folder names to database categories
 */

// Folder to category mapping
$folderMapping = [
    'Fencing' => 'fencing',
    'internal_gates' => 'internal-doors',
    'Pergolas' => 'pergolas',
    'gates' => 'gates',
    'Car_Parking' => 'custom',
    'Automation' => 'automation',
    'balcony' => 'balcony',
    'stairs_case' => 'staircase'
];

// Supported image extensions
$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

function importImagesFromFolders($folderMapping, $imageExtensions) {
    $db = getDatabase();
    $imported = 0;
    $skipped = 0;
    $errors = [];
    
    foreach ($folderMapping as $folderName => $category) {
        $folderPath = __DIR__ . '/' . $folderName;
        
        // Check if folder exists
        if (!is_dir($folderPath)) {
            $errors[] = "Folder not found: $folderName";
            continue;
        }
        
        echo "<h3>Processing folder: $folderName (Category: $category)</h3>";
        
        // Scan directory for images
        $files = scandir($folderPath);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            
            $filePath = $folderPath . '/' . $file;
            
            // Check if it's a file and has valid image extension
            if (is_file($filePath)) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                
                if (in_array($extension, $imageExtensions)) {
                    // Create relative path for database storage
                    $relativePath = $folderName . '/' . $file;
                    
                    // Check if image already exists in database
                    $stmt = $db->prepare("SELECT COUNT(*) FROM products WHERE image_path = ?");
                    $stmt->execute([$relativePath]);
                    
                    if ($stmt->fetchColumn() > 0) {
                        echo "⚠️ Skipped (already exists): $file<br>";
                        $skipped++;
                        continue;
                    }
                    
                    // Generate product name from filename
                    $productName = generateProductName($file, $category);
                    
                    // Generate description based on category
                    $description = generateDescription($category);
                    
                    // Generate specifications
                    $specifications = generateSpecifications($category);
                    
                    // Insert into database
                    try {
                        $stmt = $db->prepare("
                            INSERT INTO products 
                            (name, category, description, image_path, specifications_json, featured) 
                            VALUES (?, ?, ?, ?, ?, 0)
                        ");
                        
                        $stmt->execute([
                            $productName,
                            $category,
                            $description,
                            $relativePath,
                            json_encode($specifications)
                        ]);
                        
                        echo "✅ Imported: $file as '$productName'<br>";
                        $imported++;
                        
                    } catch (PDOException $e) {
                        $errors[] = "Error importing $file: " . $e->getMessage();
                        echo "❌ Error importing: $file<br>";
                    }
                }
            }
        }
        
        echo "<br>";
    }
    
    return [
        'imported' => $imported,
        'skipped' => $skipped,
        'errors' => $errors
    ];
}

function generateProductName($filename, $category) {
    // Remove extension
    $name = pathinfo($filename, PATHINFO_FILENAME);
    
    // Replace underscores and hyphens with spaces
    $name = str_replace(['_', '-'], ' ', $name);
    
    // Capitalize words
    $name = ucwords($name);
    
    // Add category-specific prefix
    $prefixes = [
        'gates' => 'Premium Gate',
        'internal-doors' => 'Internal Door',
        'staircase' => 'Staircase',
        'balcony' => 'Balcony Railing',
        'fencing' => 'Fencing',
        'pergolas' => 'Pergola',
        'automation' => 'Automation System',
        'custom' => 'Car Parking'
    ];
    
    $prefix = $prefixes[$category] ?? 'Product';
    
    return "$prefix - $name";
}

function generateDescription($category) {
    $descriptions = [
        'gates' => 'High-quality gate crafted with premium materials and expert craftsmanship. Perfect for residential and commercial properties.',
        'internal-doors' => 'Elegant internal door designed to enhance your interior spaces with style and durability.',
        'staircase' => 'Beautiful staircase featuring premium construction and elegant design for safety and aesthetics.',
        'balcony' => 'Decorative balcony railing combining safety with aesthetic appeal for your outdoor spaces.',
        'fencing' => 'Durable fencing solution providing security and visual appeal for your property boundaries.',
        'pergolas' => 'Custom-designed pergola perfect for creating comfortable outdoor living spaces.',
        'automation' => 'Advanced automation system for convenient and secure gate operation.',
        'custom' => 'Premium car parking solution designed for durability and functionality.'
    ];
    
    return $descriptions[$category] ?? 'Quality metalwork product from AL TANWEER.';
}

function generateSpecifications($category) {
    $specs = [
        'gates' => [
            'Material' => 'Wrought Iron/Steel',
            'Finish' => 'Powder Coated',
            'Height' => '2-3m',
            'Width' => 'Custom',
            'Warranty' => '10 Years'
        ],
        'internal-doors' => [
            'Material' => 'Steel & Glass',
            'Finish' => 'Premium',
            'Height' => '2.1m',
            'Width' => '0.9m',
            'Warranty' => '5 Years'
        ],
        'staircase' => [
            'Material' => 'Wrought Iron',
            'Finish' => 'Custom',
            'Height' => 'Custom',
            'Warranty' => '15 Years'
        ],
        'balcony' => [
            'Material' => 'Iron/Steel',
            'Finish' => 'Powder Coated',
            'Height' => '1.1m',
            'Warranty' => '10 Years'
        ],
        'fencing' => [
            'Material' => 'Steel',
            'Finish' => 'Galvanized',
            'Height' => '2m',
            'Warranty' => '15 Years'
        ],
        'pergolas' => [
            'Material' => 'Aluminum/Steel',
            'Finish' => 'Weather Resistant',
            'Warranty' => '12 Years'
        ],
        'automation' => [
            'Type' => 'Sliding/Swing',
            'Control' => 'Remote Control',
            'Power' => '220V',
            'Warranty' => '5 Years'
        ],
        'custom' => [
            'Material' => 'Steel',
            'Finish' => 'Durable Coating',
            'Type' => 'Custom Design',
            'Warranty' => '10 Years'
        ]
    ];
    
    return $specs[$category] ?? ['Material' => 'Premium', 'Warranty' => '10 Years'];
}

// HTML Output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Import - AL TANWEER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #d4af37;
            padding-bottom: 10px;
        }
        h3 {
            color: #555;
            margin-top: 20px;
        }
        .summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .summary h2 {
            margin-top: 0;
            color: #28a745;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        .stat-box {
            background: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            border: 2px solid #ddd;
        }
        .stat-box strong {
            font-size: 24px;
            color: #d4af37;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #d4af37;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #b8941f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🖼️ Image Import Tool - AL TANWEER</h1>
        <p>Importing images from product folders into the database...</p>
        <hr>
        
        <?php
        // Run the import
        $result = importImagesFromFolders($folderMapping, $imageExtensions);
        ?>
        
        <div class="summary">
            <h2>Import Summary</h2>
            <div class="stats">
                <div class="stat-box">
                    <div>Imported</div>
                    <strong><?php echo $result['imported']; ?></strong>
                </div>
                <div class="stat-box">
                    <div>Skipped</div>
                    <strong><?php echo $result['skipped']; ?></strong>
                </div>
                <div class="stat-box">
                    <div>Errors</div>
                    <strong><?php echo count($result['errors']); ?></strong>
                </div>
            </div>
        </div>
        
        <?php if (!empty($result['errors'])): ?>
            <h3>Errors:</h3>
            <?php foreach ($result['errors'] as $error): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <a href="products.php" class="btn">View Products</a>
        <a href="admin.php" class="btn">Go to Admin</a>
    </div>
</body>
</html>