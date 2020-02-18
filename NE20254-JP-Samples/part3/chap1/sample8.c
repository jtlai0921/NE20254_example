static zend_class_entry *file_ce;

PHP_MINIT_FUNCTION(foo)
{
  zend_class_entry ce;
  
  exception_ce = zend_register_internal_class_ex(&ce, NULL, "exception" TSRMLS_CC);
}
