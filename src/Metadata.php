<?php
/**
 * This file is part of Symbol package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Symbol;

use Serafim\Symbol\Metadata\Sign;
use Serafim\Symbol\Metadata\SignInterface;

/**
 * Class Metadata
 */
final class Metadata
{
    /**
     * @var string
     */
    private const TYPE_STREAM = 'stream';

    /**
     * @var string
     */
    private const CONTEXT_WRAPPER = 'php';

    /**
     * @var string
     */
    private const CONTEXT_FIELD_SIGN = '__metadata';

    /**
     * @var string
     */
    private const ERROR_TYPE = '%s() expects parameter 1 to be a stream resource, but %s given';

    /**
     * @param resource $resource
     * @param string $name
     * @return resource
     */
    public static function write($resource, string $name)
    {
        if (! self::isStream($resource)) {
            throw new \TypeError(\sprintf(self::ERROR_TYPE, __METHOD__, \gettype($resource)));
        }

        \stream_context_set_option($resource, self::context($name));

        return $resource;
    }

    /**
     * @param resource $resource
     * @return bool
     */
    public static function isStream($resource): bool
    {
        return \is_resource($resource) && \get_resource_type($resource) === self::TYPE_STREAM;
    }

    /**
     * @param string $name
     * @return array
     */
    private static function context(string $name): array
    {
        return [
            self::CONTEXT_WRAPPER => [
                self::CONTEXT_FIELD_SIGN => new Sign($name),
            ],
        ];
    }

    /**
     * @param resource $resource
     * @return \Serafim\Symbol\Metadata\SignInterface|null
     */
    public static function read($resource): ?SignInterface
    {
        if (! self::isStream($resource)) {
            throw new \TypeError(\sprintf(self::ERROR_TYPE, __METHOD__, \gettype($resource)));
        }

        $options = \stream_context_get_options($resource);

        return $options[self::CONTEXT_WRAPPER][self::CONTEXT_FIELD_SIGN] ?? null;
    }

    /**
     * @param resource $resource
     * @return bool
     */
    public static function exists($resource): bool
    {
        if (! self::isStream($resource)) {
            throw new \TypeError(\sprintf(self::ERROR_TYPE, __METHOD__, \gettype($resource)));
        }

        $options = \stream_context_get_options($resource);

        return isset($options[self::CONTEXT_WRAPPER][self::CONTEXT_FIELD_SIGN]);
    }
}
