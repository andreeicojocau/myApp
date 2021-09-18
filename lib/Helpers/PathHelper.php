<?php

namespace Helpers;

trait PathHelper
{
  public function getRootDir()
  {
    return __DIR__ . '/../../';
  }

  public function getConfigPath()
  {
    return $this->getRootDir() . 'config' . DIRECTORY_SEPARATOR;
  }

  public function getTemplatePath()
  {
    return $this->getRootDir() . 'templates' . DIRECTORY_SEPARATOR;
  }
}