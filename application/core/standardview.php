<?php

class StandardView {
    
    function __construct() {
        $this->template_file = HTML_BASE;
    }
    
    function render_template($contenido,$titulo = '') {        
        $dict = array(            
            '{CONTENIDO}'=>$contenido,
            '{TITULO}'=>$titulo,
            '{USUARIO}'=>$_SESSION['alias']
            );
        $template = file_get_contents($this->template_file);
        print str_replace(array_keys($dict), array_values($dict), $template);
    }
    
    function render_dict($dict, $html) {
        $dict = $this->set_dict($dict);
        return str_replace(array_keys($dict), array_values($dict), $html);
    }
    
    function get_regex($tag, $html) {
        $regex = "/<!--$tag-->(.|\n){1,}<!--$tag-->/";
        $pcre = ini_set("pcre.recursion_limit", 50000);
        preg_match($regex, $html, $match);
        ini_set("pcre.recursion_limit", $pcre);
        return $match[0];
    }
    
    function set_dict($obj) {
        settype($obj, 'array');

        foreach ($obj as $key => $value) {
            if (gettype($obj[$key]) == "object" || 
                 gettype($obj[$key]) == "array") {
                  unset($obj[$key]);
              };
        }

        $comodines = array_keys($obj);
        $valores = array_values($obj);
        foreach($comodines as &$valor) {
            if(is_array($valor)) $valor = print_r($valor, true);
            $valor = "{{$valor}}";
        }
        return array_combine($comodines, $valores);
    }

    function render_regex($tag, $html, $coleccion) {
        $render = '';
        $codigo = $this->get_regex($tag, $html);

        if (isset($coleccion)) {
            foreach($coleccion as $obj) {
            $obj = $this->set_dict($obj);
            $render .= str_replace(array_keys($obj), array_values($obj), $codigo);
            }
        }
        

        $render = str_replace($codigo, $render, $html);
        return str_replace("<!--$tag-->", "", $render);
    }
}

?>