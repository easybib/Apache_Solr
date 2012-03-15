<?php
namespace Apache\Solr\Service;

class HelperTest
{
    /**
     * @dataProvider testEscapeDataProvider
     */
    public function testEscape($input, $expectedOutput)
    {
        $fixture = $this->getFixture();

        $this->assertEquals($expectedOutput, $fixture->escape($input));
    }

    public function testEscapeDataProvider()
    {
        return array(
            array(
                "I should look the same",
                "I should look the same"
            ),

            array(
                "(There) are: ^lots \\ && of spec!al charaters",
                "\\(There\\) are\\: \\^lots \\\\ \\&& of spec\\!al charaters"
            )
        );
    }

    /**
     * @dataProvider testEscapePhraseDataProvider
     */
    public function testEscapePhrase($input, $expectedOutput)
    {
        $fixture = $this->getFixture();

        $this->assertEquals($expectedOutput, $fixture->escapePhrase($input));
    }

    public function testEscapePhraseDataProvider()
    {
        return array(
            array(
                "I'm a simple phrase",
                "I'm a simple phrase"
            ),

            array(
                "I have \"phrase\" characters",
                'I have \\"phrase\\" characters'
            )
        );
    }

    /**
     * @dataProvider testPhraseDataProvider
     */
    public function testPhrase($input, $expectedOutput)
    {
        $fixture = $this->getFixture();

        $this->assertEquals($expectedOutput, $fixture->phrase($input));
    }

    public function testPhraseDataProvider()
    {
        return array(
            array(
                "I'm a simple phrase",
                '"I\'m a simple phrase"'
            ),

            array(
                "I have \"phrase\" characters",
                '"I have \\"phrase\\" characters"'
            )
        );
    }
}