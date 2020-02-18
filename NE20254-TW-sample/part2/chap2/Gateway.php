<?php

error_reporting(0);

/*
================================================================================

PHPObject Gateway (for use with PHPObject)
v1.52 (3-October-2005)

Copyright (C) 2003-2005  Sunny Hong | http://ghostwire.com

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

License granted only if full copyright notice retained.

If you have any questions or comments, please visit the forums at:
http://ghostwire.com

================================================================================
*/

class Gateway
{
	var $src;		//object
	var $myObj;		//object
	var $service;	//string
	var $methods;	//array
	var $params;	//array
	var $taskid = 0;	//integer

	function Gateway()
	{
		if ( !$fp = @include("config.php") )
		{
			$this->_doError("Error - Configuration File not found");
		}
		$this->cfg = $cfg;
		if (!empty($GLOBALS['HTTP_RAW_POST_DATA']))
		{
			$this->src = unserialize(utf8_decode(urldecode($GLOBALS['HTTP_RAW_POST_DATA'])));
			$this->src = $this->urldecodeRecursively($this->src);
			$this->init();
		}
	}
	
	function init()
	{
		$CLIENT = (phpversion() <= "4.1.0") ? $HTTP_SERVER_VARS['HTTP_USER_AGENT'] : $_SERVER['HTTP_USER_AGENT'];
		if ($this->cfg['disableStandalone'] && ($CLIENT == "Shockwave Flash"))
		{ // ** standalone player **
			$this->_doError("Error - Standalone Player");
		}
		else
		{
			ob_start();
			$this->_getHeader();
			$this->_unpack($this->src,"myObj");
			if (!isset($this->myObj->classMethods))
			{
				$m = get_class_methods(get_class($this->myObj));
				$m = array_filter($m, "filterPublic");	// ** only allow public methods to be called from Flash **
				$this->classMethods = array_values($m);
			}
			else
			{
				$this->classMethods = $this->myObj->classMethods;
			}
			if ($x = count($this->methods))
			{
				for ($i=0; $i < $x; $i++)
				{
					$this->_execute(((is_integer($this->methods[$i])) ? $this->classMethods[$this->methods[$i]] : $this->methods[$i]), $this->params[$i]);
				}
			}
			else
			{
				// ** initializating - we pick up a list of class methods, to be stored on the client-side **
				$this->myObj->_loader->classMethods = array_change_key_case(array_flip($this->classMethods), CASE_LOWER);
			}
			$output = ob_get_contents();
			if (ob_get_length())
			{
				$this->myObj->_loader->output = $output;
			}
			ob_end_clean();
			$this->_clean();
			$this->_output();
		}
	} 

	// *************************************
	// extracts directives, validates key,
	// validates credentials, starts service
	// *************************************
	function _getHeader()
	{
		$v = $this->src->_data;
		if ($v[4] === $this->cfg['useKey'])
		{
			if ($v[5])
			{
				// ** to use credentials, you need to create your own credentials handler **
				// ** your credentials handler must have a validate method **
				// ** take an array as parameter and return a boolean result **
				// ** WARNING: THIS FEATURE IS NOT FINALISED AND MAY BE CHANGED OR REMOVED IN FUTURE **
				if ( $fp = @include($this->cfg['classdir'][0] . "_Credentials.php") ) // ** always look for this in first classdir **
				{
					$auth = new Credentials();
					if (!$auth->validate($v[5]))
					{
						$this->_doError("Error - Invalid credentials");
					}
				}
				else
				{
					$this->_doError("Error - Credentials Handler not available");
				}
			}
			$this->service = $v[1];
			if (substr($this->service,0,1) == "_")
			{
				$this->_doError("Error - Service '$v[1]' is private");
			}
			elseif (class_exists($this->service))
			{
				$this->_doError("Error - Service '$v[1]' not available - predefined classes cannot be accessed directly");
			}
			else
			{
				// ** files for internal use are named with underscore prefix **
				// ** flash cannot access these private files directly **
				if ( basename($this->service) != $this->service )
				{
					$this->_doError("Error - Service '$v[1]' not available - illegal characters used");
				}
				else
				{
					$k = 0;
					$j = count($this->cfg['classdir']);
					for($i=0;$i<$j;$i++)
					{
						if ( $fp = @include($this->cfg['classdir'][$i].$this->service.".php") )
						{
							$k = 1;
							break;
						}
					}
					if (!$k)
					{
						$this->_doError("Error - Service '$v[1]' not available");
					}
				}
			}
			// ** instantiate the object **
			$svcName=$this->service;
			if (isset($v[8]))
			{
				if (is_array($v[8]))
				{
					$paramCount = count($v[8]);
					switch ($paramCount)
					{
						// ** we support only up to 3 parameters, but you can easily modify the code below **
						case 3:
							$this->myObj	= new $svcName($v[8][0],$v[8][1],$v[8][2]);
							break;
						case 2:
							$this->myObj	= new $svcName($v[8][0],$v[8][1]);
							break;
						case 1:
							$this->myObj	= new $svcName($v[8][0]);
							break;
						default:
							$this->_doError("Invalid number of constructor parameters");
					}
				}
				else
				{
					$this->myObj	= new $svcName($v[8]);
				}
			}
			else
			{
				$this->myObj		= new $svcName;
			}
			
			$this->taskid		= $v[0];
			$this->methods	= $v[2];
			$this->params	= $v[3];
			$this->utf8encode	= isset($v[6]) ? $v[6]	: true;
			$this->blank		= isset($v[7]) ? true	: false;
		}
		else
		{
			$this->_doError("Error - Please provide a valid key");
		}
	}

	// *************************************
	// unpack object properties and populate
	// *************************************
	function _unpack($src,$dest)
	{
		if ( (is_object($src)) || (is_array($src)) )
		{
			foreach($src as $k=>$v)
			{
				if ($k != "_data")
				{
					$this->$dest->$k = $v;
				}
			}
		}
	}

	// *************************************
	// executes requested method
	// *************************************
	// ** thanks to Guido Govers guido_govers@hotmail.com **
	function _execute($m,$p) {
		$m = (phpversion() < "5.0.0") ? strtolower($m) : $m;
		if(!$m)
		{
			return;
		}
		if(in_array($m,$this->classMethods)) 
		{
			// ** execute method **
			$this->myObj->_loader->serverResult =  
			call_user_func_array(array(&$this->myObj, $m), array_reverse($p));
			// ** thanks to Jamie P <jamie@e-gakusei.org> for the above elegant code **
		}
		else 
		{
			$this->_doError("ERROR - Method '$m' does not exist");
		}
	}

	// *************************************
	// reduces return object to contain only
	// properties that have changed
	// *************************************
	function _clean()
	{	
		if ( (is_object($this->src)) || (is_array($this->src)) )
		{
			if ($this->blank)
			{
				$tmp = $this->myObj->_loader;
				unset($this->myObj);
				$this->myObj->_loader = $tmp;
			}
			else
			{
				reset($this->src);
				foreach($this->src as $k=>$v)
				{
					if (isset($this->myObj->$k))
					{
						if ($this->myObj->$k == $v)
						{
							unset($this->myObj->$k);
						}
					}
				}
			}
		}
	}

	// *************************************
	// returns error message to flash
	// *************************************
	function _doError($m)
	{
		$this->myObj->_loader->serverError = "$m\n";
		$this->_output();
	}

	// *************************************
	// returns object to flash mx
	// *************************************
	function _output()
	{
		$t = serialize(($this->cfg['multiByte']) ? $this->urlencodeRecursively($this->myObj) : $this->myObj);
		$t = $this->taskid . ( (!$this->utf8encode) ? $t : utf8_encode($t) );
		header("Content-Length: " . strlen($t));
		exit($t);
	}
	
	// *************************************
	// multibyte support
	// contributed by "Aoki Keigo" <hoyo@sohgoh.net>
	// *************************************
	function urldecodeRecursively($data)
	{
		if (is_array($data))
		{
			$d = Array();
			foreach ($data as $key => $val)
			{
				if ($key != urldecode($key))
				{
					$d[urldecode($key)] = $this->urldecodeRecursively($val);
				}
				else
				{
					$d[$key] = $this->urldecodeRecursively($val);
				}
			}
			return $d;
		}
		elseif (is_object($data))
		{
			$d = new stdClass();
			foreach ($data as $key => $val)
			{
				if ($key != urldecode($key))
				{
					$d->{urldecode($key)} = $this->urldecodeRecursively($val);
				}
				else
				{
					$d->{$key} = $this->urldecodeRecursively($val);
				}
			}
			return $d;
		}
		elseif (is_string($data))
		{
			return ($this->cfg['multiByte']) ? urldecode($data) : $data;
		}
		else
		{
			return $data;
		}
	}

	// *************************************
	// multibyte support
	// contributed by "Aoki Keigo" <hoyo@sohgoh.net>
	// *************************************
	function urlencodeRecursively($data)
	{
		if (is_array($data))
		{
			$d = Array();
			foreach ($data as $key => $val)
			{
				if ($key != urlencode($key))
				{
					$d[urlencode($key)] = $this->urlencodeRecursively($val);
				}
				else
				{
					$d[$key] = $this->urlencodeRecursively($val);
				}
			}
			return $d;
		}
		elseif (is_object($data))
		{
			$d = new stdClass();
			foreach ($data as $key => $val)
			{
				if ($key != urlencode($key))
				{
					$d->{urlencode($key)} = $this->urlencodeRecursively($val);
				}
				else
				{
					$d->{$key} = $this->urlencodeRecursively($val);
				}
			}
			return $d;
		}
		elseif (is_string($data))
		{
			return urlencode($data);
		}
		else
		{
			return $data;
		}
	}

} 


// **************************
// instantiate the gateway
// **************************
$Gateway = new Gateway();


// **************************
// array filtering function
// **************************
function filterPublic($v)
{
	return (substr($v,0,1) != "_");
}
	
?>