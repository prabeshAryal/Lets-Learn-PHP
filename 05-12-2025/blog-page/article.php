<?php
require_once 'config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Update view count
mysqli_query($conn, "UPDATE news SET views = views + 1 WHERE id = $id");

// Fetch article
$sql = "SELECT * FROM news WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$article = mysqli_fetch_assoc($result);
$date = new DateTime($article['published_date']);
$formatted_date = $date->format('F j, Y');

// Fetch related articles
$related_sql = "SELECT * FROM news WHERE category = '{$article['category']}' AND id != $id ORDER BY published_date DESC LIMIT 3";
$related_result = mysqli_query($conn, $related_sql);
$related_articles = mysqli_fetch_all($related_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .article-content {
            line-height: 1.8;
        }
        .article-content p {
            margin-bottom: 1.5rem;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-800">Prabesh Aryal's Blog</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="index.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                        <a href="admin/login.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-user-shield mr-1"></i> Admin
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Article Content -->
        <div class="max-w-4xl mx-auto mt-8 px-4">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if (!empty($article['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($article['image_url']); ?>" 
                         alt="<?php echo htmlspecialchars($article['title']); ?>"
                         class="w-full h-96 object-cover">
                <?php endif; ?>
                
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-blue-600"><?php echo htmlspecialchars($article['category']); ?></span>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span><i class="far fa-calendar mr-1"></i> <?php echo $formatted_date; ?></span>
                            <span><i class="far fa-eye mr-1"></i> <?php echo $article['views']; ?> views</span>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-800 mb-6"><?php echo htmlspecialchars($article['title']); ?></h1>
                    
                    <div class="article-content prose max-w-none">
                        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            <?php if (!empty($related_articles)): ?>
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($related_articles as $related): 
                        $related_date = new DateTime($related['published_date']);
                        $related_formatted_date = $related_date->format('F j, Y');
                    ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <?php if (!empty($related['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($related['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($related['title']); ?>"
                                 class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                <?php echo htmlspecialchars($related['title']); ?>
                            </h3>
                            <p class="text-sm text-gray-500 mb-2"><?php echo $related_formatted_date; ?></p>
                            <a href="article.php?id=<?php echo $related['id']; ?>" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                Read More <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <footer class="bg-white shadow-lg mt-12">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="text-center text-gray-600">
                    <p>&copy; <?php echo date('Y'); ?> Prabesh Aryal - Baku Engineering University</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html> 