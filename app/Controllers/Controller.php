<?php

namespace Controllers;

use Template\View;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

abstract class Controller
{
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
   * Response object
   */
  public Response $response;

  /**
   * View object
   */
  private View $view;

  /**
   * Constructor
   */
  public function __construct(ServerRequest $request)
  {
    $this->request  = $request;
    $this->response = new Response();
    $this->view     = new View();
    // $this->router   = 
  }

  public function render($template, $data)
  {
    $this->view->process($template, $data);
  }

  public function redirect($route)
  {

  }
}