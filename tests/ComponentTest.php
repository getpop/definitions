<?php

namespace PoP\Definitions;

use PHPUnit\Framework\TestCase;

class ComponentTest extends TestCase
{
    /**
     * The root component cannot have any dependency
     */
    public function testHasDependedComponentClasses(): void
    {
        $this->assertNotEmpty(
            Component::getDependedComponentClasses()
        );
    }
}
