<?php

class LayoutPlugin extends Yaf_Plugin_Abstract {
    private $_layoutDir;
    private $_layoutFile;
    private $_layoutVars =array();

    public function __construct($layoutFile, $layoutDir=null){
        $this->_layoutFile = $layoutFile;
        $this->_layoutDir = $layoutDir;
    }

    public function  __set($name, $value) {
        $this->_layoutVars[$name] = $value;
    }

    public function setFile($file){
        $this->_layoutFile = $file;
    }

    public function dispatchLoopShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
    }

    public function dispatchLoopStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
    }

    public function postDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
        if ($this->_layoutFile){
            /* get the body of the response */
            $body = $response->getBody();
            /* wrap it in the layout */
            $layout = new Yaf_View_Simple($this->_layoutDir);
            $layout->assign('content', $body);
            $layout->assign($this->_layoutVars);
            /* set the response to use the wrapped version of the content */
            $response->setBody($layout->render($this->_layoutFile));
        }
    }

    public function preDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function preResponse ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
    }

    public function routerShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
    }

    public function routerStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
    }
}