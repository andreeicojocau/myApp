<?php

namespace Template;

use Exception\ViewNotFoundException;
use Helpers\PathHelper;

class View
{
  use PathHelper;

  /**
   * View data
   */
  protected array $data;

  /**
   * Main function called by controller to render
   * the view with data
   * 
   * @param String $template
   * @param array $data
   */
  public function process($template, $data)
  {
    $template = $this->getTemplatePath() . $template . '.php';

    if (!file_exists($template)) {
      throw new ViewNotFoundException('View ' . $template . ' does not exist!');
    }

    if (!empty($data)) {
      foreach ($data as $k => $v) {
        $this->data[$k] = $v;
      }
    }

    $this->render($template);
  }

  private function render($template)
  {
    ob_start();

    require $template;
    $str = ob_get_contents();
    ob_end_clean();

    echo $str;
  }
}
