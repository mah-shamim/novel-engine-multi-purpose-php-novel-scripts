<?php

class makeMiddleware 
{
    public function handle($arguments) 

    {
        $className = $arguments[0] ?? null;
        $namespace = $arguments[1] ?? 'App';

        if(!$className) {
            echo "Please provide a middleware name";
            return;
        } 

        $templatePath = __DIR__.'/../99/middleware.php';
        $templContent = file_get_contents($templatePath);

        $content = str_replace(['{{className}}', '{{namespace}}'], [$className, $namespace], $templContent);
        $fileP = __DIR__.'/../../src/Middleware/'.$className.'.php';

        if(!file_exists(__DIR__.'/../../src/General/Admin')) {
            mkdir(__DIR__.'/../../src/Middleware/', 0777, true);
        }

        file_put_contents($fileP, $content);
        echo "Class '$className' created at $fileP\n";
    }
}