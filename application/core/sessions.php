
<?php  

function check_session($requerid_level='') {

    if(isset($_SESSION['log_st'])) {
        
        if($_SESSION['log_st'] !== True) {
            header("Location: /usuario/login");
        } else {            
            if ($requerid_level < $_SESSION['level']) {
                exit('Permisos insuficientes'); 
            };                                      
        }
    }
    else { header("Location: /usuario/login");}
}

function destroy_session() {
    $_SESSION['log_st'] = False;
    $_SESSION['usuario_id'] = 0;
    $_SESSION['level'] = 0;
}

?>