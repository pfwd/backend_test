<?php
declare(strict_types=1);

namespace App\Tests;

use App\Formatter\ShoutFormatDecorator;
use Codeception\Test\Unit;

class ShoutFormatDecoratorTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testShout(): void
    {
        $text = 'The only way to do great work is to love what you do.';
        $decorator = new ShoutFormatDecorator();
        $this->assertSame('THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!', $decorator->output($text));
    }

    public function testShoutWithoutFullStop(): void
    {
        $text = 'The only way to do great work is to love what you do';
        $decorator = new ShoutFormatDecorator();
        $this->assertSame('THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!', $decorator->output($text));
    }

    public function testShoutWithExclamationMark(): void
    {
        $text = 'This quote already has a !';
        $decorator = new ShoutFormatDecorator();
        $this->assertSame('THIS QUOTE ALREADY HAS A !', $decorator->output($text));
    }

}