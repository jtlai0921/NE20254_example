CREATE TABLE auth (
	user_id INTEGER PRIMARY KEY,   -- �ϥΪ�ID
	username VARCHAR(50) NOT NULL, -- �ϥΪ̦W��
	password VARCHAR(50) NOT NULL  -- �K�X
);

INSERT INTO auth VALUES (1,'taro','secret'); 
INSERT INTO auth VALUES (2,'jiro','secret');
