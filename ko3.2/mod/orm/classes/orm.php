<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
  
  
  private   $_jsoncol  = array();
  protected $_jsoncols = array();

  public function save(Validation $validation = NULL)
  {
    $this->_update_jsoncols();
    return parent::save($validation);
  }

  public function __get($col)
  {
    if ( $this->_is_jsoncol($col) ) return $this->_jsoncol[$col];

    return parent::__get($col);
  }


  public function __set($col, $val)
  {
    if ( $this->_is_jsoncol($col) AND is_array($val) )
    {
      foreach($val as $k => $v) $this->_jsoncol[$col]->$k = $v;
      return 1;
    }

    parent::__set($col, $val);
  }

  private function _is_jsoncol($col)
  {
    if ( array_key_exists($col, $this->_jsoncol) ) return TRUE;
    if ( array_key_exists($col, $this->_jsoncols) )
    {
      $this->_jsoncol[$col] = (object) array_merge(
        (array) $this->_jsoncols[$col], (array) json_decode(parent::__get($col) )
      );
      return TRUE;
    }

    return FALSE;
  }

  private function _update_jsoncols()
  {
    // default değerler kaydolmayacak.
    // Sadece erişilen jsoncol kaydedilir.
    // Yeni kayıtlarda veritabanında alan null olacak fakat çağrıldığında default değerleri döndürür.
    foreach($this->_jsoncol as $col => $obj)
    {
      $this->$col = json_encode($obj);
    }

  }
}
