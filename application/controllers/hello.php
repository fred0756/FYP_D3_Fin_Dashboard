<?php
class Hello extends CI_Controller
{
  public function index()
  {
    echo "Hello, World" . PHP_EOL;
  }

  public function greet($name)
  {
   echo "Hello, $name" . PHP_EOL;
  }
}