CREATE TABLE news (
    title VARCHAR(128) NOT NULL,
    link VARCHAR(128) NOT NULL,
    content VARCHAR(256) NOT NULL,
    date DATE 
);

INSERT INTO news VALUES('PHP 5.0.0RC2公開','http://www.php.net/downloads.php#v5', 
 'OOPを大幅強化したPHP5のリリース候補2版公開', '2004-04-26');
INSERT INTO news VALUES('PHP 4.3.6公開','http://www.php.net/release_4_3_6.php',
 'マルチスレッドに関する不具合を解消したPHP4.3系の新版公開', '2004-04-15');


