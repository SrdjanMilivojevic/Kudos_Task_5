<?php

abstract class Controller
{
    /**
     * Shows the view
     * @param  string $view [name of the view file]
     * @param  array  $data [vars for the view]
     * @return require
     */
    protected function view($view, $data = [])
    {
        if (!is_null($data)) {
            extract($data);
        }
        unset($data);
        return require_once ROOT . 'mvc/views/' . $view . '.php';
    }
    /**
     * Includes the model class & returns the model object.
     * @param  string $model [model name]
     * @return object        [instanceof $model]
     */
    protected function model($model)
    {
        require_once ROOT . 'mvc/models/' . ucfirst(strtolower($model)) . '.php';
        return new $model;
    }
    /**
     * Redirects to provided url.
     * @param  string $to
     */
    protected function redirect($to = '')
    {
        if ($to === '/' || $to == '') {
            $to = rtrim($_SERVER['PHP_SELF'], 'index.php');
        }
        header("Location: " . $to);
        die;
    }
}
