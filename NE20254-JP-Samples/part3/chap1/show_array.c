PHP_FUNCTION(show_array) {
  unsigned long idx = 0;
  char *key = NULL;
  zval *a, **entry;
  HashTable *hash;

  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "a",&a) == FAILURE) {
    return;
  }

  hash = Z_ARRVAL_P(a); /* ����ʥϥå���ˤ���� */
  zend_hash_internal_pointer_reset(hash); /* ����ݥ��󥿤�ꥻ�å� */
 
  while(zend_hash_get_current_data(hash, (void **)&entry)==SUCCESS) {
    convert_to_string_ex(entry); /* ʸ���󷿤��Ѵ� */
    switch (zend_hash_get_current_key(hash, &key, &idx, 0)) { /* ��������� */
      case HASH_KEY_IS_STRING:  /* Ϣ������ξ�� */
        php_printf("array('%s') = %s\n", key, Z_STRVAL_PP(entry));
        break;
      case HASH_KEY_IS_LONG:  /* �̾������ξ�� */
        php_printf("array(%d) = %s\n", idx, Z_STRVAL_PP(entry));
        break;
	    }
    zend_hash_move_forward(hash); /* ����ݥ��󥿤����˿ʤ�� */
  }
  RETURN_TRUE;
}
