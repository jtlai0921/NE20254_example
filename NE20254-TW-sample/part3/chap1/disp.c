static PHP_INI_DISP(my_disp) {
  char *value;
  TSRMLS_FETCH();
  if (type == PHP_INI_DISPLAY_ORIG && ini_entry->modified) {
    value = ini_entry->orig_value;
  } else if (ini_entry->value) {
    value = ini_entry->value;
  } else {
    value = NULL;
  }
  if (value) {
    php_printf("my_disp:%s", value);        
  }
}

PHP_INI_BEGIN()
  PHP_INI_ENTRY_EX("foo.global_value","42", PHP_INI_ALL, OnUpdateValue, my_disp)
PHP_INI_END()
