<?php

namespace app\core;

use Exception;

class Controller
{
    public $id;
    public $layout;
    public $title;

    function __construct()
    {
        $this->layout = 'main';
        $this->title = 'Сайт';
        $this->beforeAction();
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function beforeAction()
    {

    }


    /**
     * Renders a view and applies layout if available.
     *
     * @param string $view the view name.
     * @param array $params the parameters
     * @throws Exception
     *
     * @return string
     */
    public function render($view, $params = []) {
        $path = "./views/$this->id/$view.php";
        if(!is_readable($path)) {
            throw new Exception("File $path not found");
        }
        return $this->renderPhpFile($path, $params);
    }
    /**
     * Renders a view file as a PHP script.
     *
     * @param string $_file_ the view file.
     * @param array $_params_ the parameters (name-value pairs)
     * @return string
     */
    public function renderPhpFile($_file_, $_params_ = [])
    {
        ob_start();

        ob_implicit_flush(false);

        extract($_params_, 0);
        require($_file_);

        return ob_get_clean();
    }
}