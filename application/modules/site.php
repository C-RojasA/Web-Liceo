<?php 

//require "noticia.php";

class Site {
    

}

class SiteView extends StandardView{

    function home(){
        $html = file_get_contents(DIR_HTML."home.html");
        print $this->render_template($html);   
/*
        $this->template_file = HTML_BASE;
        $tabla = file_get_contents(DIR_HTML ."home.html");
        $form = $this->render_regex("listado", $tabla, $obj);
        print $this->render_template($form,"Listar Noticia");*/
    }

    function careers(){
        $html = file_get_contents(DIR_HTML."careers.html");
        print $this->render_template($html);     
    }

    function we(){
        $html = file_get_contents(DIR_HTML."we.html");
        print $this->render_template($html);     
    }

    function history(){
        $html = file_get_contents(DIR_HTML."history.html");
        print $this->render_template($html);     
    }

    function noticia($noticia = null){        
        $html = file_get_contents(DIR_HTML."noticia.html");function we(){
        $html = file_get_contents(DIR_HTML."we.html");
        print $this->render_template($html);     
    }

        $estatica = $this->render_dict($noticia, $html);
        print $this->render_template($estatica);     
    }
}

class SiteController extends StandardController {

 function home(){
    $this->view->home();
    }
/*
    function home($obj){
    $collector = new collectorObject();
    $collector->get ('noticia'); 
    $this->view->home($collector->collection);
    }
*/
    function careers(){
        $this->view->careers();
    }

     function we(){
        $this->view->we();
    }

     function history(){
        $this->view->history();
    }
/*
    function noticia($id = 0){
        $noticia = new Noticia();
        $noticia->noticia_id = $id;
        $noticia->select();
        $this->view->noticia($noticia);
    }
    
*/
}

 ?>