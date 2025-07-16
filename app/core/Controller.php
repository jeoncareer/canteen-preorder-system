<?php

// The Controller class is a base class for all controllers in the application.
// It provides a method to load views and pass data to them.
class Controller
{
    // Loads a view file and extracts data variables for use in the view
    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        // Build the filename for the view
        $filename = "../app/views/" . $name . ".view.php";

        // If the view file exists, require it; otherwise, load the 404 view
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/404.view.php";
        }
    }
}
