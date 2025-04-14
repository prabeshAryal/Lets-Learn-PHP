# URL Management Project

## Overview
This project demonstrates how to manage URL parameters and dynamic URLs using PHP. It includes examples of reading URL parameters, building query strings, and encoding URLs.

## Project Structure
```
/url_management_project
    ├── index.php
    ├── view.php
    ├── process.php
    ├── README.md
```

### Files Description
- **index.php**: The main entry point where users can submit their information. It uses a GET method to send data to `view.php`.
- **view.php**: This file processes the URL parameters sent from `index.php`, sanitizes them using `htmlspecialchars()`, and displays the submitted information. It also demonstrates how to build a query string using `http_build_query()` and how to encode a string using `rawurlencode()`.
- **process.php**: This file is an optional demonstration of handling form submissions via POST. It redirects to `view.php` with the parameters.
