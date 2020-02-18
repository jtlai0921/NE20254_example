static int le_file;

function_entry foo_functions[] = {
	PHP_FE(my_fopen,    NULL)
	PHP_FE(my_fputs,    NULL)
	{NULL, NULL, NULL}
};

static void _file_dtor(zend_rsrc_list_entry *rsrc TSRMLS_DC) {
    FILE *fp = (FILE *)rsrc->ptr;
    if (fp) {
        fclose(fp);
    }
}

PHP_MINIT_FUNCTION(foo) {
    le_file = zend_register_list_destructors_ex(_file_dtor, NULL, 
                                                "file", module_number);
    return SUCCESS;
}

PHP_FUNCTION(my_fopen) {
    char *fname, *mode;
    int fname_len, mode_len;
    FILE *fh;
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ss",
               &fname, &fname_len, &mode, &mode_len) == FAILURE) {
        return;
    }
    if(!(fh = VCWD_FOPEN(fname, mode))) {
        RETURN_FALSE;
    }
    ZEND_REGISTER_RESOURCE(return_value, fh, le_file);
}

PHP_FUNCTION(my_fputs) {
    FILE *fh;
    zval *rsrc;
    char *s;
    int s_len;
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "sr", 
          &s, &s_len, &rsrc) == FAILURE) {
        return;
    }
    ZEND_FETCH_RESOURCE(fh, FILE *, &rsrc, -1, "file handle", le_file);    
    fputs(s, fh);
    RETURN_LONG(s_len);
}
