CREATE TABLE auth (
	user_id INTEGER PRIMARY KEY,   -- 使用者ID
	username VARCHAR(50) NOT NULL, -- 使用者名稱
	password VARCHAR(50) NOT NULL  -- 密碼
);

INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');

-- 群組定義
CREATE TABLE group_name (
	group_id INTEGER PRIMARY KEY,
	name VARCHAR(20) NOT NULL
);
INSERT INTO group_name VALUES (1, 'manager');
INSERT INTO group_name VALUES (2, 'employee');

-- 使用者所屬群組的定義
CREATE TABLE users_group (
	user_id INTEGER,
	group_id INTEGER
);

-- taro -> manager, jiro -> employee
INSERT INTO users_group VALUES (1,1); 
INSERT INTO users_group VALUES (2,2);

-- 區域名稱的定義
CREATE TABLE area_name (
	area_id INTEGER PRIMARY KEY,
	name VARCHAR(20) NOT NULL
);
INSERT INTO area_name VALUES (1, 'public');
INSERT INTO area_name VALUES (2, 'private');

-- 每個區域可存取的群組的定義
CREATE TABLE area (
	area_id INTEGER,
	group_id INTEGER
);

-- employee -> public, manager -> private,public
INSERT INTO area VALUES (1, 2);
INSERT INTO area VALUES (1, 1);
INSERT INTO area VALUES (2, 1);
