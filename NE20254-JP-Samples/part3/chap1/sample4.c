PHP_FUNCTION(sample4) {
    int i;
    zval *tmp;

    array_init(return_value);                    // 配列を初期化
    add_index_long(return_value, 0, 123);        // $a[0] = 123
    add_index_string(return_value, 1, "PHP", 1); // $a[1] = "PHP"
    add_assoc_double(return_value, "key", 3.14); // $a['key'] = 3.14

    MAKE_STD_ZVAL(tmp);     // 配列 $a['arr'] = array(1,2)
    array_init(tmp);
    for (i=0; i<2; i++) {
        add_next_index_long(tmp, i+1);
    }
    add_assoc_zval(return_value, "arr", tmp); 
}
