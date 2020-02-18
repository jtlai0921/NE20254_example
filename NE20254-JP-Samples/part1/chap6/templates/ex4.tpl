{section name=users loop=$cid}
 {$smarty.section.users.rownum},{$cid[users]},{$name[users]}<br />
{sectionelse}
 ループ用配列が定義されていません。
{/section}
{%users.total%}回反復を行いました。