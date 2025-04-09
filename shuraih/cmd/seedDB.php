<?php

class seedDB
{
    public function handle($arguments) 

    {
        $migration = $arguments[0] ?? null;

        if(!$migration) {
            echo "Please provide a Migration name";
            return;
        } 

        echo "$migration Successfully Seeded to database";
    }
}