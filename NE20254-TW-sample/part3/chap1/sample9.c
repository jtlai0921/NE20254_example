zend_class_entry  *file_ce;

static zend_function_entry file_class_functions[] = {
  ZEND_ME(file, get, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_FINAL)
  {NULL, NULL, NULL}
};

PHP_MINIT_FUNCTION(foo)
{
  zend_class_entry ce;
  INIT_CLASS_ENTRY(ce, "File", file_class_functions);
  file_ce = zend_register_internal_class(&ce TSRMLS_CC);
  zend_declare_property_string(file_ce, "filename", strlen("filename"),
                               "test.txt", ZEND_ACC_PUBLIC);
  return SUCCESS;
}

PHP_METHOD(file,get)
{
  char *s;
  int s_len;
  zval *obj, *filename = NULL;
  
  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &s, &s_len) == FAILURE) {
    return;
  }
  if (!strncmp(s, "filename", s_len)) {
    obj = getThis();
    filename = zend_read_property(Z_OBJCE_P(obj), obj, "filename", 
                                  strlen("filename"), 1 TSRMLS_CC);
  } else {
    RETURN_FALSE;
  }
  RETURN_STRINGL(Z_STRVAL_P(filename), Z_STRLEN_P(filename), 1);
}
