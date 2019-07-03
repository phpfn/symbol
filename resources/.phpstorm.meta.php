<?php

namespace PHPSTORM_META {

}

namespace {

    use Serafim\Symbol\FactoryInterface;

    /**
     * @see \Serafim\Symbol\ReflectionSymbol
     */
    final class ReflectionSymbol implements \Reflector
    {
        /**
         * ReflectionSymbol constructor.
         *
         * @param resource|mixed $symbol
         * @throws \ReflectionException
         */
        public function __construct($symbol)
        {
        }

        /**
         * @return int
         */
        public function getModifiers(): int
        {
        }

        /**
         * @return bool
         */
        public function isGlobal(): bool
        {
        }

        /**
         * @return string
         */
        public function getName(): string
        {
        }

        /**
         * @return string
         */
        public function getFileName(): string
        {
        }

        /**
         * @return int
         */
        public function getStartLine(): int
        {
        }

        /**
         * @return int
         */
        public function getEndLine(): int
        {
        }

        /**
         * @return array
         */
        public function __debugInfo(): array
        {
        }
    }

    /**
     * Class Symbol
     */
    final class Symbol implements FactoryInterface
    {

    }
}
