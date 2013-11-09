<?php

/* pages/interfaces.twig */
class __TwigTemplate_cbf68f3aa84f47c940bb775908e488670bf96b5dd5e3fc8e43de9146b503344c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body_class' => array($this, 'block_body_class'),
            'content_header' => array($this, 'block_content_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["page_layout"]) ? $context["page_layout"] : $this->getContext($context, "page_layout")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["__internal_c4041649628e6b62b6fddb44b04c73d944084212c018b08428f52da55a4a568d"] = $this->env->loadTemplate("macros.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Interfaces | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 7
    public function block_body_class($context, array $blocks = array())
    {
        echo "overview";
    }

    // line 9
    public function block_content_header($context, array $blocks = array())
    {
        // line 10
        echo "    <h1>Interfaces</h1>
";
    }

    // line 13
    public function block_content($context, array $blocks = array())
    {
        // line 14
        echo "    <table>
        ";
        // line 15
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["interfaces"]) ? $context["interfaces"] : $this->getContext($context, "interfaces")));
        foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
            // line 16
            echo "            <tr>
                <td>";
            // line 17
            echo $context["__internal_c4041649628e6b62b6fddb44b04c73d944084212c018b08428f52da55a4a568d"]->getclass_link((isset($context["interface"]) ? $context["interface"] : $this->getContext($context, "interface")), array("target" => "main"), true);
            echo "</td>
                <td class=\"last\">
                    ";
            // line 19
            echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute((isset($context["interface"]) ? $context["interface"] : $this->getContext($context, "interface")), "shortdesc"), (isset($context["interface"]) ? $context["interface"] : $this->getContext($context, "interface")));
            echo "
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "    </table>
";
    }

    public function getTemplateName()
    {
        return "pages/interfaces.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 20,  69 => 7,  63 => 5,  57 => 4,  97 => 27,  61 => 15,  45 => 7,  144 => 39,  136 => 36,  129 => 35,  125 => 33,  118 => 32,  114 => 30,  105 => 29,  101 => 27,  95 => 25,  88 => 22,  72 => 18,  66 => 16,  55 => 14,  26 => 3,  43 => 8,  41 => 7,  21 => 2,  379 => 58,  363 => 56,  358 => 55,  355 => 54,  350 => 53,  333 => 52,  331 => 51,  329 => 50,  318 => 49,  303 => 46,  291 => 45,  265 => 40,  261 => 39,  258 => 37,  255 => 35,  253 => 34,  236 => 33,  234 => 32,  222 => 31,  211 => 28,  205 => 27,  199 => 26,  185 => 25,  174 => 22,  168 => 21,  162 => 20,  148 => 19,  135 => 16,  133 => 15,  126 => 13,  119 => 11,  117 => 10,  104 => 9,  53 => 12,  42 => 6,  37 => 6,  34 => 4,  25 => 4,  19 => 1,  110 => 32,  103 => 28,  99 => 26,  90 => 27,  87 => 6,  83 => 23,  79 => 23,  64 => 16,  62 => 16,  58 => 15,  52 => 13,  49 => 11,  46 => 9,  40 => 5,  80 => 23,  76 => 20,  71 => 19,  60 => 13,  56 => 12,  50 => 9,  31 => 5,  94 => 26,  91 => 25,  84 => 8,  81 => 22,  75 => 9,  70 => 19,  68 => 18,  65 => 17,  47 => 10,  44 => 9,  38 => 7,  33 => 5,  22 => 8,  51 => 12,  39 => 6,  35 => 4,  32 => 3,  29 => 6,  28 => 3,);
    }
}
