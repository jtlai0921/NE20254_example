CREATE TABLE auth (
	user_id INTEGER PRIMARY KEY,   -- �桼��ID 
	username VARCHAR(50) NOT NULL, -- �桼��̾
	password VARCHAR(50) NOT NULL  -- �ѥ����
);

INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');
