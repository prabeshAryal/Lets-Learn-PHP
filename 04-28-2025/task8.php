<?php
function listFilesAndFolders($directory, $level = 0) {
    if (is_dir($directory)) {
        if ($handle = opendir($directory)) {
            $indentation = str_repeat("&nbsp;", $level * 4);
            echo "<ul>";

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo "<li>" . $indentation . htmlspecialchars($entry) . "</li>";
                    if (is_dir($directory . $entry)) {
                        listFilesAndFolders($directory . $entry . '/', $level + 1);
                    }
                }
            }

            echo "</ul>";
            closedir($handle);
        } else {
            echo "Failed to open the directory.";
        }
    } else {
        echo "Directory '$directory' does not exist.";
    }
}

$directory = 'uploads/';
echo "<h2>Files and Folders in '$directory':</h2>";
listFilesAndFolders($directory);
?>