PHP_FUNCTION(show_array) {
  unsigned long idx = 0;
  char *key = NULL;
  zval *a, **entry;
  HashTable *hash;

  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "a",&a) == FAILURE) {
    return;
  }

  hash = Z_ARRVAL_P(a); /* 取得陣列(雜湊) */
  zend_hash_internal_pointer_reset(hash); /* 重設陣列指標 */

  while(zend_hash_get_current_data(hash, (void **)&entry)==SUCCESS) {
    convert_to_string_ex(entry); /* 變換成字串型別 */
    switch (zend_hash_get_current_key(hash, &key, &idx, 0)) { /* 取得鍵值 */
      case HASH_KEY_IS_STRING:  /* 關聯陣列的情形 */
        php_printf("array('%s') = %s\n", key, Z_STRVAL_PP(entry));
        break;
      case HASH_KEY_IS_LONG:  /* 一般陣列的情形 */
        php_printf("array(%d) = %s\n", idx, Z_STRVAL_PP(entry));
        break;
	    }
    zend_hash_move_forward(hash); /* 將陣列指標往前移動 */
  }
  RETURN_TRUE;
}
