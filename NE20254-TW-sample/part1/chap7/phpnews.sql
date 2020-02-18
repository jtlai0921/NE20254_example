CREATE TABLE news (
    title VARCHAR(128) NOT NULL,
    link VARCHAR(128) NOT NULL,
    content VARCHAR(256) NOT NULL,
    date DATE 
);

INSERT INTO news VALUES('PHP 5.0.0RC2 公開','http://www.php.net/downloads.php#v5', 
 '已公開大幅強化 OOP 功能的 PHP5 釋出候補第二版', '2004-04-26');
INSERT INTO news VALUES('PHP 4.3.6 公開','http://www.php.net/release_4_3_6.php',
 '已公開 PHP 4.3 系解決多執行緒相關問題的新版本', '2004-04-15');
