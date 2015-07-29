<?php

/* macros.twig */
class __TwigTemplate_24ea592c095dbe7db6c23438e5342ceb67e4022a43d42409a3b5c98112c208d0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        echo "
";
        // line 14
        echo "
";
        // line 20
        echo "
";
        // line 26
        echo "
";
        // line 40
        echo "
";
        // line 46
        echo "
";
        // line 50
        echo "
";
        // line 62
        echo "
";
        // line 81
        echo "
";
    }

    // line 1
    public function getnamespace_link($__namespace__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace")), "html", null, true);
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 5
    public function getclass_link($__class__ = null, $__absolute__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 6
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "projectclass", array())) {
                // line 7
                echo "<a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForClass($context, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class"))), "html", null, true);
                echo "\">";
            } elseif ($this->getAttribute(            // line 8
(isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "phpclass", array())) {
                // line 9
                echo "<a target=\"_blank\" href=\"http://php.net/";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
                echo "\">";
            }
            // line 11
            echo $this->getAttribute($this, "abbr_class", array(0 => (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), 1 => ((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) ? $context["absolute"] : $this->getContext($context, "absolute")), false)) : (false))), "method");
            // line 12
            if (($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "projectclass", array()) || $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "phpclass", array()))) {
                echo "</a>";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 15
    public function getmethod_link($__method__ = null, $__absolute__ = null, $__classonly__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForMethod($context, (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method"))), "html", null, true);
            echo "\">";
            // line 17
            echo $this->getAttribute($this, "abbr_class", array(0 => $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "class", array())), "method");
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) ? $context["classonly"] : $this->getContext($context, "classonly")), false)) : (false))) {
                echo "::";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "name", array()), "html", null, true);
            }
            // line 18
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 21
    public function getproperty_link($__property__ = null, $__absolute__ = null, $__classonly__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "property" => $__property__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 22
            echo "<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForProperty($context, (isset($context["property"]) ? $context["property"] : $this->getContext($context, "property"))), "html", null, true);
            echo "\">";
            // line 23
            echo $this->getAttribute($this, "abbr_class", array(0 => $this->getAttribute((isset($context["property"]) ? $context["property"] : $this->getContext($context, "property")), "class", array())), "method");
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) ? $context["classonly"] : $this->getContext($context, "classonly")), true)) : (true))) {
                echo "#";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["property"]) ? $context["property"] : $this->getContext($context, "property")), "name", array()), "html", null, true);
            }
            // line 24
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 27
    public function gethint_link($__hints__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "hints" => $__hints__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 28
            if ((isset($context["hints"]) ? $context["hints"] : $this->getContext($context, "hints"))) {
                // line 29
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["hints"]) ? $context["hints"] : $this->getContext($context, "hints")));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["hint"]) {
                    // line 30
                    if ($this->getAttribute($context["hint"], "class", array())) {
                        // line 31
                        echo $this->getAttribute($this, "class_link", array(0 => $this->getAttribute($context["hint"], "name", array())), "method");
                    } elseif ($this->getAttribute(                    // line 32
$context["hint"], "name", array())) {
                        // line 33
                        echo $this->env->getExtension('sami')->abbrClass($this->getAttribute($context["hint"], "name", array()));
                    }
                    // line 35
                    if ($this->getAttribute($context["hint"], "array", array())) {
                        echo "[]";
                    }
                    // line 36
                    if ( !$this->getAttribute($context["loop"], "last", array())) {
                        echo "|";
                    }
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hint'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 41
    public function getsource_link($__project__ = null, $__class__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "project" => $__project__,
            "class" => $__class__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 42
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "sourcepath", array())) {
                // line 43
                echo "        (<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "sourcepath", array()), "html", null, true);
                echo "\">View source</a>)";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 47
    public function getabbr_class($__class__ = null, $__absolute__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 48
            echo "<abbr title=\"";
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) ? $context["absolute"] : $this->getContext($context, "absolute")), false)) : (false))) ? ((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class"))) : ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortname", array()))), "html", null, true);
            echo "</abbr>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 51
    public function getmethod_parameters_signature($__method__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 52
            $context["__internal_158f8a411a39798c0a6c6ecfc944989b53ee6929e9a3933c4f16edb1b3a1d8dc"] = $this->loadTemplate("macros.twig", "macros.twig", 52);
            // line 53
            echo "(";
            // line 54
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "parameters", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                // line 55
                if ($this->getAttribute($context["parameter"], "hashint", array())) {
                    echo $context["__internal_158f8a411a39798c0a6c6ecfc944989b53ee6929e9a3933c4f16edb1b3a1d8dc"]->gethint_link($this->getAttribute($context["parameter"], "hint", array()));
                    echo " ";
                }
                // line 56
                echo "\$";
                echo twig_escape_filter($this->env, $this->getAttribute($context["parameter"], "name", array()), "html", null, true);
                // line 57
                if ($this->getAttribute($context["parameter"], "default", array())) {
                    echo " = ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["parameter"], "default", array()), "html", null, true);
                }
                // line 58
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo ")";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 63
    public function getrender_classes($__classes__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "classes" => $__classes__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 64
            echo "<div class=\"container-fluid underlined\">
        ";
            // line 65
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) ? $context["classes"] : $this->getContext($context, "classes")));
            foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                // line 66
                echo "            <div class=\"row\">
                <div class=\"col-md-6\">
                    ";
                // line 68
                if ($this->getAttribute($context["class"], "isInterface", array())) {
                    // line 69
                    echo "                        <em>";
                    echo $this->getAttribute($this, "class_link", array(0 => $context["class"], 1 => true), "method");
                    echo "</em>
                    ";
                } else {
                    // line 71
                    echo "                        ";
                    echo $this->getAttribute($this, "class_link", array(0 => $context["class"], 1 => true), "method");
                    echo "
                    ";
                }
                // line 73
                echo "                </div>
                <div class=\"col-md-6\">
                    ";
                // line 75
                echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["class"], "shortdesc", array()), $context["class"]);
                echo "
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "    </div>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 82
    public function getbreadcrumbs($__namespace__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 83
            echo "    ";
            $context["current_ns"] = "";
            // line 84
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_split_filter($this->env, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace")), "\\"));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                // line 85
                echo "        ";
                if ((isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns"))) {
                    // line 86
                    echo "            ";
                    $context["current_ns"] = (((isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns")) . "\\") . $context["ns"]);
                    // line 87
                    echo "        ";
                } else {
                    // line 88
                    echo "            ";
                    $context["current_ns"] = $context["ns"];
                    // line 89
                    echo "        ";
                }
                // line 90
                echo "        <li><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, (isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns"))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["ns"], "html", null, true);
                echo "</a></li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "macros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  473 => 90,  470 => 89,  467 => 88,  464 => 87,  461 => 86,  458 => 85,  453 => 84,  450 => 83,  439 => 82,  428 => 79,  418 => 75,  414 => 73,  408 => 71,  402 => 69,  400 => 68,  396 => 66,  392 => 65,  389 => 64,  378 => 63,  367 => 60,  351 => 58,  346 => 57,  343 => 56,  338 => 55,  321 => 54,  319 => 53,  317 => 52,  306 => 51,  291 => 48,  279 => 47,  265 => 43,  263 => 42,  251 => 41,  225 => 36,  221 => 35,  218 => 33,  216 => 32,  214 => 31,  212 => 30,  195 => 29,  193 => 28,  182 => 27,  171 => 24,  165 => 23,  161 => 22,  148 => 21,  137 => 18,  131 => 17,  127 => 16,  114 => 15,  101 => 12,  99 => 11,  94 => 9,  92 => 8,  88 => 7,  86 => 6,  74 => 5,  59 => 2,  48 => 1,  43 => 81,  40 => 62,  37 => 50,  34 => 46,  31 => 40,  28 => 26,  25 => 20,  22 => 14,  19 => 4,);
    }
}
