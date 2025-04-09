<?php

class SHURAIH_CMD
{
    public static function run($command, $arguments)
    {
       

        if($command === 'make:class') {
            $commandFile = __DIR__ . '/cmd/makeClass.php';
            $class = "makeClass";
        } else if($command === 'make:middleware') {
            $commandFile = __DIR__.'/cmd/makeMiddleware.php';
            $class = "makeMiddleWare";
        } else if($command === 'make:migration') {
            $class = "makeMigration";
            $commandFile = __DIR__.'/cmd/makeMigration.php';
        }else if($command === "db:seed") {
            $class = "seedDB";
            $commandFile = __DIR__.'/cmd/seedDB.php';
        }

        if(isset($commandFile) && isset($class)) {

            if (file_exists($commandFile)) {
                require_once $commandFile;
                $commandInstance = new $class();
                $commandInstance->handle($arguments);
            } else {
                echo "Command '$command' not found.\n";
            }
        } else {

            echo "Error Command '$command' not found.\n";
        }


    }
}
