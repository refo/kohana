<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	Document   : rss2.php
 *	Created on : 1 mai 2009, 13:03:03
 *	@author Cedric de Saint Leger <c.desaintleger@gmail.com>
 *
 *	Description:
 *      RSS2 driver
 */

class XML_Driver_Xyz extends XML
{

	public $root_node = 'xyz';
	
	private $info   = NULL;
	private $result = NULL;
  
  protected static function initialize(XML_Meta $meta){}

  

	public function add_result($name, array $value)
	{
		if ( ! $this->result) $this->result = $this->add_node('result');
		
		$this->result->add_node($name, $value);
	}


	public function add_info($name, $value)
	{
		if ( ! $this->info) $this->info = $this->add_node('info');
		$this->info->add_node($name, $value);
	}


	public function render($formatted = FALSE)
	{

		$this->add_info('time', time());
		
		return parent::render($formatted);
	}



}