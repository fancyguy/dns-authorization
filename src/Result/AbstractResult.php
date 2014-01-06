<?php
namespace FancyGuy\DnsAuthorization\Result;

/*
 * Copyright (c) 2014, FancyGuy Technologies
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * @author Steve Buzonas <steve@fancyguy.com>
 */
abstract class AbstractResult implements ResultInterface {

	/**
	 * @var string
	 */
	protected $target;

	/**
	 * @var boolean
	 */
	protected $ipv4Target = false;

	/**
	 * @var boolean
	 */
	protected $ipv6Target = false;

	/**
	 * @return boolean
	 */
	public function isIPv4Target() {
		return $this->ipv4Target;
	}

	/**
	 * @return boolean
	 */
	public function isIPv6Target() {
		return $this->ipv6Target;
	}

	/**
	 * @return boolean
	 */
	public function isIPTarget() {
		return $this->ipv4Target || $this->ipv6Target;
	}

	/**
	 * @return string
	 */
	public function getTarget() {
		return $this->target;
	}

	/**
	 * @param string $target
	 * @return self
	 */
	public function setTarget($target) {
		$this->target = (string) $target;
		if (filter_var($this->target, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$this->ipv6Target = true;
		} else if (filter_var($this->target, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$this->ipv4Target = true;
		} else {
			$this->ipv4Target = $this->ipv6Target = false;
		}
		return $this;
	}

}
