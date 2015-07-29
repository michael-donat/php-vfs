<?php

/* sami.js.twig */
class __TwigTemplate_05b888247ce96362421418bb226f0b93ea5c0ee8bc3581d0c49efffb73b720ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'search_index' => array($this, 'block_search_index'),
            'search_index_extra' => array($this, 'block_search_index_extra'),
            'treejs' => array($this, 'block_treejs'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '";
        // line 5
        echo strtr($this->getAttribute($this, "element", array(0 => (isset($context["tree"]) ? $context["tree"] : $this->getContext($context, "tree")), 1 => $this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "default_opened_level"), "method"), 2 => 0), "method"), array("'" => "\\'", "
" => ""));
        echo "';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
        ";
        // line 17
        $this->displayBlock('search_index', $context, $blocks);
        // line 35
        echo "        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if \"::\" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\\\') > -1) {
            tokens = tokens.concat(term.split('\\\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string \"search\" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp(\"[\\\\?&]\" + name + \"=([^&#]*)\");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\\+/g, \" \"));
            }

            return term.replace(/<(?:.|\\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return \$.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    \$(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = \$('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href=\"/g, 'href=\"' + rootPath);
        Sami.injectApiTree(\$('#api-tree'));
    });

    return root.Sami;
})(window);

\$(function() {

    // Enable the version switcher
    \$('#version-switcher').change(function() {
        window.location = \$(this).val()
    });

    ";
        // line 152
        $this->displayBlock('treejs', $context, $blocks);
        // line 178
        echo "
    ";
        // line 206
        echo "
        var form = \$('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                \$('#search-form').submit();
                return true;
            }
        });

    ";
        echo "
});

";
        // line 218
        echo "
";
    }

    // line 17
    public function block_search_index($context, array $blocks = array())
    {
        // line 18
        echo "            ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["namespaces"]) ? $context["namespaces"] : $this->getContext($context, "namespaces")));
        foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
            // line 19
            echo "{\"type\": \"Namespace\", \"link\": \"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, $context["ns"]), "html", null, true);
            echo "\", \"name\": \"";
            echo twig_escape_filter($this->env, strtr($context["ns"], array("\\" => "\\\\")), "html", null, true);
            echo "\", \"doc\": \"Namespace ";
            echo twig_escape_filter($this->env, strtr($context["ns"], array("\\" => "\\\\")), "html", null, true);
            echo "\"},";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "
            ";
        // line 22
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["interfaces"]) ? $context["interfaces"] : $this->getContext($context, "interfaces")));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 23
            echo "{\"type\": \"Interface\", ";
            if ($this->getAttribute($context["class"], "namespace", array())) {
                echo "\"fromName\": \"";
                echo twig_escape_filter($this->env, strtr($this->getAttribute($context["class"], "namespace", array()), array("\\" => "\\\\")), "html", null, true);
                echo "\", \"fromLink\": \"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, $this->getAttribute($context["class"], "namespace", array())), "html", null, true);
                echo "\",";
            }
            echo " \"link\": \"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForClass($context, $context["class"]), "html", null, true);
            echo "\", \"name\": \"";
            echo twig_escape_filter($this->env, strtr($this->getAttribute($context["class"], "name", array()), array("\\" => "\\\\")), "html", null, true);
            echo "\", \"doc\": \"";
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["class"], "shortdesc", array()), $context["class"])), "html", null, true);
            echo "\"},
                ";
            // line 24
            echo $this->getAttribute($this, "add_class_methods_index", array(0 => $context["class"]), "method");
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "
            ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) ? $context["classes"] : $this->getContext($context, "classes")));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 28
            echo "{\"type\": ";
            if ($this->getAttribute($context["class"], "isTrait", array())) {
                echo "\"Trait\"";
            } else {
                echo "\"Class\"";
            }
            echo ", ";
            if ($this->getAttribute($context["class"], "namespace", array())) {
                echo "\"fromName\": \"";
                echo twig_escape_filter($this->env, strtr($this->getAttribute($context["class"], "namespace", array()), array("\\" => "\\\\")), "html", null, true);
                echo "\", \"fromLink\": \"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, $this->getAttribute($context["class"], "namespace", array())), "html", null, true);
                echo "\",";
            }
            echo " \"link\": \"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForClass($context, $context["class"]), "html", null, true);
            echo "\", \"name\": \"";
            echo twig_escape_filter($this->env, strtr($this->getAttribute($context["class"], "name", array()), array("\\" => "\\\\")), "html", null, true);
            echo "\", \"doc\": \"";
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["class"], "shortdesc", array()), $context["class"])), "html", null, true);
            echo "\"},
                ";
            // line 29
            echo $this->getAttribute($this, "add_class_methods_index", array(0 => $context["class"]), "method");
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "
            ";
        // line 33
        echo "            ";
        $this->displayBlock('search_index_extra', $context, $blocks);
        // line 34
        echo "        ";
    }

    // line 33
    public function block_search_index_extra($context, array $blocks = array())
    {
        echo "";
    }

    // line 152
    public function block_treejs($context, array $blocks = array())
    {
        // line 153
        echo "
        // Toggle left-nav divs on click
        \$('#api-tree .hd span').click(function() {
            \$(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = \$('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = \$('#api-tree');
            var node = \$('#api-tree li[data-name=\"' + expected + '\"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    ";
    }

    // line 209
    public function getadd_class_methods_index($__class__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 210
            echo "    ";
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "methods", array())) {
                // line 211
                echo "        ";
                $context["from_name"] = strtr($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "name", array()), array("\\" => "\\\\"));
                // line 212
                echo "        ";
                $context["from_link"] = $this->env->getExtension('sami')->pathForClass($context, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")));
                // line 213
                echo "        ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "methods", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["meth"]) {
                    // line 214
                    echo "            {\"type\": \"Method\", \"fromName\": \"";
                    echo twig_escape_filter($this->env, (isset($context["from_name"]) ? $context["from_name"] : $this->getContext($context, "from_name")), "html", null, true);
                    echo "\", \"fromLink\": \"";
                    echo twig_escape_filter($this->env, (isset($context["from_link"]) ? $context["from_link"] : $this->getContext($context, "from_link")), "html", null, true);
                    echo "\", \"link\": \"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForMethod($context, $context["meth"]), "html", null, true);
                    echo "\", \"name\": \"";
                    echo twig_escape_filter($this->env, strtr($context["meth"], array("\\" => "\\\\")), "html", null, true);
                    echo "\", \"doc\": \"";
                    echo twig_escape_filter($this->env, twig_jsonencode_filter($this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["meth"], "shortdesc", array()), (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")))), "html", null, true);
                    echo "\"},
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['meth'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 216
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 219
    public function getelement($__tree__ = null, $__opened__ = null, $__depth__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "tree" => $__tree__,
            "opened" => $__opened__,
            "depth" => $__depth__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 220
            echo "    <ul>";
            // line 221
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tree"]) ? $context["tree"] : $this->getContext($context, "tree")));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 222
                if ($this->getAttribute($context["element"], 2, array(), "array")) {
                    // line 223
                    echo "                <li data-name=\"namespace:";
                    echo twig_escape_filter($this->env, strtr($this->getAttribute($context["element"], 1, array(), "array"), array("\\" => "_")), "html", null, true);
                    echo "\" ";
                    if (((isset($context["depth"]) ? $context["depth"] : $this->getContext($context, "depth")) < (isset($context["opened"]) ? $context["opened"] : $this->getContext($context, "opened")))) {
                        echo "class=\"opened\"";
                    }
                    echo ">
                    <div style=\"padding-left:";
                    // line 224
                    echo twig_escape_filter($this->env, ((isset($context["depth"]) ? $context["depth"] : $this->getContext($context, "depth")) * 18), "html", null, true);
                    echo "px\" class=\"hd\">
                        <span class=\"glyphicon glyphicon-play\"></span>";
                    // line 225
                    if ( !$this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "simulate_namespaces"), "method")) {
                        echo "<a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, $this->getAttribute($context["element"], 1, array(), "array")), "html", null, true);
                        echo "\">";
                    }
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], 0, array(), "array"), "html", null, true);
                    if ( !$this->getAttribute((isset($context["project"]) ? $context["project"] : $this->getContext($context, "project")), "config", array(0 => "simulate_namespaces"), "method")) {
                        echo "</a>";
                    }
                    // line 226
                    echo "                    </div>
                    <div class=\"bd\">
                        ";
                    // line 228
                    echo $this->getAttribute($this, "element", array(0 => $this->getAttribute($context["element"], 2, array(), "array"), 1 => (isset($context["opened"]) ? $context["opened"] : $this->getContext($context, "opened")), 2 => ((isset($context["depth"]) ? $context["depth"] : $this->getContext($context, "depth")) + 1)), "method");
                    // line 229
                    echo "</div>
                </li>
            ";
                } else {
                    // line 232
                    echo "                <li data-name=\"class:";
                    echo twig_escape_filter($this->env, strtr($this->getAttribute($this->getAttribute($context["element"], 1, array(), "array"), "name", array()), array("\\" => "_")), "html", null, true);
                    echo "\" ";
                    if (((isset($context["depth"]) ? $context["depth"] : $this->getContext($context, "depth")) < (isset($context["opened"]) ? $context["opened"] : $this->getContext($context, "opened")))) {
                        echo "class=\"opened\"";
                    }
                    echo ">
                    <div style=\"padding-left:";
                    // line 233
                    echo twig_escape_filter($this->env, (8 + ((isset($context["depth"]) ? $context["depth"] : $this->getContext($context, "depth")) * 18)), "html", null, true);
                    echo "px\" class=\"hd leaf\">
                        <a href=\"";
                    // line 234
                    echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForClass($context, $this->getAttribute($context["element"], 1, array(), "array")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], 0, array(), "array"), "html", null, true);
                    echo "</a>
                    </div>
                </li>
            ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 239
            echo "    </ul>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "sami.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  480 => 239,  467 => 234,  463 => 233,  454 => 232,  449 => 229,  447 => 228,  443 => 226,  433 => 225,  429 => 224,  420 => 223,  418 => 222,  414 => 221,  412 => 220,  399 => 219,  387 => 216,  370 => 214,  365 => 213,  362 => 212,  359 => 211,  356 => 210,  345 => 209,  317 => 153,  314 => 152,  308 => 33,  304 => 34,  301 => 33,  298 => 31,  290 => 29,  267 => 28,  263 => 27,  260 => 26,  252 => 24,  235 => 23,  231 => 22,  228 => 21,  216 => 19,  211 => 18,  208 => 17,  203 => 218,  170 => 206,  167 => 178,  165 => 152,  46 => 35,  44 => 17,  28 => 5,  22 => 1,);
    }
}
