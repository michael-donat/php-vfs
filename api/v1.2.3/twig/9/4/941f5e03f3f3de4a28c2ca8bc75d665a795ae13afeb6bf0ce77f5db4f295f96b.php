<?php

/* class.twig */
class __TwigTemplate_941f5e03f3f3de4a28c2ca8bc75d665a795ae13afeb6bf0ce77f5db4f295f96b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout/layout.twig", "class.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body_class' => array($this, 'block_body_class'),
            'page_id' => array($this, 'block_page_id'),
            'below_menu' => array($this, 'block_below_menu'),
            'page_content' => array($this, 'block_page_content'),
            'class_signature' => array($this, 'block_class_signature'),
            'method_signature' => array($this, 'block_method_signature'),
            'method_parameters_signature' => array($this, 'block_method_parameters_signature'),
            'parameters' => array($this, 'block_parameters'),
            'return' => array($this, 'block_return'),
            'exceptions' => array($this, 'block_exceptions'),
            'see' => array($this, 'block_see'),
            'constants' => array($this, 'block_constants'),
            'properties' => array($this, 'block_properties'),
            'methods' => array($this, 'block_methods'),
            'methods_details' => array($this, 'block_methods_details'),
            'method' => array($this, 'block_method'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"] = $this->loadTemplate("macros.twig", "class.twig", 2);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "name", array()), "html", null, true);
        echo " | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = array())
    {
        echo "class";
    }

    // line 5
    public function block_page_id($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, ("class:" . strtr($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "name", array()), array("\\" => "_"))), "html", null, true);
    }

    // line 7
    public function block_below_menu($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "namespace", array())) {
            // line 9
            echo "        <div class=\"namespace-breadcrumbs\">
            <ol class=\"breadcrumb\">
                <li><span class=\"label label-default\">";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "categoryName", array()), "html", null, true);
            echo "</span></li>
                ";
            // line 12
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getbreadcrumbs($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "namespace", array()));
            echo "
                <li>";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortname", array()), "html", null, true);
            echo "</li>
            </ol>
        </div>
    ";
        }
    }

    // line 19
    public function block_page_content($context, array $blocks = array())
    {
        // line 20
        echo "
    <div class=\"page-header\">
        <h1>";
        // line 22
        echo twig_escape_filter($this->env, twig_last($this->env, twig_split_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "name", array()), "\\")), "html", null, true);
        echo "</h1>
    </div>

    <p>";
        // line 25
        $this->displayBlock("class_signature", $context, $blocks);
        echo "</p>

    ";
        // line 27
        if (($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortdesc", array()) || $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "longdesc", array()))) {
            // line 28
            echo "        <div class=\"description\">
            ";
            // line 29
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortdesc", array())) {
                // line 30
                echo "<p>";
                echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                echo "</p>";
            }
            // line 32
            echo "            ";
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "longdesc", array())) {
                // line 33
                echo "<p>";
                echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "longdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                echo "</p>";
            }
            // line 35
            echo "        </div>
    ";
        }
        // line 37
        echo "
    ";
        // line 38
        if ((isset($context["traits"]) ? $context["traits"] : $this->getContext($context, "traits"))) {
            // line 39
            echo "        <h2>Traits</h2>

        ";
            // line 41
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getrender_classes((isset($context["traits"]) ? $context["traits"] : $this->getContext($context, "traits")));
            echo "
    ";
        }
        // line 43
        echo "
    ";
        // line 44
        if ((isset($context["constants"]) ? $context["constants"] : $this->getContext($context, "constants"))) {
            // line 45
            echo "        <h2>Constants</h2>

        ";
            // line 47
            $this->displayBlock("constants", $context, $blocks);
            echo "
    ";
        }
        // line 49
        echo "
    ";
        // line 50
        if ((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties"))) {
            // line 51
            echo "        <h2>Properties</h2>

        ";
            // line 53
            $this->displayBlock("properties", $context, $blocks);
            echo "
    ";
        }
        // line 55
        echo "
    ";
        // line 56
        if ((isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods"))) {
            // line 57
            echo "        <h2>Methods</h2>

        ";
            // line 59
            $this->displayBlock("methods", $context, $blocks);
            echo "

        <h2>Details</h2>

        ";
            // line 63
            $this->displayBlock("methods_details", $context, $blocks);
            echo "
    ";
        }
        // line 65
        echo "
";
    }

    // line 68
    public function block_class_signature($context, array $blocks = array())
    {
        // line 69
        if (( !$this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "interface", array()) && $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "abstract", array()))) {
            echo "abstract ";
        }
        // line 70
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "categoryName", array()), "html", null, true);
        echo "
    <strong>";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortname", array()), "html", null, true);
        echo "</strong>";
        // line 72
        if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "parent", array())) {
            // line 73
            echo "        extends ";
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getclass_link($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "parent", array()));
        }
        // line 75
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "interfaces", array())) > 0)) {
            // line 76
            echo "        implements
        ";
            // line 77
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "interfaces", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
                // line 78
                echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getclass_link($context["interface"]);
                // line 79
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 82
        echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getsource_link((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
        echo "
";
    }

    // line 85
    public function block_method_signature($context, array $blocks = array())
    {
        // line 86
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "final", array())) {
            echo "final";
        }
        // line 87
        echo "    ";
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "abstract", array())) {
            echo "abstract";
        }
        // line 88
        echo "    ";
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "static", array())) {
            echo "static";
        }
        // line 89
        echo "    ";
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "protected", array())) {
            echo "protected";
        }
        // line 90
        echo "    ";
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "private", array())) {
            echo "private";
        }
        // line 91
        echo "    ";
        echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->gethint_link($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "hint", array()));
        echo "
    <strong>";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "name", array()), "html", null, true);
        echo "</strong>";
        $this->displayBlock("method_parameters_signature", $context, $blocks);
    }

    // line 95
    public function block_method_parameters_signature($context, array $blocks = array())
    {
        // line 96
        $context["__internal_58f0ed08a43bed1bc531f5cfb7c451221d73c67e50f01520cc392aa3aae47245"] = $this->loadTemplate("macros.twig", "class.twig", 96);
        // line 97
        echo $context["__internal_58f0ed08a43bed1bc531f5cfb7c451221d73c67e50f01520cc392aa3aae47245"]->getmethod_parameters_signature((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")));
    }

    // line 100
    public function block_parameters($context, array $blocks = array())
    {
        // line 101
        echo "    <table class=\"table table-condensed\">
        ";
        // line 102
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "parameters", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
            // line 103
            echo "            <tr>
                <td>";
            // line 104
            if ($this->getAttribute($context["parameter"], "hint", array())) {
                echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->gethint_link($this->getAttribute($context["parameter"], "hint", array()));
            }
            echo "</td>
                <td>\$";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute($context["parameter"], "name", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 106
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["parameter"], "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "    </table>
";
    }

    // line 112
    public function block_return($context, array $blocks = array())
    {
        // line 113
        echo "    <table class=\"table table-condensed\">
        <tr>
            <td>";
        // line 115
        echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->gethint_link($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "hint", array()));
        echo "</td>
            <td>";
        // line 116
        echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "hintDesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
        echo "</td>
        </tr>
    </table>
";
    }

    // line 121
    public function block_exceptions($context, array $blocks = array())
    {
        // line 122
        echo "    <table class=\"table table-condensed\">
        ";
        // line 123
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "exceptions", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["exception"]) {
            // line 124
            echo "            <tr>
                <td>";
            // line 125
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getclass_link($this->getAttribute($context["exception"], 0, array(), "array"));
            echo "</td>
                <td>";
            // line 126
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["exception"], 1, array(), "array"), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exception'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 129
        echo "    </table>
";
    }

    // line 132
    public function block_see($context, array $blocks = array())
    {
        // line 133
        echo "    <table class=\"table table-condensed\">
        ";
        // line 134
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "tags", array(0 => "see"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 135
            echo "            <tr>
                <td>";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], 0, array(), "array"), "html", null, true);
            echo "</td>
                <td>";
            // line 137
            echo twig_escape_filter($this->env, twig_join_filter(twig_slice($this->env, $context["tag"], 1, null), " "), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 140
        echo "    </table>
";
    }

    // line 143
    public function block_constants($context, array $blocks = array())
    {
        // line 144
        echo "    <table class=\"table table-condensed\">
        ";
        // line 145
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["constants"]) ? $context["constants"] : $this->getContext($context, "constants")));
        foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
            // line 146
            echo "            <tr>
                <td>";
            // line 147
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
            echo "</td>
                <td class=\"last\">
                    <p><em>";
            // line 149
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["constant"], "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
            echo "</em></p>
                    <p>";
            // line 150
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["constant"], "longdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
            echo "</p>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 154
        echo "    </table>
";
    }

    // line 157
    public function block_properties($context, array $blocks = array())
    {
        // line 158
        echo "    <table class=\"table table-condensed\">
        ";
        // line 159
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 160
            echo "            <tr>
                <td class=\"type\" id=\"property_";
            // line 161
            echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
            echo "\">
                    ";
            // line 162
            if ($this->getAttribute($context["property"], "static", array())) {
                echo "static";
            }
            // line 163
            echo "                    ";
            if ($this->getAttribute($context["property"], "protected", array())) {
                echo "protected";
            }
            // line 164
            echo "                    ";
            if ($this->getAttribute($context["property"], "private", array())) {
                echo "private";
            }
            // line 165
            echo "                    ";
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->gethint_link($this->getAttribute($context["property"], "hint", array()));
            echo "
                </td>
                <td>\$";
            // line 167
            echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
            echo "</td>
                <td class=\"last\">";
            // line 168
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["property"], "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
            echo "</td>
                <td>";
            // line 170
            if ( !($this->getAttribute($context["property"], "class", array()) === (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")))) {
                // line 171
                echo "<small>from&nbsp;";
                echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getproperty_link($context["property"], false, true);
                echo "</small>";
            }
            // line 173
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 176
        echo "    </table>
";
    }

    // line 179
    public function block_methods($context, array $blocks = array())
    {
        // line 180
        echo "    <div class=\"container-fluid underlined\">
        ";
        // line 181
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods")));
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
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 182
            echo "            <div class=\"row\">
                <div class=\"col-md-2 type\">
                    ";
            // line 184
            if ($this->getAttribute($context["method"], "static", array())) {
                echo "static&nbsp;";
            }
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->gethint_link($this->getAttribute($context["method"], "hint", array()));
            echo "
                </div>
                <div class=\"col-md-8 type\">
                    <a href=\"#method_";
            // line 187
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo "</a>";
            $this->displayBlock("method_parameters_signature", $context, $blocks);
            echo "
                    ";
            // line 188
            if ( !$this->getAttribute($context["method"], "shortdesc", array())) {
                // line 189
                echo "                        <p class=\"no-description\">No description</p>
                    ";
            } else {
                // line 191
                echo "                        <p>";
                echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["method"], "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                echo "</p>";
            }
            // line 193
            echo "                </div>
                <div class=\"col-md-2\">";
            // line 195
            if ( !($this->getAttribute($context["method"], "class", array()) === (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")))) {
                // line 196
                echo "<small>from&nbsp;";
                echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getmethod_link($context["method"], false, true);
                echo "</small>";
            }
            // line 198
            echo "</div>
            </div>
        ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 201
        echo "    </div>
";
    }

    // line 204
    public function block_methods_details($context, array $blocks = array())
    {
        // line 205
        echo "    <div id=\"method-details\">
        ";
        // line 206
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods")));
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
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 207
            echo "            <div class=\"method-item\">
                ";
            // line 208
            $this->displayBlock("method", $context, $blocks);
            echo "
            </div>
        ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 211
        echo "    </div>
";
    }

    // line 214
    public function block_method($context, array $blocks = array())
    {
        // line 215
        echo "    <h3 id=\"method_";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "name", array()), "html", null, true);
        echo "\">
        <div class=\"location\">";
        // line 216
        if ( !($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "class", array()) === (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")))) {
            echo "in ";
            echo $context["__internal_a0c190bd925d9bee1cec54e5fd8f2c09fa13c614457c26fa076f9eb82e0aa370"]->getmethod_link((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), false, true);
            echo " ";
        }
        echo "at line ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "line", array()), "html", null, true);
        echo "</div>
        <code>";
        // line 217
        $this->displayBlock("method_signature", $context, $blocks);
        echo "</code>
    </h3>
    <div class=\"details\">
        ";
        // line 220
        if (($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "shortdesc", array()) || $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "longdesc", array()))) {
            // line 221
            echo "            <div class=\"method-description\">
                ";
            // line 222
            if (( !$this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "shortdesc", array()) &&  !$this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "longdesc", array()))) {
                // line 223
                echo "                    <p class=\"no-description\">No description</p>
                ";
            } else {
                // line 225
                echo "                    ";
                if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "shortdesc", array())) {
                    // line 226
                    echo "<p>";
                    echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                    echo "</p>";
                }
                // line 228
                echo "                    ";
                if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "longdesc", array())) {
                    // line 229
                    echo "<p>";
                    echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "longdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                    echo "</p>";
                }
            }
            // line 232
            echo "            </div>
        ";
        }
        // line 234
        echo "        <div class=\"tags\">
            ";
        // line 235
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "parameters", array())) {
            // line 236
            echo "                <h4>Parameters</h4>

                ";
            // line 238
            $this->displayBlock("parameters", $context, $blocks);
            echo "
            ";
        }
        // line 240
        echo "
            ";
        // line 241
        if (($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "hintDesc", array()) || $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "hint", array()))) {
            // line 242
            echo "                <h4>Return Value</h4>

                ";
            // line 244
            $this->displayBlock("return", $context, $blocks);
            echo "
            ";
        }
        // line 246
        echo "
            ";
        // line 247
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "exceptions", array())) {
            // line 248
            echo "                <h4>Exceptions</h4>

                ";
            // line 250
            $this->displayBlock("exceptions", $context, $blocks);
            echo "
            ";
        }
        // line 252
        echo "
            ";
        // line 253
        if ($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "tags", array(0 => "see"), "method")) {
            // line 254
            echo "                <h4>See also</h4>

                ";
            // line 256
            $this->displayBlock("see", $context, $blocks);
            echo "
            ";
        }
        // line 258
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "class.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  785 => 258,  780 => 256,  776 => 254,  774 => 253,  771 => 252,  766 => 250,  762 => 248,  760 => 247,  757 => 246,  752 => 244,  748 => 242,  746 => 241,  743 => 240,  738 => 238,  734 => 236,  732 => 235,  729 => 234,  725 => 232,  719 => 229,  716 => 228,  711 => 226,  708 => 225,  704 => 223,  702 => 222,  699 => 221,  697 => 220,  691 => 217,  681 => 216,  676 => 215,  673 => 214,  668 => 211,  651 => 208,  648 => 207,  631 => 206,  628 => 205,  625 => 204,  620 => 201,  604 => 198,  599 => 196,  597 => 195,  594 => 193,  589 => 191,  585 => 189,  583 => 188,  575 => 187,  566 => 184,  562 => 182,  545 => 181,  542 => 180,  539 => 179,  534 => 176,  526 => 173,  521 => 171,  519 => 170,  515 => 168,  511 => 167,  505 => 165,  500 => 164,  495 => 163,  491 => 162,  487 => 161,  484 => 160,  480 => 159,  477 => 158,  474 => 157,  469 => 154,  459 => 150,  455 => 149,  450 => 147,  447 => 146,  443 => 145,  440 => 144,  437 => 143,  432 => 140,  423 => 137,  419 => 136,  416 => 135,  412 => 134,  409 => 133,  406 => 132,  401 => 129,  392 => 126,  388 => 125,  385 => 124,  381 => 123,  378 => 122,  375 => 121,  367 => 116,  363 => 115,  359 => 113,  356 => 112,  351 => 109,  342 => 106,  338 => 105,  332 => 104,  329 => 103,  325 => 102,  322 => 101,  319 => 100,  315 => 97,  313 => 96,  310 => 95,  304 => 92,  299 => 91,  294 => 90,  289 => 89,  284 => 88,  279 => 87,  275 => 86,  272 => 85,  266 => 82,  249 => 79,  247 => 78,  230 => 77,  227 => 76,  225 => 75,  221 => 73,  219 => 72,  216 => 71,  211 => 70,  207 => 69,  204 => 68,  199 => 65,  194 => 63,  187 => 59,  183 => 57,  181 => 56,  178 => 55,  173 => 53,  169 => 51,  167 => 50,  164 => 49,  159 => 47,  155 => 45,  153 => 44,  150 => 43,  145 => 41,  141 => 39,  139 => 38,  136 => 37,  132 => 35,  127 => 33,  124 => 32,  119 => 30,  117 => 29,  114 => 28,  112 => 27,  107 => 25,  101 => 22,  97 => 20,  94 => 19,  85 => 13,  81 => 12,  77 => 11,  73 => 9,  70 => 8,  67 => 7,  61 => 5,  55 => 4,  47 => 3,  43 => 1,  41 => 2,  11 => 1,);
    }
}
