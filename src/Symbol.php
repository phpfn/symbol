<?php
/**
 * This file is part of Symbol package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Symbol;

/**
 * Class Symbol
 */
final class Symbol implements FactoryInterface
{
    /**
     * @var string
     */
    private const ERROR_OPEN = 'Cannot create a symbol, php://memory stream is not accessible';

    /**
     * @var string
     */
    private const ERROR_TYPE = '%s() expects parameter 1 to be a symbol, but %s given';

    /**
     * @var string
     */
    private const ANONYMOUS = 'symbol@anonymous#%d';

    /**
     * Symbol constructor.
     *
     * @throws \TypeError
     */
    public function __construct()
    {
        throw new \TypeError(__CLASS__ . ' cannot be instantiated');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function for(string $name)
    {
        if ($symbol = self::registry()[$name] ?? null) {
            return $symbol;
        }

        return self::registry([$name => self::create($name)])[$name];
    }

    /**
     * @param array $appends
     * @return array
     */
    private static function registry(array $appends = []): array
    {
        static $local = [];

        if (\count($appends) !== 0) {
            $local = \array_merge($local, $appends);
        }

        return $local;
    }

    /**
     * @param string|null $name
     * @return mixed
     */
    public static function create(string $name = null)
    {
        $resource = @\fopen('php://memory', 'rb');

        if (! Metadata::isStream($resource)) {
            throw new \LogicException(self::ERROR_OPEN);
        }

        Metadata::write($resource, self::resolveName($resource, $name));

        return $resource;
    }

    /**
     * @param resource $resource
     * @param string|null $name
     * @return string
     */
    private static function resolveName($resource, string $name = null): string
    {
        return $name ?: \sprintf(self::ANONYMOUS, $resource);
    }

    /**
     * @param resource|mixed $symbol
     * @param string $method
     * @return void
     */
    private static function assertIsSymbol($symbol, string $method): void
    {
        if (! self::isSymbol($symbol)) {
            throw new \TypeError(\sprintf(self::ERROR_TYPE, $method, \gettype($symbol)));
        }
    }

    /**
     * @param mixed|resource $symbol
     * @return string|null
     */
    public static function keyFor($symbol): ?string
    {
        self::assertIsSymbol($symbol, __METHOD__);

        $key = self::key($symbol);

        return (self::registry()[$key] ?? null) === $symbol ? $key : null;
    }

    /**
     * @param mixed $symbol
     * @return bool
     */
    public static function isSymbol($symbol): bool
    {
        if (! Metadata::isStream($symbol)) {
            return false;
        }

        return Metadata::exists($symbol);
    }

    /**
     * @param resource|mixed $symbol
     * @return string
     */
    public static function key($symbol): string
    {
        self::assertIsSymbol($symbol, __METHOD__);

        /** @noinspection NullPointerExceptionInspection */
        return Metadata::read($symbol)->getName();
    }

    /**
     * @param resource|mixed $symbol
     * @return ReflectionSymbol
     */
    public static function getReflection($symbol): ReflectionSymbol
    {
        self::assertIsSymbol($symbol, __METHOD__);

        /** @noinspection NullPointerExceptionInspection */
        return new ReflectionSymbol($symbol);
    }
}
