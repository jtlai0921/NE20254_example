CREATE TABLE auth (
	user_id INTEGER PRIMARY KEY,   -- 使用者ID
	username VARCHAR(50) NOT NULL, -- 使用者名稱
	password VARCHAR(50) NOT NULL  -- 密碼
);

INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');
