PHP_FUNCTION(sample3) {
    zval *p;
    MAKE_STD_ZVAL(p);                      // 変数コンテナの初期化
    ZVAL_BOOL(p, 1);                       // 論理値TRUE
    ZVAL_FALSE(p);                         // 論理値FALSE
    ZVAL_LONG(p, 10);                      // 整数値5
    ZVAL_DOUBLE(p, 3.14);                  // 実数 3.14
    ZVAL_STRING(p, "Hello, PHP!", 1);      // 文字列(複製)
    ZVAL_STRINGL(p, "Hello, PHP!", 11, 1); // 文字列(長さを指定)
    ZVAL_EMPTY_STRING(p);                  // 空文字列
}
