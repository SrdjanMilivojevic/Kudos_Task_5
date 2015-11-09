<?php

class Model
{

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
        if (isset($_POST['url'], $_POST['css']) && $_POST['url'] != '' && $_POST['css'] != '') {
            $url = $_POST['url'];
            $css = $_POST['css'];

            $html = file_get_html($url);

            // If we get the empty array as a result, we can assume
            // that user inputed css selector does not exist
            // on the page, so we need to bail out!
            if ($html->find($css) == []) {
                return '<script>alert("No search rsults found with param: ' . $css . '");</script>';
            }

            $render = '<div class="row" id="innerWrap">';

            foreach ($html->find($css) as $element) {
                $render .= $element->innertext . '<br>';
            }

            $render .= '</div>';

            return $render;
        }

        return null;
    }
}
