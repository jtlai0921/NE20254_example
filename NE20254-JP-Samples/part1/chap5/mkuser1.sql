CREATE TABLE auth (
	user_id INTEGER PRIMARY KEY,   -- ユーザID 
	username VARCHAR(50) NOT NULL, -- ユーザ名
	password VARCHAR(50) NOT NULL  -- パスワード
);

INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');
