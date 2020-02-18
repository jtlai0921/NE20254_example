dnl $Id$
dnl config.m4 for extension foo

dnl Comments in this file start with the string 'dnl'.
dnl Remove where necessary. This file will not work
dnl without editing.

dnl If your extension references something external, use with:

dnl PHP_ARG_WITH(foo, for foo support,
dnl Make sure that the comment is aligned:
dnl [  --with-foo             Include foo support])

dnl Otherwise use enable:

dnl PHP_ARG_ENABLE(foo, whether to enable foo support,
dnl Make sure that the comment is aligned:
dnl [  --enable-foo           Enable foo support])

if test "$PHP_FOO" != "no"; then
  dnl Write more examples of tests here...

  dnl # --with-foo -> check with-path
  dnl SEARCH_PATH="/usr/local /usr"     # you might want to change this
  dnl SEARCH_FOR="/include/foo.h"  # you most likely want to change this
  dnl if test -r $PHP_FOO/$SEARCH_FOR; then # path given as parameter
  dnl   FOO_DIR=$PHP_FOO
  dnl else # search default path list
  dnl   AC_MSG_CHECKING([for foo files in default path])
  dnl   for i in $SEARCH_PATH ; do
  dnl     if test -r $i/$SEARCH_FOR; then
  dnl       FOO_DIR=$i
  dnl       AC_MSG_RESULT(found in $i)
  dnl     fi
  dnl   done
  dnl fi
  dnl
  dnl if test -z "$FOO_DIR"; then
  dnl   AC_MSG_RESULT([not found])
  dnl   AC_MSG_ERROR([Please reinstall the foo distribution])
  dnl fi

  dnl # --with-foo -> add include path
  dnl PHP_ADD_INCLUDE($FOO_DIR/include)

  dnl # --with-foo -> check for lib and symbol presence
  dnl LIBNAME=foo # you may want to change this
  dnl LIBSYMBOL=foo # you most likely want to change this 

  dnl PHP_CHECK_LIBRARY($LIBNAME,$LIBSYMBOL,
  dnl [
  dnl   PHP_ADD_LIBRARY_WITH_PATH($LIBNAME, $FOO_DIR/lib, FOO_SHARED_LIBADD)
  dnl   AC_DEFINE(HAVE_FOOLIB,1,[ ])
  dnl ],[
  dnl   AC_MSG_ERROR([wrong foo lib version or lib not found])
  dnl ],[
  dnl   -L$FOO_DIR/lib -lm -ldl
  dnl ])
  dnl
  dnl PHP_SUBST(FOO_SHARED_LIBADD)

  PHP_NEW_EXTENSION(foo, foo.c, $ext_shared)
fi
