<?php

namespace FormSchema\Transformers;

    use Closure;
    use Illuminate\Contracts\Container\Container;
    use Illuminate\Support\Str;
    use InvalidArgumentException;

class TransformerManager
{

    /**
     * The container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * Create a new Transformer manager instance.
     *
     * @param  Container  $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get a transformer instance.
     *
     * @param  string|null  $driver
     * @return mixed
     */
    public function driver($driver = null)
    {
        return $this->resolve($driver ?? $this->getDefaultDriver());
    }

    /**
     * Resolve the given export instance by name.
     *
     * @param  string  $name
     * @return Transformer
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        if (isset($this->customCreators[$name])) {
            return $this->callCustomCreator($name);
        }

        $driverMethod = 'create'.Str::studly($name).'Transformer';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}();
        }

        throw new InvalidArgumentException("Transformer [{$name}] is not supported.");
    }

    /**
     * Call a custom driver creator.
     *
     * @param  array  $config
     * @return mixed
     */
    protected function callCustomCreator(string $name)
    {
        return $this->customCreators[$name]($this->container);
    }

    /**
     * Get the default export driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->container['config']['form-schema.transformer'];
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string  $driver
     * @param  \Closure  $callback
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback->bindTo($this, $this);

        return $this;
    }

     /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }

    public function createPortalUiKitTransformer()
    {
        return $this->container->make(PortalUiKitTransformer::class);
    }

}
