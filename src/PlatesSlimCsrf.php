<?php

declare(strict_types=1);

namespace basteyy\PlatesSlimCsrf;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Slim\Csrf\Guard;

class PlatesSlimCsrf implements ExtensionInterface
{
    /**
     * @var Guard
     */
    protected Guard $csrf;
    private string $csrfTemplate;

    /**
     * PlatesSlimCsrfBridge constructor.
     * @param Guard $csrf The Guard Instance
     * @param string $csrfTemplate HTML DOM for the Template
     */
    public function __construct(Guard $csrf, string $csrfTemplate = '<input type="text" name="%1$s" value="%2$s"><input type="text" name="%3$s" value="%4$s">')
    {
        $this->csrf = $csrf;
        $this->csrfTemplate = $csrfTemplate;
    }

    /**
     * Register the csrf function ($this->csrf() inside your template)
     * @param Engine $engine
     */
    public function register(Engine $engine): void
    {
        $engine->registerFunction('getCsrf', [$this, 'getCsrf']);
    }

    /**
     * Return the hidden-input fields
     * @return string
     * @throws \Exception
     */
    public function getCsrf(): string
    {
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $keyPair = $this->csrf->generateToken();

        return sprintf($this->csrfTemplate, $nameKey, $keyPair[$nameKey], $valueKey, $keyPair[$valueKey]);

    }
}