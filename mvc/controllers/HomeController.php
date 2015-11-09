<?php

class HomeController extends Controller
{
    /**
     *  Include the library that we require for our app.
     */
    public function __construct()
    {
        require ROOT . 'lib/simple_html_dom.php';
    }

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
        // Call the Model
        $render = $this->model('model')->ajax();
        // Check if request is ajax.
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return $this->view('scraped_data', compact('render'));
        }

        return $this->view('parse_url');
    }
}
