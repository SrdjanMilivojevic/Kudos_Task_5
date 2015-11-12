<?php

class Model
{

    /**
     *  Include the library that we require for our app.
     */
    public function __construct()
    {
        require ROOT . 'lib/simple_html_dom.php';
    }

    public function test($string)
    {
        return $string;
    }

    /**
     * Renders a string for a ajax requuest, by given params.
     * If POST gloval variable is not set, returns null instead.
     *
     * @return  string|null
     */
    public function ajax()
    {
        if ($_POST['url'] != '' && $_POST['css'] != '') {
            $url = $_POST['url'];
            $css = $_POST['css'];

            $html = file_get_html($url);

            // If we get the empty array as a result, we can assume
            // that user inputed css selector does not exist
            // on the page, so we need to bail out!
            if ($html->find($css) == []) {
                return '<script>alert("No search results found with param: ' . $css . '");</script>';
            }

            $render = '<div class="row" id="innerWrap">';

            foreach ($html->find($css) as $element) {

                $render .= $element->innertext . '<hr>';
            }

            $render .= '</div>';

            return $render;
        }

        return null;
    }
}
