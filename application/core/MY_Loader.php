<?php

/**
 * Extends the Loader Class
 *
 * Adds functionality that checks if a model is already loaded before loading it.
 *
 * User: godfreymajwega
 * Date: 11/17/16
 * Time: 4:36 PM
 */
class MY_Loader extends CI_Loader {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns true if the model with the given name is loaded; false otherwise.
     *
     * @param   string  name for the model
     * @return  bool
     */
    public function is_model_loaded($name)
    {
        return in_array($name, $this->_ci_models, TRUE);
    }
}