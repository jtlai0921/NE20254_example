static char *path = NULL; /* 更新static變數 */

static PHP_INI_MH(OnUpdateStatic) {
  if (new_value == NULL) {
    return FAILURE;
  }
  *(char **)mh_arg1 = new_value;
  return SUCCESS;   
}

PHP_INI_BEGIN()
  PHP_INI_ENTRY1("foo.path", NULL, PHP_INI_ALL, OnUpdateStatic, &path)
PHP_INI_END()
