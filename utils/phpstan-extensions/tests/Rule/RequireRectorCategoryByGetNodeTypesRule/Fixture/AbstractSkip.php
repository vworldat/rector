<?php

declare(strict_types=1);

namespace Rector\PHPStanExtensions\Tests\Rule\RequireRectorCategoryByGetNodeTypesRule\Fixture;

use PhpParser\Node\Stmt\ClassMethod;

abstract class AbstractSkip
{
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }
}
