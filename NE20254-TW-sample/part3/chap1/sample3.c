PHP_FUNCTION(sample3) {
    zval *p;
    MAKE_STD_ZVAL(p);                      // 變數容器的初始化
    ZVAL_BOOL(p, 1);                       // 邏輯值TRUE
    ZVAL_FALSE(p);                         // 邏輯值FALSE
    ZVAL_LONG(p, 10);                      // 整數值5
    ZVAL_DOUBLE(p, 3.14);                  // 實數3.14
    ZVAL_STRING(p, "Hello, PHP!", 1);      // 字串(複本)
    ZVAL_STRINGL(p, "Hello, PHP!", 11, 1); // 字串(指定長度)
    ZVAL_EMPTY_STRING(p);                  // 空字串
}
