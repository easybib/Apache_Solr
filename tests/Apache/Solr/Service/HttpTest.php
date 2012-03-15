<?php
/**
 * Copyright (c) 2012, Till Klampaeckel
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *  - Neither the name of Servigistics, Inc. nor the names of
 *    its contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright Copyright 2007-2011 Servigistics, Inc. (http://servigistics.com)
 * @license http://solr-php-client.googlecode.com/svn/trunk/COPYING New BSD
 *
 * @package    Apache
 * @subpackage Solr
 * @author     Donovan Jimenez <djimenez@conduit-it.com>
 * @author     Till Klampaeckel <till@php.net>
 */

/**
 * Put HTTP related tests here.
 */
class Apache_Solr_Service_HttpTest extends Apache_Solr_ServiceAbstractTest
{
    public function getFixture()
    {
        return new Apache_Solr_Service();
    }

    /**
     * Return an instance of Guzzle\Http\Client.
     *
     * @return \Guzzle\Http\Client
     */
    public function getMockHttpTransportInterface()
    {
        $guzzle = new \Guzzle\Http\Client();
        return $guzzle;
    }

    /**
     * Have to check into it how useful this test is. Maybe 'undeprecate' the method?
     *
     * @return void
     */
    public function testGetDefaultTimeout()
    {
        $fixture = $this->getFixture();

        $mockTransport = $this->getMockHttpTransportInterface();

        $this->assertInstanceOf('Apache_Solr_Service', $fixture->accept($mockTransport));

        $this->assertInternalType('int', $fixture->getDefaultTimeout());
    }

    /**
     * @expectedException Apache_Solr_InvalidArgumentException
     */
    public function testSearchWithInvalidMethod()
    {
        $fixture = $this->getFixture();
        $fixture->search("solr", 0, 10, array(), "INVALID METHOD");
    }
}
