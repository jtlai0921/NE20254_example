-- shop DB schema for SQLite

CREATE TABLE product (
    id INTEGER PRIMARY KEY,
    name VARCHAR(32) NOT NULL,
    price INTEGER
);

INSERT INTO product VALUES(1,'�ߤ���', 50);
INSERT INTO product VALUES(2,'�Хʥ�', 100);
INSERT INTO product VALUES(3,'���', 200);




