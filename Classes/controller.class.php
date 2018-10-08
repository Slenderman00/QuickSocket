<?php
/*
    "tags" can be added to the views surounding areas in {{}}

    the view is selected by calling the view function feks view("views/home.html")

    tag information is changed by calling the tag function feks tag(tag name, data)

    result can be returned at the end of the php script by calling the returnView function
*/

class Controller {
    protected $data = null;

    public function view($view) {
        $this->data = file_get_contents($view);
    }

    public function tag($name, $tagdata) {
        $this->data = str_replace("{{".$name."}}", $tagdata, $this->data);
    }

    public function returnView() {
        echo $this->data;
    }
}
?>