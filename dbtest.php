<?php
	include __DIR__."/conf.php";
	include __DIR__."/mysqli.php";
	include __DIR__."/Model.php";

	
	function dumpa($arr)
	{	
		print "<pre>";
		print_r($arr);
		print "</pre>";
	}
	
	function M($table)
	{
		return new Model($table);
	}
		
	$db = M('users');
//	$json = $db->JsonBuilder()->get("users",4);
//	echo $json;

	
	$data =[
		'id'=>'0',
		'username'=>'aracho22',
		'name'=>'lissa'
	];
	
	
 	$u = M('users');
/* 	$newuid = $u->add($data);
	$all = $u->findAll(); */
/* 	dumpa($newuid);
	dumpa($all); */
//	dumpa($u->JsonBuilder()->get('users'),2);
//	$rs = $db->where ("username", NULL, 'IS NOT')->get("users");
	$rs = $u->where("username", NULL, 'IS NOT')->limit(5)->get('id,name');
	dumpa($rs);
	
	$users = $u->queryOne('SELECT * from users where id >= ? and name=? and username=? limit 1', Array(2828,'lissa','aracho22'));
	dumpa($users);
	$rs = $u->queryValue('select count(1) as p  from users where id>? limit 1',Array(2800));
	dumpa($rs);
	
	$page = 12;
	// set page limit to 2 results per page. 20 by default
	$db->pageLimit =12;
	$products = $db->arraybuilder()->paginate("users", $page);
	dumpa($products);
	echo "showing $page out of " . $db->totalPages;



	
/* 	$sql=<<<EOF
		select name,sum(a.result) as "合计总分",                          sum(case when a.subject='语文' then result else null end) as "语文",                          sum(case when a.subject='数学' then result else null end) as "数学",                          sum(case when a.subject='英语' then result else null end) as "英语"              from CJ a             group by name;
EOF;
	$score = $db->query($sql);
	dumpa($score); */

	
	
	
	
	
	
	