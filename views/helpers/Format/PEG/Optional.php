<?php
/**
 * @package PEG
 * @author anatoo<anatoo@nequal.jp>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version $Id: Optional.php 655 2009-04-12 07:26:42Z anatoo $
 */

class PEG_Optional implements PEG_IParser
{
    protected $parser;
    function __construct(PEG_IParser $p)
    {
        $this->parser = $p;
    }
    function parse(PEG_IContext $context)
    {
        $offset = $context->tell();
        $result = $this->parser->parse($context);
        if ($result instanceof PEG_Failure) {
            $context->seek($offset);
            return false;
        }
        return $result;
    }
}