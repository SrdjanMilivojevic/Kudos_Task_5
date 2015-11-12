<?php

class HomeController extends Controller
{
    /**
     * Just a test
     * @return view
     */
    public function index()
    {
        // $data['var'] = $this->model('model')->index('RADI !');
        // return $this->view('test', $data);
    }

    /**
     * If request is ajax returns view containing data string.
     * Otherwise retuns landing page view with form.
     * @return  view
     */
    public function parse()
    {
        // Check if request is ajax.
        if ($this->isAjax()) {

            // Call the Model
            $render = $this->model('model')->ajax();

            return $this->view('scraped_data', compact('render'));
        }

        return $this->view('parse_url');
    }

    /**
     * Checks if request is ajax.
     * @return boolean
     */
    private function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ? true : false;
    }
}
