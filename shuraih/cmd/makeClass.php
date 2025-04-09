<?php

class makeClass 
{
    public function handle($arguments) 
    {
        $className = $arguments[0] ?? null;
        $table = $arguments[1] ?? 'table';

        if (!$className) {
            echo "Please provide a class name.\n";
            return;
        }

        // Split the class name into namespace and class parts
        $pathParts = explode('\\', $className);
        $class = array_pop($pathParts);
        $namespace = 'App\\General\\' . implode('\\', $pathParts);

        // Define the template path
        $templatePath = __DIR__ . '/../99/class.php';
        $templContent = file_get_contents($templatePath);

        // Replace placeholders in the template
        $content = str_replace(['{{className}}', '{{namespace}}', '{{table}}'], [$class, $namespace, $table], $templContent);

        // Construct the file path
        $directoryPath = __DIR__ . '/../../src/General/' . implode('/', $pathParts);
        $fileP = $directoryPath . '/' . $class . '.php';

        // Create the directory if it doesn't exist
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Write the class file
        file_put_contents($fileP, $content);
        echo "Class '$className' created at $fileP\n";
    }
}
