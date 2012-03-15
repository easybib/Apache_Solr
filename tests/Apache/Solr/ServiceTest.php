<?php
/**
 * Copyright (c) 2007-2011, Servigistics, Inc.
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
 * @package Apache
 * @subpackage Solr
 * @author Donovan Jimenez <djimenez@conduit-it.com>
 */
namespace Apache\Solr;

use Apache\Solr\Service;
use Guzzle\Http\Client;
/**
 * Service Unit Test
 */
class ServiceTest extends ServiceAbstractTest
{
    public function getFixture()
    {
        return new Service();
    }

	public function testGetHttpTransportWithDefaultConstructor()
	{
		$fixture       = new Service();
		$httpTransport = $fixture->getHttpClient();
		$this->assertInstanceOf('\Guzzle\Http\Client', $httpTransport, 'Default http transport does not implement interface');
	}

	public function testAccept()
	{
		$newTransport = new Client();

		$fixture = new Service();
		$fixture->accept($newTransport);

		$httpTransport = $fixture->getHttpClient();
		$this->assertEquals($newTransport, $httpTransport);
	}
	
	public function testAcceptWithConstructor()
	{
		$newTransport = new Client();
		
		$fixture = new Service('localhost', 8180, '/solr/', $newTransport);
		
		$fixture->accept($newTransport);
		$httpTransport = $fixture->getHttpClient();

		$this->assertEquals($newTransport, $httpTransport);
	}

	public function testGetCollapseSingleValueArraysWithDefaultConstructor()
	{
		$fixture = $this->getFixture();
		
		$this->assertTrue($fixture->getCollapseSingleValueArrays());
	}
	
	public function testSetCollapseSingleValueArrays()
	{
		$fixture = $this->getFixture();
		
		$fixture->setCollapseSingleValueArrays(false);
		$this->assertFalse($fixture->getCollapseSingleValueArrays());
	}
	
	public function testGetNamedListTreatmetnWithDefaultConstructor()
	{
		$fixture = $this->getFixture();
		
		$this->assertEquals(Service::NAMED_LIST_MAP, $fixture->getNamedListTreatment());
	}
	
	public function testSetNamedListTreatment()
	{
		$fixture = $this->getFixture();
		
		$fixture->setNamedListTreatment(Service::NAMED_LIST_FLAT);
		$this->assertEquals(Service::NAMED_LIST_FLAT, $fixture->getNamedListTreatment());
		
		$fixture->setNamedListTreatment(Service::NAMED_LIST_MAP);
		$this->assertEquals(Service::NAMED_LIST_MAP, $fixture->getNamedListTreatment());
	}
	
	/**
	 * @expectedException Apache\Solr\InvalidArgumentException
	 */
	public function testSetNamedListTreatmentInvalidArgumentException()
	{
		$fixture = $this->getFixture();
		
		$fixture->setNamedListTreatment("broken");
	}
	
	//================================================================//
	// END SECTION OF CODE THAT SHOULD BE MOVED                       //
	//   Service_Balancer will need functions added       //
	//================================================================//
	

	public function testConstructorDefaultArguments()
	{
		$fixture = new Service();
		
		$this->assertInstanceOf('\Apache\Solr\Service', $fixture);
	}

	public function testGetHostWithDefaultConstructor()
	{
		$fixture = new Service();
		$host = $fixture->getHost();
		
		$this->assertEquals("localhost", $host);
	}
	
	public function testSetHost()
	{
		$newHost = "example.com";
		
		$fixture = new Service();
		$fixture->setHost($newHost);
		$host = $fixture->getHost();
		
		$this->assertEquals($newHost, $host);
	}
	
	/**
	 * @expectedException Apache\Solr\InvalidArgumentException
	 */
	public function testSetEmptyHost()
	{
		$fixture = new Service();
		
		// should throw an invalid argument exception
		$fixture->setHost("");
	}
	
	public function testSetHostWithConstructor()
	{
		$newHost = "example.com";
		
		$fixture = new Service($newHost);
		$host = $fixture->getHost();
		
		$this->assertEquals($newHost, $host);
	}
	
	public function testGetPortWithDefaultConstructor()
	{
		$fixture = new Service();
		$port = $fixture->getPort();
		
		$this->assertEquals(8180, $port);
	}
	
	public function testSetPort()
	{
		$newPort = 12345;
		
		$fixture = new Service();
		$fixture->setPort($newPort);
		$port = $fixture->getPort();
		
		$this->assertEquals($newPort, $port);
	}
	
	/**
	 * @expectedException Apache\Solr\InvalidArgumentException
	 */
	public function testSetPortWithInvalidArgument()
	{
		$fixture = new Service();
		
		$fixture->setPort("broken");
	}
	
	public function testSetPortWithConstructor()
	{
		$newPort = 12345;
		
		$fixture = new Service('locahost', $newPort);
		$port = $fixture->getPort();
		
		$this->assertEquals($newPort, $port);
	}
		
	public function testGetPathWithDefaultConstructor()
	{
		$fixture = new Service();
		$path = $fixture->getPath();
		
		$this->assertEquals("/solr/", $path);
	}
	
	public function testSetPath()
	{
		$newPath = "/new/path/";
		
		$fixture = new Service();
		$fixture->setPath($newPath);
		$path = $fixture->getPath();
		
		$this->assertEquals($path, $newPath);
	}
	
	public function testSetPathWillAddContainingSlashes()
	{
		$newPath = "new/path";
		$containedPath = "/{$newPath}/";
		
		$fixture = new Service();
		$fixture->setPath($newPath);
		$path = $fixture->getPath();
		
		$this->assertEquals($containedPath, $path, 'setPath did not ensure propertly wrapped with slashes');
	}
	
	public function testSetPathWithConstructor()
	{
		$newPath = "/new/path/";
		
		$fixture = new Service('localhost', 8180, $newPath);
		$path = $fixture->getPath();
		
		$this->assertEquals($newPath, $path);
	}
}
