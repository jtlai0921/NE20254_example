PHP_FUNCTION(sample3) {
    zval *p;
    MAKE_STD_ZVAL(p);                      // �ѿ�����ƥʤν����
    ZVAL_BOOL(p, 1);                       // ������TRUE
    ZVAL_FALSE(p);                         // ������FALSE
    ZVAL_LONG(p, 10);                      // ������5
    ZVAL_DOUBLE(p, 3.14);                  // �¿� 3.14
    ZVAL_STRING(p, "Hello, PHP!", 1);      // ʸ����(ʣ��)
    ZVAL_STRINGL(p, "Hello, PHP!", 11, 1); // ʸ����(Ĺ�������)
    ZVAL_EMPTY_STRING(p);                  // ��ʸ����
}
