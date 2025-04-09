<?php

$popularLists = $db->table('ebook')
                   ->orderBy('views', 'DESC')
                   ->where('status', 1)
                   ->limit(5)
                   ->get();

$_cats = $db->table('category as c')
                   ->select(['c.*', '(SELECT COUNT(*) FROM ebook as e WHERE e.cid = c.id) as total_post'])
                   ->where('c.status', 1)
                   ->groupBy('c.id')
                   ->orderBy('c.id', 'DESC')
                   ->get();

$_books = $db->table('book as b')
                   ->select(['b.*', '(SELECT COUNT(*) FROM ebook as e WHERE e.baid = b.id) as total_post'])
                   ->where('b.status', 1)
                   ->groupBy('b.id')
                   ->orderBy('RAND()', '')
                   ->get();

$_authors = $db->table('author as a')
                   ->select([
                    'a.*',
                    "(SELECT COUNT(*) FROM ebook as e WHERE e.author LIKE CONCAT('%', a.name, '%')) as total_post"
                ])
                   ->where('a.status', 1)
                   ->groupBy('a.id')
                   ->orderBy('RAND()', '')
                   ->limit(5)
                   ->get();

$_compilers = $db->table('compiler as c')
                   ->select([
                    'c.*',
                    "(SELECT COUNT(*) FROM ebook as e WHERE e.compiler LIKE CONCAT('%', c.name, '%')) as total_post"
                ])
                   ->where('c.status', 1)
                   ->groupBy('c.id')
                   ->orderBy('RAND()', '')
                   ->limit(5)
                   ->get();

$_groups = $db->table('`groups` as g')
                   ->select([
                    'g.*',
                    "(SELECT COUNT(*) FROM ebook as e WHERE e.groupes LIKE CONCAT('%', g.name, '%')) as total_post"
                ])
                   ->where('g.status', 1)
                   ->groupBy('g.id')
                   ->orderBy('rand', '')
                   ->limit(5)
                   ->get();