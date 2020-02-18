CREATE TABLE yubin (
        id INTEGER UNSIGNED, -- 全国地方公共団体コード
        old_pid INTEGER UNSIGNED, -- 旧郵便番号(5桁)
        pid INTEGER UNSIGNED, -- 郵便番号
        pyomi VARCHAR(20), -- 都道府県名(ヨミ)
        ayomi VARCHAR(64), -- 市区町村名(ヨミ)
        yomi VARCHAR(64),  -- 町域名(ヨミ)
        pref VARCHAR(20),  -- 都道府県名
        city VARCHAR(64),  -- 市区町村名
        address VARCHAR(64), -- 町域名
        nmulti INTEGER UNSIGNED, -- 一町域が複数の郵便番号で表される場合に1
        low  INTEGER UNSIGNED, -- 小字毎に番地がふられている町域の場合に1
        cyome INTEGER UNSIGNED,    -- 丁目を有する町域の場合に1
        amulti INTEGER UNSIGNED,   -- 一つの郵便番号で複数の町域を表す場合に1
        change INTEGER UNSIGNED,  -- 変更の有無
        reason INTEGER UNSIGNED); -- 変更理由

COPY yubin FROM 'all.csv' USING DELIMITERS ',';
