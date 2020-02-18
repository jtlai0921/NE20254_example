CREATE TABLE yubin (
        id INTEGER UNSIGNED, -- 全國地方公共團體碼
        old_pid INTEGER UNSIGNED, -- 舊郵遞區號(5碼)
        pid INTEGER UNSIGNED, -- 郵遞區號
        pyomi VARCHAR(20), -- 都道府縣名(讀音)
        ayomi VARCHAR(64), -- 市區鎮村名(讀音)
        yomi VARCHAR(64),  -- 鎮領域名稱(讀音)
        pref VARCHAR(20),  -- 都道府縣名
        city VARCHAR(64),  -- 市區鎮村名
        address VARCHAR(64), -- 里名稱
        nmulti INTEGER UNSIGNED, -- 里內包含數個郵遞區號時為1
        low  INTEGER UNSIGNED, -- 遇到小寫番地就亂掉的里的情形為1
        cyome INTEGER UNSIGNED,    -- 里有鄰的情形為1
        amulti INTEGER UNSIGNED,   -- 1個郵遞區號表示數個里的時候為1
        change INTEGER UNSIGNED,  -- 有無變更
        reason INTEGER UNSIGNED); -- 變更原因

COPY yubin FROM 'all.csv' USING DELIMITERS ',';
