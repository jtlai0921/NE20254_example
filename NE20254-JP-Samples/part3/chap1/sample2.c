PHP_FUNCTION(sample1) {
    long num;
    char *s;
    int s_len;

    if (zend_parse_parameters_ex(ZEND_PARSE_PARAMS_QUIET, ZEND_NUM_ARGS()
                                 TSRMLS_CC, "l", &num) == SUCCESS){
        php_printf("(int) %d\n", num);
    } else if (zend_parse_parameters_ex(ZEND_PARSE_PARAMS_QUIET, ZEND_NUM_ARGS()
                                 TSRMLS_CC, "s", &s, &s_len) == SUCCESS){
        php_printf("(string) %s\n", s);
    } else {
        php_printf("(unknown)\n");        
    }
}
