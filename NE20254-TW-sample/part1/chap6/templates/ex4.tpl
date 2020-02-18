{section name=users loop=$cid}
 {$smarty.section.users.rownum},{$cid[users]},{$name[users]}<br />
{sectionelse}
 迴圈用陣列尚未定義。
{/section}
進行 {%users.total%} 次迴圈了。
