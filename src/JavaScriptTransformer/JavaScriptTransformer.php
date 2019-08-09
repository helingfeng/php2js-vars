<?php

namespace JavaScriptTransformer;

use Exception;
use JavaScriptTransformer\Transformers\ArrayTransformer;
use JavaScriptTransformer\Transformers\BooleanTransformer;
use JavaScriptTransformer\Transformers\NullTransformer;
use JavaScriptTransformer\Transformers\NumericTransformer;
use JavaScriptTransformer\Transformers\ObjectTransformer;
use JavaScriptTransformer\Transformers\StringTransformer;

class JavaScriptTransformer
{
    /**
     * The namespace to nest JS variables under.
     *
     * @var string
     */
    protected $namespace;

    protected $includeScriptTag = false;

    /**
     * All transformable types.
     *
     * @var array
     */
    protected $transformers = [
        StringTransformer::class,
        ArrayTransformer::class,
        ObjectTransformer::class,
        NumericTransformer::class,
        BooleanTransformer::class,
        NullTransformer::class,
    ];

    /**
     * Create a new JS transformer instance.
     *
     * @param string $namespace
     */
    public function __construct($namespace = 'window')
    {
        $this->namespace = $namespace;
    }

    /**
     * Set Js Namespace
     */
    public function setNamespace($namespace = 'window')
    {
        $this->namespace = $namespace;
        return $this;
    }

    /** 
     *  include script tag
     */
    public function includeScript()
    {
        $this->includeScriptTag = true;
        return $this;
    }

    /**
     * Bind the given array of variables to the view.
     */
    public function put()
    {
        $javascript = $this->constructJavaScript(
            $this->normalizeInput(func_get_args())
        );
        if ($this->includeScriptTag) {
            $javascript = $this->html($javascript);
        }
        return $javascript;
    }

    /**
     * Translate the array of PHP variables to a JavaScript syntax.
     *
     * @param  array $variables
     * @return array
     */
    public function constructJavaScript($variables)
    {
        $js = $this->constructNamespace();

        foreach ($variables as $name => $value) {
            $js .= $this->initializeVariable($name, $value);
        }

        return $js;
    }

    /**
     * Create the namespace to which all vars are nested.
     *
     * @return string
     */
    protected function constructNamespace()
    {
        if ($this->namespace == 'window') {
            return '';
        }

        return "window.{$this->namespace} = window.{$this->namespace} || {};";
    }

    /**
     * Translate a single PHP var to JS.
     *
     * @param  string $key
     * @param  string $value
     * @return string
     */
    protected function initializeVariable($key, $value)
    {
        return "{$this->namespace}.{$key} = {$this->convertToJavaScript($value)};";
    }

    /**
     * Format a value for JavaScript.
     *
     * @param  string $value
     * @throws Exception
     * @return string
     */
    protected function convertToJavaScript($value)
    {
        foreach ($this->transformers as $transformer) {
            $js = (new $transformer)->transform($value);

            if (!is_null($js)) {
                return $js;
            }
        }
    }

    /**
     * Normalize the input arguments.
     *
     * @param  mixed $arguments
     * @return array
     * @throws \Exception
     */
    protected function normalizeInput($arguments)
    {
        if (is_array($arguments[0])) {
            return $arguments[0];
        }

        if (count($arguments) == 2) {
            return [$arguments[0] => $arguments[1]];
        }

        throw new Exception('Try put(["name" => "helingfeng"])');
    }

    /**
     * @param $script
     * @return string
     */
    public function html($script)
    {
        return <<<EOT
<script>
    $script
</script>
EOT;
    }
}
