zend_class_entry *file_ce;

static zend_function_entry file_class_functions[] = {
  PHP_ME_MAPPING(__construct, my_fopen, NULL)
  PHP_ME_MAPPING(puts, my_fputs, NULL)
  {NULL, NULL, NULL}
};

PHP_MINIT_FUNCTION(foo) {
  zend_class_entry ce;
  
  le_file = zend_register_list_destructors_ex(_file_dtor, NULL, 
                                              "file", module_number);
  INIT_CLASS_ENTRY(ce, "File", file_class_functions);
  file_ce = zend_register_internal_class(&ce TSRMLS_CC);
  zend_declare_property_null(file_ce, "hnd", strlen("hnd"), ZEND_ACC_PROTECTED TSRMLS_DC);
  return SUCCESS;
}

PHP_FUNCTION(my_fopen) {
  char *fname, *mode;
  int fname_len, mode_len;
  FILE *fh;
  zval *obj = getThis();
  
  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ss",
                  &fname, &fname_len, &mode, &mode_len) == FAILURE) {
    return;
  }
  if(!(fh = VCWD_FOPEN(fname, mode))) {
    RETURN_FALSE;
  }
  if (obj) {
    zval *rsrc;
    rsrc = zend_read_property(Z_OBJCE_P(obj), obj, "hnd", strlen("hnd"), 1 TSRMLS_CC);
    ZEND_REGISTER_RESOURCE(rsrc, fh, le_file);
  } else {
    ZEND_REGISTER_RESOURCE(return_value, fh, le_file);
  }
}

PHP_FUNCTION(my_fputs) {
  FILE *fh;
  zval *rsrc;
  char *s;
  int s_len;
  zval *obj = getThis();
  
  if (obj) {
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &s, &s_len) == FAILURE) {
      return;
    }
    rsrc = zend_read_property(Z_OBJCE_P(obj), obj, "hnd", strlen("hnd"), 1 TSRMLS_CC);
  } else {
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "sr", 
                              &s, &s_len, &rsrc) == FAILURE) {
      return;
    }
  }
  ZEND_FETCH_RESOURCE(fh, FILE *, &rsrc, -1, "file handle", le_file);    
  fputs(s, fh);
  RETURN_LONG(s_len);
}
