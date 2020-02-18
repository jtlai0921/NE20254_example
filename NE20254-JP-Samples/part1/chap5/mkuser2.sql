INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');
-- グループの定義
CREATE TABLE group_name (
	group_id INTEGER PRIMARY KEY,
	name VARCHAR(20) NOT NULL
);
INSERT INTO group_name VALUES (1, 'manager');
INSERT INTO group_name VALUES (2, 'employee');

-- ユーザが属するグループの定義
CREATE TABLE users_group (
	user_id INTEGER,
	group_id INTEGER
);

-- taro -> manager, jiro -> employee
INSERT INTO users_group VALUES (1,1); 
INSERT INTO users_group VALUES (2,2);

-- エリア名の定義
CREATE TABLE area_name (
	area_id INTEGER PRIMARY KEY,
	name VARCHAR(20) NOT NULL
);
INSERT INTO area_name VALUES (1, 'public');
INSERT INTO area_name VALUES (2, 'private');

-- エリア毎にアクセス可能なグループの定義
CREATE TABLE area (
	area_id INTEGER,
	group_id INTEGER
);

-- employee -> public, manager -> private,public
INSERT INTO area VALUES (1, 2);
INSERT INTO area VALUES (1, 1);
INSERT INTO area VALUES (2, 1);
