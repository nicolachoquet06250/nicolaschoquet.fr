<?php


namespace NC\controllers;


class Layout
{
    protected string $title = '';
    protected array $styles = [];
    protected string $content = '';
    protected array $startScripts = [];
    protected string $jsScript = '';
    protected string $style = '';
    protected string $menu = '';

    protected function styles(): string {
        return implode("\n", array_map(fn(string $style) => "<link href='{$style}' rel='stylesheet' />", $this->styles));
    }

    protected function style(): string {
        if (!empty($this->style)) {
            return "<style>{$this->style}</style>";
        }
        return '';
    }

    protected function startJavascript(): string {
        return implode("\n", array_map(function(string $script) {
            $_script = explode('@', $script);
            if ($_script[0] === 'module') {
                return "<script type='module' src='{$_script[1]}' defer></script>";
            }
            return "<script src='{$script}' defer></script>";
        }, $this->startScripts));
    }

    protected function jsScript(): string {
        if (!empty($this->jsScript)) {
            return "<script>{$this->jsScript}</script>";
        }
        return '';
    }

    protected function menu(): string {
        if (!empty($this->menu)) {
            return $this->menu;
        }
        return '';
    }

    protected function layout(): string {
        return <<<HTML
            <!doctype html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>{$this->title}</title>
                {$this->styles()}
                
                {$this->style()}
                
                {$this->startJavascript()}
            </head>
            
            <body>
                {$this->menu()}
                
                <div class="container">
                    <div class="row">
                        <div class="col-12 pt-4">
                            {$this->content}
                        </div>
                    </div>
                </div>
            </body>
            
            {$this->jsScript()}
            </html>
        HTML;
    }
}