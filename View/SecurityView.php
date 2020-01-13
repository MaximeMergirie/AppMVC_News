<?php

class SecurityView extends View
{

    /**
     * Ajout du formulaire 
     *
     * @return void
     */
    public function addForm()
    {
        $this->page .= file_get_contents("template/formLogin.html");
        
        $this->displayPage();
    }
    
}
