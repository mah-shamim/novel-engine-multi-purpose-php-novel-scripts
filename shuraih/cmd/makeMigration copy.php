<?php

class makeMigration
{
    public function handle($arguments) 

    {
        $className = $arguments[0] ?? null;
        $namespace = $arguments[1] ?? 'App';
        $table = $arguments[2] ?? 'table';

        if(!$className) {
            echo "Please provide a Migration name";
            return;
        } 

        $templatePath = __DIR__.'/../99/migration.php';
        $templContent = file_get_contents($templatePath);

        $content = str_replace(['{{className}}', '{{namespace}}', '{{table}}'], [$className, $namespace, $table], $templContent);
        $fileP = __DIR__.'/../../src/Migration/'.$className.'-'.date('d-m-y-H-i-s').'.php';

        if(!file_exists(__DIR__.'/../../src/Migration/')) {
            mkdir(__DIR__.'/../../src/Migration/', 0777, true);
        }

        file_put_contents($fileP, $content);
        echo "Migration '$className' created at $fileP\n";
    }
}