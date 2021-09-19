<?php

namespace Controllers;

use Template\View;
use Routing\Router;
use GuzzleHttp\Psr7\ServerRequest;
use Helpers\Flash;

abstract class Controller
{
  use Flash;
  /**
   * HTTP header status code.
   *
   * @var int
   */
  protected $statusCode = 200;

  /**
   * Request object
   */
  public ServerRequest $request;

  /**
   * View object
   */
  private View $view;

  /**
   * Router object
   */
  private Router $router;

  /**
   * Constructor
   * 
   * @param ServerRequest $request
   */
  public function __construct(ServerRequest $request)
  {
    $this->request  = $request;
    $this->view     = new View();
    $this->router   = router();
  }

  /**
   * Calls the process method to check params and render the view
   * 
   * @param string $template
   * @param array $data
   */
  public function render(string $template, array $data = [])
  {
    return $this->view->process($template, $data);
  }

  /**
   * Redirect helper to move between routes
   * 
   * @param string $route
   * @param array $params
   */
  public function redirect(string $route, array $params = [])
  {
    return $this->router->redirectTo($route, $params);
  }
  
  /**
   * If default needs to change
   * @param  string $template
   * @return void
   */
  public function setLayout(string $template)
  {
    $this->view->setLayout($template);
  }

  /**
   * Sets the layout to false and renders the view instead
   *
   * @param  mixed $template
   * @return void
   */
  public function disableLayout()
  {
    $this->view->disableLayout();
  }

  /**
   * Sets the active menu in view
   * 
   * @param string $menu
   */
  public function setActiveMenu(string $menu)
  {
    $this->view->setActiveMenu($menu);
  }
}
