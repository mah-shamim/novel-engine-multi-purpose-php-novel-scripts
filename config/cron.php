<?php

require_once('init.php');

$db =  new App\General\DB();


$rows = $db->table('subscriptions')
            ->where('status', 1)
            ->where('days', '0', '>')
            ->get();

if($rows) {
    foreach($rows as $item) {
        
        $days = $item['days'] - 1;
        
        $db->table('subscriptions')->where('id', $item['id'])->update(['days' => $days]);
        
    }
} else {
    
}

$db->table('subscriptions')->where('days', '1', '<')->update(['status' => 2]);