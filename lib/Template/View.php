<?php

namespace Template;

use Helpers\Flash;
use Helpers\PathHelper;
use Exception\ViewNotFoundException;

class View
{
  use PathHelper, Flash;

  /**
   * View data
   */
  protected array $data;

  /**
   * Output buffering str
   */
  protected string $obStr;

  /**
   * Template path
   */
  public string $template;

  /**
   * Checker for the layout
   */
  protected bool $hasLayout = true;

  /**
   * Layout template path
   */
  protected string $layout = 'layouts/layout.php';

  /**
   * Main function called by controller to render
   * the view with data
   * 
   * @param String $template
   * @param array $data
   * 
   * @return string
   */
  public function process(string $template, array $data)
  {
    $this->template = $template;

    $templatePath = $this->getTemplatePath() . $this->template . '.php';

    if ($this->hasLayout) {
      $layoutPath = $this->getTemplatePath() . $this->layout;

      if (!file_exists($layoutPath)) {
        throw new ViewNotFoundException('Layout ' . $layoutPath . ' does not exist!');
      }
    }

    if (!file_exists($templatePath)) {
      throw new ViewNotFoundException('View ' . $templatePath . ' does not exist!');
    }

    if (!empty($data)) {
      foreach ($data as $k => $v) {
        $this->data[$k] = $v;
      }
    }

    return $this->render($this->hasLayout ? $layoutPath : $templatePath);
  }

  /**
   * Actual renderer
   * 
   * @param string $template
   * @return string
   */
  private function render($template)
  {
    ob_start();

    require $template;
    $str = ob_get_contents();

    ob_end_clean();

    return $str;
  }

  /**
   * Loader for additional views
   */
  public function load(string $template)
  {
    return $this->render($this->getTemplatePath() . $template . '.php');
  }

  /**
   * Changes default layout template
   * 
   * @param string $template
   */
  public function setLayout(string $template)
  {
    $this->layout = $template;
  }

  /**
   * Disables layout and renders the view instead
   */
  public function disableLayout()
  {
    $this->hasLayout = false;
  }
}
