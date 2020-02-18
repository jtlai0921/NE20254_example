<?php
//   Directory File List Class
//	sort items in name, mtime or size order by specification.
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//		Sun Sep 15 22:30:09 JST 2002
//
// 2003-07-20 JuK eliminate blank line outside of php tag.
// 2002-06-26 JuK add dir_file_list
//
class DirFileList
{
  var $gdate;
  var $path;
  var $items;	// array
  var $size;	// array
  var $mtime;	// array
  var $type;	// array
  var $order;	// array
  var $num;

  function DirFileList ($dir_path)
  {
    $this->order = "ASC";	// or "DESC"
    $this->gdate = date("Y-m-d");
    $this->path = $dir_path;
    $this->items = array();
    $this->type = array();
    $d = dir("$dir_path");
    $n = 0;
    while($entry=$d->read()) {
      //if ( is_file("$dir_path/$entry") ) {
      if ( $entry != '.' && $entry != '..' ) {
	$this->items[] = "$entry";
	$this->size[$entry] = filesize("$dir_path/$entry");
	$this->mtime[$entry] = filemtime("$dir_path/$entry");
	$this->type[$entry] = filetype("$dir_path/$entry");
	$n++;
      }
      //}
    }
    $d->close();
    $this->num = $n;
  }

  function get_num ()
  {
    return $this->num;
  }

  function set_order ( $scend )
  {
    $sc = strtolower(substr(ltrim($scend), 0, 1));
    switch ($sc) {
    case 'd':
      $this->order = "DESC";
      break;
    case 'a':
    default:
      $this->order = "ASC";
      break;
    }
  }

  function set_order_by ($bym)
  {
    $by = strtolower(substr(ltrim($bym), 0, 2));
    switch ($by) {
    case 'mt':
      $this->order_by = "mtime";
      break;
    case 'si':
      $this->order_by = "size";
      break;
    case 'na':
    default:
      $this->order_by = "name";
      break;
    }
  }

  function sort_items ()
  {
    if ($this->order == "DESC") {
      $sortfunc = "arsort";
    } else {
      $sortfunc = "asort";
    }
    switch ($this->order_by) {
    case "mtime":
	$sortfunc($this->mtime, SORT_NUMERIC);
	reset($this->mtime);
	$this->items = array();
	while (list ($key, $val) = each ($this->mtime)) {
	  $this->items[] = $key;
	}
	reset($this->mtime);
	reset($this->items);
      break;
    case "size":
	$sortfunc($this->size, SORT_NUMERIC);
	reset($this->size);
	$this->items = array();
	while (list ($key, $val) = each ($this->size)) {
	  $this->items[] = $key;
	}
	reset($this->size);
	reset($this->items);
      break;
    case "type":
	$sortfunc($this->type, SORT_STRING);
	reset($this->type);
	$this->items = array();
	while (list ($key, $val) = each ($this->type)) {
	  $this->items[] = $key;
	}
	reset($this->type);
	reset($this->items);
      break;
    case "name":
    default:
	$sortfunc($this->items, SORT_STRING);
	reset($this->items);
      break;
    }
  }

  function current_item ()
  {
    return current($this->items);
  }
  function key_item ()
  {
    return key($this->items);
  }
  function next_item ()
  {
    return next($this->items);
  }
  function previous_item ()
  {
    return previous($this->items);
  }
  function end_item ()
  {
    return end($this->items);
  }
  function reset_item ()
  {
    return reset($this->items);
  }

  function last_item ()
  {
    return $this->end_item();
  }
  function first_item ()
  {
    return $this->reset_item();
  }

  function count_item ()
  {
    return count($this->items);
  }

  function print_items ()
  {
    echo "items($this->gdate)<br>";
    // var_dump($this->items);
    while (list ($key, $val) = each ($this->items)) {
      echo "$key, $val<br>";
    }
  }

  function print_mtime ()
  {
    echo "mtime($this->gdate)<br>";
    //var_dump($this->items);
    while (list ($key, $val) = each ($this->mtime)) {
      echo "$key, $val<br>";
    }
  }

  function print_type ()
  {
    echo "type($this->gdate)<br>";
    //var_dump($this->items);
    while (list ($key, $val) = each ($this->type)) {
      echo "$key, $val<br>";
    }
  }

  function print_size ()
  {
    echo "size($this->gdate)<br>";
    //var_dump($this->items);
    while (list ($key, $val) = each ($this->size)) {
      echo "$key, $val<br>";
    }
  }
}

// sample function to use DirFileList
function dir_file_list ( $dir, $sort="name", $cend="ascend", $selection="type=file" )
{
	$dfl = new DirFileList ($dir);
	if ( $dfl->get_num() < 1) {
		return '';
	}

	switch ($sort) {
	default:
	case 'name':
		$dfl->set_order_by("name");
		break;
	case 'size':
		$dfl->set_order_by("size");
		break;
	case 'mtime':
		$dfl->set_order_by("mtime");
		break;
	}
	switch ($cend) {
	default:
	case 'asc':
	case 'ascend':
		$dfl->set_order("ascend");
		break;
	case 'desc':
	case 'descend':
		$dfl->set_order("descend");
		break;
	}
	$dfl->sort_items();
	//$dfl->print_items();
	//$dfl->print_mtime();

	// Not Yet
	if (! empty($selection) ) {
		$buf = preg_split( '/[<=>]/', $selection, 2 );
		$op = trim(substr($selection, strlen($buf[0]), 1));
		if ( "$op" == "=" ) {
			$op = "==";
		}
		$key = trim($buf[0]);
		if ( $key == 'size' || $key == 'mtime' || $key == 'type' ) {
			$cond = trim($buf[1]);
		} else {
			$key = '';
		}
	}

	if ( (!empty($key)) && (!empty($cond)) ) {
		$condition = "if (\$$key $op '$cond') {\$ic = true;} else {\$ic = false;}";
	} else {
		$condition = "\$ic = true;";
	}

	$file_list = array();
	$val = $dfl->reset_item();
	do {
		$size = $dfl->size[$val];
		$mtime = $dfl->mtime[$val];
		$type = $dfl->type[$val];
		eval($condition);
		if ( $ic ) {
			$file_list[$val] = array( "size" => $dfl->size[$val],
						  "mtime" => $dfl->mtime[$val],
						  "type" => $dfl->type[$val]
						  );
		}
	} while ( $val = $dfl->next_item() );

	return $file_list;
}
?>
<?php
// The followngs are the test statements.
$TEST=0;
if ($TEST) {
$original_directory=".";
echo "////////// directory: ".$original_directory." ////////////////////";
$file_list = new DirFileList ("$original_directory");
echo "<br>file size list:<br>";
$file_list->print_size();
echo "<br>sort by size:<br>";
$file_list->set_order_by("size");
$file_list->sort_items();
$file_list->print_items();
echo "<br>file mtime list:<br>";
$file_list->print_mtime();
echo "<br>sort by mtime in descendant order:<br>";
$file_list->set_order_by("mtime");
$file_list->set_order("descend");
$file_list->sort_items();
//var_dump($file_list->items);
$file_list->reset_item();
echo "<table>";
while ($val = $file_list->current_item()) {
  echo "<tr><td>$val</td>";
  echo "    <td align=right>{$file_list->size[$val]}</td>";
  echo "    <td>{$file_list->mtime[$val]}</td>";
  echo "    <td>{$file_list->type[$val]}</td>  </tr>";
  $file_list->next_item();
}
echo "</table>";
echo "<br>sort by name:<br>";
$file_list->set_order_by("name");
$file_list->set_order("ascend");
$file_list->sort_items();
$file_list->print_items();
}
?>
