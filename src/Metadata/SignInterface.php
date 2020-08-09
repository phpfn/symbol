<?php

/**
 * This file is part of phpfn package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Fun\Symbol\Metadata;

interface SignInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getContext(): array;
}
