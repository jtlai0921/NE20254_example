CREATE TABLE news (
    title VARCHAR(128) NOT NULL,
    link VARCHAR(128) NOT NULL,
    content VARCHAR(256) NOT NULL,
    date DATE 
);

INSERT INTO news VALUES('PHP 5.0.2公開','http://www.php.net/downloads.php#v5', 'PHP5のバグ修正版公開', '2004-09-23');
INSERT INTO news VALUES('PHP 4.3.9公開','http://www.php.net/release_4_3_9.php', '50件のバグを修正したPHP4.3系の新版公開', '2004-09-22');
INSERT INTO news VALUES('PHP 5.0.1公開','http://www.php.net/downloads.php#v5', 'PHP5のバグ修正版公開', '2004-08-12');
INSERT INTO news VALUES('PHP 5.0.0公開','http://www.php.net/downloads.php#v5', 'PHP5正式リリース版公開', '2004-07-14');
INSERT INTO news VALUES('PHP 4.3.6公開','http://www.php.net/release_4_3_6.php', 'マルチスレッドに関する不具合を解消したPHP4.3系の新版公開', '2004-04-15');


