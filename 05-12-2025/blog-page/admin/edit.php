<?php
session_start();
require_once '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $published_date = mysqli_real_escape_string($conn, $_POST['published_date']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    // Handle image upload
    $image_url = $_POST['current_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Delete old image if exists
            if (!empty($_POST['current_image']) && file_exists("../" . $_POST['current_image'])) {
                unlink("../" . $_POST['current_image']);
            }
            $image_url = 'uploads/' . $new_filename;
        }
    }
    
    $sql = "UPDATE news SET 
            title = '$title',
            content = '$content',
            published_date = '$published_date',
            category = '$category',
            image_url = '$image_url',
            featured = $featured
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Article updated successfully!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

// Fetch article data
$sql = "SELECT * FROM news WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$article = mysqli_fetch_assoc($result);

// Fetch categories
$categories_sql = "SELECT * FROM categories ORDER BY name";
$categories_result = mysqli_query($conn, $categories_sql);
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article - Admin Panel</title>
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
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-800">Edit Article</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="index.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Admin Panel
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto mt-8 px-4">
            <div class="bg-white rounded-lg shadow-md p-6">
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
                    <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($article['image_url']); ?>">
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required
                               value="<?php echo htmlspecialchars($article['title']); ?>"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category['name']); ?>"
                                        <?php echo $category['name'] === $article['category'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" id="content" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?php echo htmlspecialchars($article['content']); ?></textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                        <?php if (!empty($article['image_url'])): ?>
                            <div class="mt-2 mb-4">
                                <img src="../<?php echo htmlspecialchars($article['image_url']); ?>" 
                                     alt="Current featured image" 
                                     class="h-32 w-auto object-cover rounded">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="mt-1 block w-full">
                        <p class="mt-1 text-sm text-gray-500">Leave empty to keep current image</p>
                    </div>

                    <div>
                        <label for="published_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                        <input type="datetime-local" name="published_date" id="published_date" required
                               value="<?php echo date('Y-m-d\TH:i', strtotime($article['published_date'])); ?>"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured"
                               <?php echo $article['featured'] ? 'checked' : ''; ?>
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 block text-sm text-gray-700">
                            Feature this article on homepage
                        </label>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                                class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                        <a href="index.php"
                           class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 