<?php

use HabboAPI\Entities\Habbo;
use PHPUnit\Framework\TestCase;

/**
 * Class HabboTest
 *  Tests for the Habbo entity object
 */
class HabboTest extends TestCase
{

    private static $data;
    /**
     * @var Habbo $habbo
     */
    private $habbo;

    public static function setUpBeforeClass(): void
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_gethabbo.json'), true);
    }

    public function setUp(): void
    {
        $this->habbo = new Habbo();
        $this->habbo->parse(self::$data);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $this->habbo);
    }

    public function testGetId()
    {
        $this->assertEquals('hhus-9cd61b156972c2eb33a145d69918f965', $this->habbo->getId());
    }

    public function testGetHabboName()
    {
        $this->assertEquals('koeientemmer', $this->habbo->getHabboName());
    }

    public function testGetFigureString()
    {
        $this->assertEquals('hd-195-1.ch-215-75.lg-3290-91.sh-905-1408.ha-1015.wa-2001', $this->habbo->getFigureString());
    }

    public function testGetMotto()
    {
        $this->assertEquals('Oldskooler than Dionysus!', $this->habbo->getMotto());
    }

    public function testGetMemberSince()
    {
        $this->assertInstanceOf('\Carbon\Carbon', $this->habbo->getMemberSince());
        $this->assertEquals('Oct 6, 2001', $this->habbo->getMemberSince()->toFormattedDateString());
    }

    public function testFiveSelectedBadges()
    {
        $selectedBadges = $this->habbo->getSelectedBadges();
        $this->assertCount(5, $selectedBadges);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $selectedBadges[0]);
    }

    public function testHasProfile()
    {
        $this->assertTrue($this->habbo->hasProfile());
    }

    public function testCurrentLevel()
    {
        // this test should fail, as this data is from pre-2020 Habbo API
        $this->assertEquals(0, $this->habbo->getCurrentLevel());
    }

    public function testLastAccessTime()
    {
        // this test should fail, as this data is from pre-2020 Habbo API
        $this->assertNull($this->habbo->getLastAccessTime());
    }
}
