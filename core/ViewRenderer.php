<?php

namespace Core;

use Doctrine\Common\Annotations\AnnotationReader;

class ViewRenderer
{
    private $viewPath;
    private $data;
    private $annotations;

    public function __construct($viewPath, $data = [])
    {
        $this->viewPath = $viewPath;
        $this->data = $data;
        $this->annotations = new AnnotationReader();
    }

    public function render()
    {
        $viewFile = __DIR__ . '/../app/Views/' . $this->viewPath . '.php';
        if (!file_exists($viewFile)) {
            echo "View file not found: " . $viewFile;
            return;
        }

        extract($this->data);
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // Process annotations in the view content
        $content = $this->processAnnotations($content);

        // If layout is set, process the layout
        if (isset($this->data['layout'])) {
            $layoutFile = __DIR__ . '/../app/Views/' . $this->data['layout'] . '.php';
            if (file_exists($layoutFile)) {
                ob_start();
                $view = $this->viewPath; // $view değişkenini set ediyoruz
                include $layoutFile;
                $layoutContent = ob_get_clean();
                $content = str_replace('{{ content }}', $content, $layoutContent);
                $content = $this->processAnnotations($content);
            }
        }

        echo $content;
    }

    private function processAnnotations($content)
    {
        // Match all @component('name') annotations in the content
        preg_match_all('/@component\((.*?)\)/', $content, $matches);
        foreach ($matches[1] as $key => $match) {
            $componentName = trim($match, "'\" ");
            $componentFile = __DIR__ . '/../app/Views/partials/' . $componentName . '.php';
            if (file_exists($componentFile)) {
                ob_start();
                include $componentFile;
                $componentContent = ob_get_clean();
                $content = str_replace($matches[0][$key], $componentContent, $content);
            } else {
                $content = str_replace($matches[0][$key], "<!-- Component $componentName not found -->", $content);
            }
        }
        return $content;
    }
}
