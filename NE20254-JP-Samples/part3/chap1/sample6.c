static zend_class_entry *file_ce;

PHP_MINIT_FUNCTION(foo)
{
  zend_class_entry ce;
  
  INIT_CLASS_ENTRY(ce, "File", NULL);
  file_ce = zend_register_internal_class(&ce TSRMLS_CC);
}
