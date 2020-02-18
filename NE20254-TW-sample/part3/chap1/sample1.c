PHP_FUNCTION(sample1) {
    char *s;
    int s_len;
    long num;
    zval *a;

    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lsa", 
      &num, &s, &s_len, &a) == FAILURE){ // ¼èÆÀÀ°ÚË¡¢»ú¶ú¡¢¿ØÎó
      return;
    } 
    php_printf("%d %s\n", num, s);
}
