<?php
session_start();
require_once '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $published_date = mysqli_real_escape_string($conn, $_POST['published_date']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    // Handle image upload
    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = 'uploads/' . $new_filename;
        }
    }
    
    $sql = "INSERT INTO news (title, content, published_date, category, image_url, featured) 
            VALUES ('$title', '$content', '$published_date', '$category', '$image_url', $featured)";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Article added successfully!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

// Fetch categories
$categories_sql = "SELECT * FROM categories ORDER BY name";
$categories_result = mysqli_query($conn, $categories_sql);
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

// Fetch recent articles
$recent_articles_sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 5";
$recent_articles_result = mysqli_query($conn, $recent_articles_sql);
$recent_articles = mysqli_fetch_all($recent_articles_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        textarea {
            min-height: 300px;
            resize: vertical;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
                        <span class="text-gray-600">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="../index.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-globe mr-1"></i> View Blog
                        </a>
                        <a href="?logout=1" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto mt-8 px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Add New Article</h2>
                        
                        <?php if (isset($success_message)): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_message)): ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" id="title" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo htmlspecialchars($category['name']); ?>">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea name="content" id="content" required
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="mt-1 block w-full">
                            </div>

                            <div>
                                <label for="published_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                                <input type="datetime-local" name="published_date" id="published_date" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="featured" id="featured"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="featured" class="ml-2 block text-sm text-gray-700">
                                    Feature this article on homepage
                                </label>
                            </div>

                            <div>
                                <button type="submit"
                                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i> Add Article
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Articles</h3>
                        <div class="space-y-4">
                            <?php foreach ($recent_articles as $article): ?>
                                <div class="border-b pb-4 last:border-b-0 last:pb-0">
                                    <h4 class="font-medium text-gray-800"><?php echo htmlspecialchars($article['title']); ?></h4>
                                    <p class="text-sm text-gray-600">
                                        <?php echo date('M j, Y', strtotime($article['published_date'])); ?>
                                    </p>
                                    <div class="mt-2 flex space-x-2">
                                        <a href="edit.php?id=<?php echo $article['id']; ?>" 
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?php echo $article['id']; ?>" 
                                           class="text-red-600 hover:text-red-800 text-sm"
                                           onclick="return confirm('Are you sure you want to delete this article?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set default datetime to now
        document.getElementById('published_date').value = new Date().toISOString().slice(0, 16);
    </script>
</body>
</html> 