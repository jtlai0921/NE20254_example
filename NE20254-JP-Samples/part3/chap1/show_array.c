PHP_FUNCTION(show_array) {
  unsigned long idx = 0;
  char *key = NULL;
  zval *a, **entry;
  HashTable *hash;

  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "a",&a) == FAILURE) {
    return;
  }

  hash = Z_ARRVAL_P(a); /* 配列（ハッシュ）を取得 */
  zend_hash_internal_pointer_reset(hash); /* 配列ポインタをリセット */
 
  while(zend_hash_get_current_data(hash, (void **)&entry)==SUCCESS) {
    convert_to_string_ex(entry); /* 文字列型に変換 */
    switch (zend_hash_get_current_key(hash, &key, &idx, 0)) { /* キーを取得 */
      case HASH_KEY_IS_STRING:  /* 連想配列の場合 */
        php_printf("array('%s') = %s\n", key, Z_STRVAL_PP(entry));
        break;
      case HASH_KEY_IS_LONG:  /* 通常の配列の場合 */
        php_printf("array(%d) = %s\n", idx, Z_STRVAL_PP(entry));
        break;
	    }
    zend_hash_move_forward(hash); /* 配列ポインタを前に進める */
  }
  RETURN_TRUE;
}
