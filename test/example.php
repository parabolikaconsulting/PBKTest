<?php

/*
    Cookies are sent in the header, so they're not visible or accessble until the next page load 
    (ie: refresh if you don't see data)
*/


require('cookie.class.php');

// Sample data
$array = array('foo'=>'bar','bar'=>'foo');
$string = 'this is a string';

$c = new Cookie();

/*  
    Create encrypted cookie with an array 
*/
echo '<h3>Encrypted array</h3>';

$start = microtime(true);

$c->setName('Example') // our cookie name
  ->setValue($array,true)   // second parameter, true, encrypts data
  ->setExpire('+1 hours')   // expires in 1 hour
  ->setPath('/')            // cookie path
  ->setDomain('localhost')  // set for localhost
  ->createCookie();
$cookie = $c->getCookie('Example',true);
$cookie = unserialize($cookie);

$bench = sprintf('%.8f',(microtime(true)-$start));

echo print_r($cookie,true).'<br />'.$bench.' seconds<hr />';

/*
    Destroy Example Cookie
    Note: Domain and path may need to be set if they differ from the defaults, 
          but they're already initialized above 
*/
//$c->destroyCookie('Example');


/*  
    Create cookie with a string that expires when the browser closes (default)
*/
echo '<h3>Regular unencrypted string</h3>';
$start = microtime(true);
$c->setName('Example1')
  ->setValue($string) // Second param could be set to false here
  ->setExpire(0)
  ->setPath('/')
  ->setDomain('localhost')
  ->createCookie();

$cookie = $c->getCookie('Example1');

$bench = sprintf('%.8f',(microtime(true)-$start));

echo print_r($cookie,true).'<br />'.$bench.' seconds';
