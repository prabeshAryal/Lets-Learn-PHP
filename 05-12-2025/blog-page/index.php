<?php
require_once 'config/database.php';

// Get current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 6;
$offset = ($page - 1) * $per_page;

// Get category filter
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

// Build query
$where_clause = $category_filter ? "WHERE category = '$category_filter'" : "";
$sql = "SELECT * FROM news $where_clause ORDER BY published_date DESC LIMIT $offset, $per_page";
$result = mysqli_query($conn, $sql);

// Get total articles for pagination
$total_sql = "SELECT COUNT(*) as count FROM news $where_clause";
$total_result = mysqli_query($conn, $total_sql);
$total_articles = mysqli_fetch_assoc($total_result)['count'];
$total_pages = ceil($total_articles / $per_page);

// Get categories for filter
$categories_sql = "SELECT * FROM categories ORDER BY name";
$categories_result = mysqli_query($conn, $categories_sql);
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

// Get featured articles
$featured_sql = "SELECT * FROM news WHERE featured = 1 ORDER BY published_date DESC LIMIT 3";
$featured_result = mysqli_query($conn, $featured_sql);
$featured_articles = mysqli_fetch_all($featured_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prabesh Aryal's Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .featured-article {
            transition: transform 0.3s ease;
        }
        .featured-article:hover {
            transform: scale(1.02);
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
                        <a href="admin/login.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-user-shield mr-1"></i> Admin
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Featured Articles -->
        <?php if (!empty($featured_articles)): ?>
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Featured Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($featured_articles as $article): 
                        $date = new DateTime($article['published_date']);
                        $formatted_date = $date->format('F j, Y');
                    ?>
                    <div class="featured-article bg-white rounded-lg shadow-lg overflow-hidden">
                        <?php if (!empty($article['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($article['title']); ?>"
                                 class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo $formatted_date; ?></p>
                            <p class="text-gray-700 mb-4">
                                <?php 
                                $content = htmlspecialchars($article['content']);
                                echo strlen($content) > 100 ? substr($content, 0, 100) . '...' : $content;
                                ?>
                            </p>
                            <a href="article.php?id=<?php echo $article['id']; ?>" 
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                                Read More
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto mt-12 px-4">
            <!-- Category Filter -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <a href="index.php" 
                       class="px-4 py-2 rounded-full <?php echo !$category_filter ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?>">
                        All
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="?category=<?php echo urlencode($category['name']); ?>" 
                           class="px-4 py-2 rounded-full <?php echo $category_filter === $category['name'] ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($article = mysqli_fetch_assoc($result)) {
                        $date = new DateTime($article['published_date']);
                        $formatted_date = $date->format('F j, Y');
                        ?>
                        <div class="article-card bg-white rounded-lg shadow-md overflow-hidden">
                            <?php if (!empty($article['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($article['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($article['title']); ?>"
                                     class="w-full h-48 object-cover">
                            <?php endif; ?>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-blue-600"><?php echo htmlspecialchars($article['category']); ?></span>
                                    <span class="text-sm text-gray-500"><?php echo $formatted_date; ?></span>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </h2>
                                <p class="text-gray-600 mb-4">
                                    <?php 
                                    $content = htmlspecialchars($article['content']);
                                    echo strlen($content) > 150 ? substr($content, 0, 150) . '...' : $content;
                                    ?>
                                </p>
                                <div class="flex items-center justify-between">
                                    <a href="article.php?id=<?php echo $article['id']; ?>" 
                                       class="text-blue-600 hover:text-blue-800">
                                        Read More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-eye mr-1"></i> <?php echo $article['views']; ?> views
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-span-full text-center text-gray-600 py-12">No articles found.</div>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="mt-12 flex justify-center">
                <div class="flex space-x-2">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?><?php echo $category_filter ? '&category=' . urlencode($category_filter) : ''; ?>" 
                           class="px-4 py-2 bg-white rounded-md shadow-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php echo $category_filter ? '&category=' . urlencode($category_filter) : ''; ?>" 
                           class="px-4 py-2 rounded-md <?php echo $i === $page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?><?php echo $category_filter ? '&category=' . urlencode($category_filter) : ''; ?>" 
                           class="px-4 py-2 bg-white rounded-md shadow-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <footer class="bg-white shadow-lg mt-12">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">About</h3>
                        <p class="text-gray-600">
                            A blog by Prabesh Aryal, Computer Engineering student at Baku Engineering University.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="?category=<?php echo urlencode($category['name']); ?>" 
                                       class="text-gray-600 hover:text-blue-600">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact</h3>
                        <p class="text-gray-600">
                            <i class="fas fa-envelope mr-2"></i> prabesh.aryal@example.com
                        </p>
                        <p class="text-gray-600 mt-2">
                            <i class="fas fa-university mr-2"></i> Baku Engineering University
                        </p>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-200 text-center text-gray-600">
                    <p>&copy; <?php echo date('Y'); ?> Prabesh Aryal. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
