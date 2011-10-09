<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	Document   : rss2.php
 *	Created on : 1 mai 2009, 13:03:03
 *	@author Cedric de Saint Leger <c.desaintleger@gmail.com>
 *
 *	Description:
 *      RSS2 driver
 */

class XML_Driver_Result extends XML
{
	public $root_node = 'result';

  protected static function initialize(XML_Meta $meta){}
}