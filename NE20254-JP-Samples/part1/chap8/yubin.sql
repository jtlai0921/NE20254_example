CREATE TABLE yubin (
        id INTEGER UNSIGNED, -- ���������������Υ�����
        old_pid INTEGER UNSIGNED, -- ��͹���ֹ�(5��)
        pid INTEGER UNSIGNED, -- ͹���ֹ�
        pyomi VARCHAR(20), -- ��ƻ�ܸ�̾(���)
        ayomi VARCHAR(64), -- �Զ�Į¼̾(���)
        yomi VARCHAR(64),  -- Į��̾(���)
        pref VARCHAR(20),  -- ��ƻ�ܸ�̾
        city VARCHAR(64),  -- �Զ�Į¼̾
        address VARCHAR(64), -- Į��̾
        nmulti INTEGER UNSIGNED, -- ��Į�褬ʣ����͹���ֹ��ɽ��������1
        low  INTEGER UNSIGNED, -- ����������Ϥ��դ��Ƥ���Į��ξ���1
        cyome INTEGER UNSIGNED,    -- ���ܤ�ͭ����Į��ξ���1
        amulti INTEGER UNSIGNED,   -- ��Ĥ�͹���ֹ��ʣ����Į���ɽ������1
        change INTEGER UNSIGNED,  -- �ѹ���̵ͭ
        reason INTEGER UNSIGNED); -- �ѹ���ͳ

COPY yubin FROM 'all.csv' USING DELIMITERS ',';
