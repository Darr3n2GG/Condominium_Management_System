<?php

use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase {
    private $mysqliMock;
    private $Core;

    protected function setUp(): void {
        $this->mysqliMock = $this->createMock(mysqli::class);
        $this->Core = new Core($this->mysqliMock);
    }
}
