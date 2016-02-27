<?php
/**
 * Корректор PHP кода
 */
class Corrector
{
	public function correct($data = array())
	{
		array_walk($data, function (&$line) {
            $line = str_replace("\t", str_repeat(' ', 4), $line);
            $line = rtrim($line) . "\n";
            $line = str_replace("if(", "if (", $line);
            $line = str_replace("foreach(", "foreach (", $line);
            $line = str_replace("):", ") :", $line);
            $line = str_replace("else:", "else :", $line);
            $line = str_replace("){", ") {", $line);
            $line = str_replace("( ", "(", $line);
            $line = $this->bracketClose($line);
            $line = $this->classOpen($line);
            $line = $this->functionOpen($line);
            $line = $this->phpOpen($line);
            $line = $this->phpClose($line);
            $line = $this->phpEcho($line);
        });
        return $data;
	}

    private function bracketClose($line)
    {
        if ((')' != substr(ltrim($line), 0, 1))
            && (false !== strpos($line, ' )'))
        ) {
            $line = str_replace(" )", ")", $line);
        }
        return $line;
    }

    private function classOpen($line)
    {
        if ((false !== ($class_pos = strpos($line, 'class')))
            && ('{' ==  substr(rtrim($line), -1))
        ) {
            $space_num = strlen($line) - strlen(ltrim($line));
            $line = rtrim(substr(rtrim($line), 0, -1)) . "\n" . str_repeat(' ', $space_num) . "{\n";
        }
        return $line;
    }

    private function functionOpen($line)
    {
        if ((false !== ($function_pos = strpos($line, 'function')))
            && (false === strpos(str_replace(' ', '', $line), 'function('))
            && ('{' == substr(rtrim($line), -1))
        ) {
            $space_num = strlen($line) - strlen(ltrim($line));
            $line = rtrim(substr(rtrim($line), 0, -1)) . "\n" . str_repeat(' ', $space_num) . "{\n";
        }
        return $line;
    }

    private function phpClose($line)
    {
        if ($pos = strpos($line, '?>')) {
            if (' ' != substr($line, $pos - 1, 1)) {
                $line = substr($line, 0, $pos) . ' ' . substr($line, $pos);
            }
        }
        return $line;
    }

    private function phpOpen($line)
    {
        if (strpos($line, "<?") !== false) {
            $line = str_replace("<? ", "<?php ", $line);
            $line = str_replace("<?/", "<?php /", $line);
            $line = str_replace("<?*", "<?php *", $line);
            $line = str_replace("<?if", "<?php if", $line);
            $line = str_replace("<?else", "<?php else", $line);
            $line = str_replace("<?foreach", "<?php foreach", $line);
            $line = str_replace("<?endif", "<?php endif", $line);
            $line = str_replace("<?endforeach", "<?php endforeach", $line);
        }
        return $line;
    }

    private function phpEcho($line)
    {
        if (false !== ($pos = strpos($line, "<?="))) {
            if (' ' != substr($line, $pos + 3, 1)) {
                $line = substr($line, 0, $pos + 3) . ' ' . substr($line, $pos + 3);
            }
        }
        return $line;
    }
}
