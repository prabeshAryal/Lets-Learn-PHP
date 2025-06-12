<?php
// Function to recursively find all index.php files in subfolders
function findIndexFiles($dir) {
    $files = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($iterator as $file) {
        if ($file->getFilename() === 'index.php') {
            // Exclude the current file itself
            if (realpath($file->getPathname()) !== realpath(__FILE__)) {
                $folderName = basename($file->getPath());
                // Calculate path relative to the current script's directory
                $relativePath = str_replace(
                    str_replace('\\', '/', dirname(__FILE__)),
                    '',
                    str_replace('\\', '/', $file->getPathname())
                );
                // Ensure leading slash for relative path
                if ($relativePath && $relativePath[0] !== '/') {
                    $relativePath = '/' . ltrim($relativePath, '/');
                }
                $files[] = [
                    'folder' => $folderName,
                    'path' => $relativePath
                ];
            }
        }
    }
    return $files;
}

// Get the base directory (project root)
$baseDir = __DIR__; // Use current directory

$indexFiles = findIndexFiles($baseDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index Files Browser</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 24px 18px;
            width: 220px;
            transition: box-shadow 0.2s;
            text-align: center;
        }
        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.16);
        }
        .card-title {
            font-size: 1.2em;
            margin-bottom: 12px;
            color: #333;
        }
        .card-link {
            display: inline-block;
            padding: 8px 16px;
            background: #0078d7;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .card-link:hover {
            background: #005fa3;
        }
        h1 {
            text-align: center;
            color: #222;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Project Index Files</h1>
        <div class="cards">
            <?php if (empty($indexFiles)): ?>
                <p>No index.php files found in subfolders.</p>
            <?php else: ?>
                <?php foreach ($indexFiles as $file): ?>
                    <div class="card">
                        <div class="card-title"><?php echo htmlspecialchars($file['folder']); ?></div>
                        <a class="card-link" href="<?php echo htmlspecialchars($file['path']); ?>" target="_blank">
                            Open index.php
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>