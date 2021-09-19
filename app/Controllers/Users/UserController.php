<?php

namespace Controllers\Users;

use Controllers\Controller;
use Models\User;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();

    $this->setActiveMenu('users');

    return $this->render('users/index', ['users' => $users]);
  }

  public function store()
  {
    if ($this->request->getMethod() == 'POST') {
      $data = $this->request->getParsedBody();

      $this->validateUser($data, 'users.store');

      $user = new User();
      $user->name = $data['name'];
      $user->email = $data['email'];
      $user->password = auth()->encryptPassword($data['password']);
      $user->save();

      $this->redirect('users');
    }
    $this->setActiveMenu('users');

    return $this->render('users/new');
  }

  public function update($id)
  {
    $user = User::find($id);

    if ($this->request->getMethod() == 'POST') {
      $data = $this->request->getParsedBody();

      $this->validateUser($data, 'users.update', $id);

      $user->name = $data['name'];
      $user->email = $data['email'];

      if (isset($data['password']) && $data['password'] != '') {
        $user->password = auth()->encryptPassword($data['password']);
      }
      $user->update();

      $this->redirect('users');
    }

    $this->setActiveMenu('users');

    return $this->render('users/edit', ['user' => $user]);
  }

  public function delete($id)
  {
    $user = User::find($id);
    $user->delete();

    $this->redirect('users');
  }

  public function validateUser($data, $route, $id = NULL)
  {
    if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $this->setError($route, 'Invalid email');

      $this->redirect($route, $id ? ['id' => $id] : []);
    }

    if (!$id || $data['password'] != '') {
      if (!isset($data['password']) || strlen($data['password']) < 6) {
        $this->setError('register', 'Password must be at least 6 characters long');

        $this->redirect($route, $id ? ['id' => $id] : []);
      }

      if (!isset($data['confirmed_password']) || $data['password'] != $data['confirmed_password']) {
        $this->setError($route, 'Passwords must match');

        $this->redirect($route, $id ? ['id' => $id] : []);
      }
    }

    if (!isset($data['name']) || $data['name'] == '' || !filter_var($data['name'], FILTER_SANITIZE_STRING)) {
      $this->setError($route, 'Invalid name');

      $this->redirect($route, $id ? ['id' => $id] : []);
    }

    $user = User::where('email', $data['email'])
      ->when($id != NULL, function ($q) use ($id) {
        return $q->where('id', '<>', $id);
      })
      ->first();

    if ($user) {
      $this->setError($route, 'There is already a record with this email in the database');

      $this->redirect($route, $id ? ['id' => $id] : []);
    }
  }
}
