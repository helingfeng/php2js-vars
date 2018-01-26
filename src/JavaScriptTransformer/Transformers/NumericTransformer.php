<?php

namespace JavaScriptTransformer\Transformers;

class NumericTransformer
{
    /**
     * Transform a numeric value.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        if (is_numeric($value)) {
            return $value;
        }
    }
}