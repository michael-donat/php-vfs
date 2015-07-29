<?php

/* layout/base.twig */
class __TwigTemplate_98520daa839f7be7cbb012d767d1e4f2b666e36278f766d99dab355b0eb9bb07 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'html' => array($this, 'block_html'),
            'body_class' => array($this, 'block_body_class'),
            'page_id' => array($this, 'block_page_id'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\" />
    <meta name=\"robots\" content=\"index, follow, all\" />
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    ";
        // line 8
        $this->displayBlock('head', $context, $blocks);
        // line 17
        echo "
    ";
        // line 18
        if ($this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "favicon"), "method")) {
            // line 19
            echo "        <link rel=\"shortcut icon\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "favicon"), "method"), "html", null, true);
            echo "\" />
    ";
        }
        // line 21
        echo "
    ";
        // line 22
        if ($this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "base_url"), "method")) {
            // line 23
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "versions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 24
                echo "<link rel=\"search\"
                  type=\"application/opensearchdescription+xml\"
                  href=\"";
                // line 26
                echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "base_url"), "method"), array("%version%" => $context["version"])), "html", null, true);
                echo "/opensearch.xml\"
                  title=\"";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "title"), "method"), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, $context["version"], "html", null, true);
                echo ")\" />
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 30
        echo "</head>

";
        // line 32
        $this->displayBlock('html', $context, $blocks);
        // line 37
        echo "
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "title"), "method"), "html", null, true);
    }

    // line 8
    public function block_head($context, array $blocks = array())
    {
        // line 9
        echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "css/bootstrap.min.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "css/bootstrap-theme.min.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "css/sami.css"), "html", null, true);
        echo "\">
        <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "js/jquery-1.11.1.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "js/typeahead.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForStaticFile($context, "sami.js"), "html", null, true);
        echo "\"></script>
    ";
    }

    // line 32
    public function block_html($context, array $blocks = array())
    {
        // line 33
        echo "    <body id=\"";
        $this->displayBlock('body_class', $context, $blocks);
        echo "\" data-name=\"";
        $this->displayBlock('page_id', $context, $blocks);
        echo "\" data-root-path=\"";
        echo twig_escape_filter($this->env, (isset($context["root_path"]) ? $context["root_path"] : $this->getContext($context, "root_path")), "html", null, true);
        echo "\">
        ";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        // line 35
        echo "    </body>
";
    }

    // line 33
    public function block_body_class($context, array $blocks = array())
    {
        echo "";
    }

    public function block_page_id($context, array $blocks = array())
    {
        echo "";
    }

    // line 34
    public function block_content($context, array $blocks = array())
    {
        echo "";
    }

    public function getTemplateName()
    {
        return "layout/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 34,  149 => 33,  144 => 35,  142 => 34,  133 => 33,  130 => 32,  124 => 15,  120 => 14,  116 => 13,  112 => 12,  108 => 11,  104 => 10,  99 => 9,  96 => 8,  90 => 6,  84 => 37,  82 => 32,  78 => 30,  67 => 27,  63 => 26,  59 => 24,  55 => 23,  53 => 22,  50 => 21,  44 => 19,  42 => 18,  39 => 17,  37 => 8,  32 => 6,  25 => 1,);
    }
}
