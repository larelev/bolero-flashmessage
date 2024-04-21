<?php

namespace Bolero\Plugins\FlashMessage\Tests;

use Bolero\Framework\Session\Session;
use Bolero\Plugins\FlashMessage\Enums\FlashType;
use Bolero\Plugins\FlashMessage\FlashMessage;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

//include dirname(__DIR__) . DIRECTORY_SEPARATOR .  "bootstrap.php";
class FlashMessageTest extends TestCase
{
    #[Test]
    public function setAndGetFlashTest()
    {
        $flash = new FlashMessage();
        $flash->set(FlashType::Success, "Great job!");
        $flash->set(FlashType::Error, "Bad luck!");
        $this->assertTrue($flash->has(FlashType::Success));
        $this->assertTrue($flash->has(FlashType::Error));
        $this->assertEquals(['Great job!'], $flash->get(FlashType::Success));
        $this->assertEquals([], $flash->get(FlashType::Warning));
    }

    protected function setUp(): void
    {
        $session = new Session();
        $session->clear();
        $session->start();
    }
}
