<?php namespace App\Libraries;

use Exception;

/**
 *
 * Copyright MITRE 2015
 *
 * OpenIDConnectClient for PHP5
 * Author: Michael Jett <mjett@mitre.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */

/**
 * Modifications for NOSH ChartingSystem and UMA specific calls by Michael Chen <shihjay2@gmail.com>
 */

/**
 * Use session to manage a nonce
 */
if (!isset($_SESSION)) {
	session_start();
}

/**
 *
 * JWT signature verification support by Jonathan Reed <jdreed@mit.edu>
 * Licensed under the same license as the rest of this file.
 *
 * phpseclib is required to validate the signatures of some tokens.
 * It can be downloaded from: http://phpseclib.sourceforge.net/
 */
// include('Crypt/RSA.php');
// use Crypt_RSA;
use phpseclib\Crypt\RSA;

if (!class_exists('phpseclib\Crypt\RSA')) {
	user_error('Unable to find phpseclib Crypt/RSA.php.  Ensure phpseclib is installed and in include_path');
}

/**
 * A wrapper around base64_decode which decodes Base64URL-encoded data,
 * which is not the same alphabet as base64.
 */
function base64url_decode($base64url) {
	return base64_decode(b64url2b64($base64url));
}

/**
 * Per RFC4648, "base64 encoding with URL-safe and filename-safe
 * alphabet".  This just replaces characters 62 and 63.  None of the
 * reference implementations seem to restore the padding if necessary,
 * but we'll do it anyway.
 *
 */
function b64url2b64($base64url) {
	// "Shouldn't" be necessary, but why not
	$padding = strlen($base64url) % 4;
	if ($padding > 0) {
	$base64url .= str_repeat("=", 4 - $padding);
	}
	return strtr($base64url, '-_', '+/');
}


/**
 * OpenIDConnect Exception Class
 */
class OpenIDConnectClientException extends Exception
{

}

/**
 * Require the CURL and JSON PHP extentions to be installed
 */
if (!function_exists('curl_init')) {
	throw new OpenIDConnectClientException('OpenIDConnect needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
	throw new OpenIDConnectClientException('OpenIDConnect needs the JSON PHP extension.');
}

/**
 *
 * Please note this class stores nonces in $_SESSION['openid_connect_nonce']
 *
 */
class OpenIDConnectClient
{

	/**
	 * @var string arbitrary id value
	 */
	private $clientID;

	/*
	 * @var string arbitrary name value
	 */
	private $clientName;

	/**
	 * @var string arbitrary secret value
	 */
	private $clientSecret;

	/**
	 * @var array holds the provider configuration
	 */
	private $providerConfig = array();

	/**
	 * @var string http proxy if necessary
	 */
	private $httpProxy;

	/**
	 * @var string full system path to the SSL certificate
	 */
	private $certPath;

	/**
	 * @var string if we acquire an access token it will be stored here
	 */
	private $accessToken;

	/**
	 * @var string if we acquire a refresh token it will be stored here
	 */
	private $refreshToken;

	/**
	* @var string if we acquire an id token it will be stored here
	*/
	private $idToken;

	/**
	 * @var string if we acquire a patient token it will be stored here
	 */
	private $patientToken;

	/**
	 * @var array holds scopes
	 */
	private $scopes = array();

	/**
	 * @var array holds grant types
	 */
	private $grant_types = array();

	/**
	 * @var array holds a cache of info returned from the user info endpoint
	 */
	private $userInfo = array();

	/**
	 * @var array holds authentication parameters
	 */
	private $authParams = array();

	/**
	 * @param $provider_url string optional
	 *
	 * @param $client_id string optional
	 * @param $client_secret string optional
	 *
	 */
	public function __construct($provider_url = null, $client_id = null, $client_secret = null) {
		$this->setProviderURL($provider_url);
		$this->clientID = $client_id;
		$this->clientSecret = $client_secret;
	}

	/**
	 * @param $provider_url
	 */
	public function setProviderURL($provider_url) {
		$this->providerConfig['issuer'] = $provider_url;
	}

	/**
	 * @return bool
	 * @throws OpenIDConnectClientException
	 */
	public function authenticate($uma=false, $type='') {

		// Do a preemptive check to see if the provider has thrown an error from a previous redirect
		if (isset($_REQUEST['error'])) {
			throw new OpenIDConnectClientException("Error: " . $_REQUEST['error'] . " Description: " . $_REQUEST['error_description']);
		}

		// If we have an authorization code then proceed to request a token
		if (isset($_REQUEST["code"]) && isset($_SESSION['openid_connect_state'])) {
			$code = $_REQUEST["code"];
			$token_json = $this->requestTokens($code, $uma);

			// Throw an error if the server returns one
			if (isset($token_json->error)) {
				throw new OpenIDConnectClientException($token_json->error_description);
			}

			// Do an OpenID Connect session check
			if ($_REQUEST['state'] != $_SESSION['openid_connect_state']) {
				throw new OpenIDConnectClientException("Unable to determine state");
			}

			// Check if id_token exists to verify signature, if not, skip and get access token
			if (property_exists($token_json, 'id_token')) {
				$claims = $this->decodeJWT($token_json->id_token, 1);

				// Verify the signature
				if ($this->canVerifySignatures()) {
					if (!$this->verifyJWTsignature($token_json->id_token, $uma)) {
						throw new OpenIDConnectClientException ("Unable to verify signature");
					}
				} else {
					user_error("Warning: JWT signature verification unavailable.");
				}

				// If this is a valid claim
				if ($this->verifyJWTclaims($claims)) {

					// Clean up the session a little
					unset($_SESSION['openid_connect_nonce']);

					// Save the id token
					$this->idToken = $token_json->id_token;

					// Save the access token
					$this->accessToken = $token_json->access_token;

					// Save the refresh token, if we got one
					if (isset($token_json->refresh_token)) $this->refreshToken = $token_json->refresh_token;
					return true;
				} else {
					throw new OpenIDConnectClientException ("Unable to verify JWT claims");
				}
			} else {
				// Clean up the session a little
				unset($_SESSION['openid_connect_nonce']);

				// Save the access token
				$this->accessToken = $token_json->access_token;

				// Save the refresh token, if we got one
				if (isset($token_json->refresh_token)) $this->refreshToken = $token_json->refresh_token;

				// Save patient identifier, if we got one
				if (isset($token_json->patient)) $this->patientToken = $token_json->patient;
				return true;
			}
		} else {
			if ($uma == false) {
				$this->requestAuthorization();
			} else {
				$this->requestUmaAuthorization($type);
			}
			return false;
		}
	}

	public function refresh($token, $uma=false) {
		$token_json = $this->requestTokens('', $uma, $token);

		// Throw an error if the server returns one
		if (isset($token_json->error)) {
			throw new OpenIDConnectClientException($token_json->error_description);
		}
		if (!property_exists($token_json, 'id_token')) {
			$token = $token_json->access_token;
		} else {
			$token = $token_json->id_token;
		}

		$claims = $this->decodeJWT($token, 1);
		// Verify the signature
		if ($this->canVerifySignatures()) {
			if (!$this->verifyJWTsignature($token, $uma)) {
				throw new OpenIDConnectClientException ("Unable to verify signature");
			}
		} else {
			user_error("Warning: JWT signature verification unavailable.");
		}

		// If this is a valid claim
		if ($this->verifyJWTclaimsRefresh($claims)) {
			// Save the access token
			$this->accessToken = $token_json->access_token;
			if (isset($token_json->refresh_token)) $this->refreshToken = $token_json->refresh_token;
			return true;
		} else {
			throw new OpenIDConnectClientException ("Unable to verify JWT claims");
		}
	}

	/**
	 * @param $scope - example: openid, given_name, etc...
	 */
	public function addScope($scope) {
		$this->scopes = array_merge($this->scopes, (array)$scope);
	}

	/**
	 * @param $grant_type - example: authorization_code, implicit, password, client_credentials, refresh_token, urn:ietf:params:oauth:grant-type:jwt-bearer, urn:ietf:params:oauth:grant-type:saml2-bearer
	 */
	public function addGrantType($grant_type) {
		$this->grant_types = array_merge($this->grant_types, (array)$grant_type);
	}

	/**
	 * @param $param - example: prompt=login
	 */
	public function addAuthParam($param) {
		$this->authParams = array_merge($this->authParams, (array)$param);
	}

	/**
	 * Get's anything that we need configuration wise including endpoints, and other values
	 *
	 * @param $param
	 * @throws OpenIDConnectClientException
	 * @return string
	 *
	 */
	private function getProviderConfigValue($param, $uma=false) {
		// If the configuration value is not available, attempt to fetch it from a well known config endpoint
		// This is also known as auto "discovery"
		if (!isset($this->providerConfig[$param])) {
			if ($uma == false) {
				$well_known_config_url = rtrim($this->getProviderURL(),"/") . "/.well-known/openid-configuration";
			} else {
				if ($param != 'jwks_uri' && $param != 'revocation_endpoint') {
					$well_known_config_url = rtrim($this->getProviderURL(),"/") . "/.well-known/uma-configuration";
				} else {
					$well_known_config_url = rtrim($this->getProviderURL(),"/") . "/.well-known/openid-configuration";
				}
			}
			$value = json_decode($this->fetchURL($well_known_config_url), true);
			if (isset($value[$param])) {
				$this->providerConfig[$param] = $value[$param];
			} else {
				if ($param == 'registration_endpoint' && $uma == true) {
					return false;
				} else {
					throw new OpenIDConnectClientException("The provider {$param} has not been set. Make sure your provider has a well known configuration available.");
				}
			}
		}
		return $this->providerConfig[$param];
	}

	/**
	 * @param $url Sets redirect URL for auth flow
	 */
	public function setRedirectURL ($url) {
		if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
			$this->redirectURL = $url;
		}
	}

	/**
	 * Gets the URL of the current page we are on, encodes, and returns it
	 *
	 * @return string
	 */
	public function getRedirectURL() {
		// If the redirect URL has been set then return it.
		if (property_exists($this, 'redirectURL') && $this->redirectURL) {
			return $this->redirectURL;
		}
		// Other-wise return the URL of the current page
		/**
		 * Thank you
		 * http://stackoverflow.com/questions/189113/how-do-i-get-current-page-full-url-in-php-on-a-windows-iis-server
		 */
		$base_page_url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
			$base_page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
		} else {
			$base_page_url .= $_SERVER["SERVER_NAME"];
		}
		$tmp = explode("?", $_SERVER['REQUEST_URI']);
		$base_page_url .= $tmp[0];
		return $base_page_url;
	}

	public function setAud ($url) {
		if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
			$this->aud = $url;
		}
	}

	public function getAud() {
		if (property_exists($this, 'aud') && $this->aud) {
			return $this->aud;
		} else {
			return '';
		}
	}

	/**
	 * Used for arbitrary value generation for nonces and state
	 *
	 * @return string
	 */
	protected function generateRandString() {
		return md5(uniqid(rand(), TRUE));
	}

	/**
	 * Start Here
	 * @return void
	 */
	private function requestAuthorization() {
		$auth_endpoint = $this->getProviderConfigValue("authorization_endpoint");
		$response_type = "code";

		// Generate and store a nonce in the session
		// The nonce is an arbitrary value
		$nonce = $this->generateRandString();
		$_SESSION['openid_connect_nonce'] = $nonce;

		// State essentially acts as a session key for OIDC
		$state = $this->generateRandString();
		$_SESSION['openid_connect_state'] = $state;
		$auth_params = array_merge($this->authParams, array(
			'response_type' => $response_type,
			'redirect_uri' => $this->getRedirectURL(),
			'client_id' => $this->clientID,
			'nonce' => $nonce,
			'state' => $state,
			'scope' => 'openid',
			'aud' => $this->getAud()
		));

		// If the client has been registered with additional scopes
		if (sizeof($this->scopes) > 0) {
			$auth_params = array_merge($auth_params, array('scope' => implode(' ', $this->scopes)));
		}
		$auth_endpoint .= '?' . http_build_query($auth_params, null, '&');
		$this->redirect($auth_endpoint);
	}

	/**
	 * Requests ID and Access tokens
	 *
	 * @param $code
	 * @return mixed
	 */
	private function requestTokens($code, $uma=false, $refresh_token='') {
		$token_endpoint = $this->getProviderConfigValue("token_endpoint", $uma);
		if ($refresh_token == '') {
			$token_params = array(
				'grant_type' => 'authorization_code',
				'code' => $code,
				'redirect_uri' => $this->getRedirectURL(),
				'client_id' => $this->clientID,
				'client_secret' => $this->clientSecret
			);
		} else {
			$token_params = array(
				'grant_type' => 'refresh_token',
				'refresh_token' => $refresh_token,
				'client_id' => $this->clientID,
				'client_secret' => $this->clientSecret
			);
		}
		// Convert token params to string format
		$token_params = http_build_query($token_params, null, '&');
		return json_decode($this->fetchURL($token_endpoint, $token_params));
	}

	public function requestAAT() {
		$token_endpoint = $this->getProviderConfigValue("token_endpoint", true);
		$token_params = array(
			'grant_type' => 'client_credentials',
			'scope' => 'uma_authorization',
			'client_id' => $this->clientID,
			'client_secret' => $this->clientSecret
		);
		// Convert token params to string format
		$token_params = http_build_query($token_params, null, '&');
		$token_json = json_decode($this->fetchURL($token_endpoint, $token_params));
		// Throw an error if the server returns one
		if (isset($token_json->error)) {
			throw new OpenIDConnectClientException($token_json->error_description);
		}
		$this->accessToken = $token_json->access_token;
	}

	/**
	  * @param array $keys
	  * @param array $header
	  * @throws OpenIDConnectClientException
	  * @return object
	  */
	 private function get_key_for_header($keys, $header) {
		foreach ($keys as $key) {
			//if ($key->alg == $header->alg && $key->kid == $header->kid) {
			if ($key->kid == $header->kid) {
				 return $key;
			}
		}
		 throw new OpenIDConnectClientException('Unable to find a key for (algorithm, kid):' . $header->alg . ', ' . $header->kid . ')');
	 }

	/**
	 * @param array $keys
	 * @param string $alg
	 * @throws OpenIDConnectClientException
	 * @return object
	 */
	private function get_key_for_alg($keys, $alg) {
		foreach ($keys as $key) {
			if ($key->kty == $alg) {
				return $key;
			}
		}
		throw new OpenIDConnectClientException('Unable to find a key for algorithm:' . $alg);
	}

	/**
	 * @param string $hashtype
	 * @param object $key
	 * @throws OpenIDConnectClientException
	 * @return bool
	 */
	private function verifyRSAJWTsignature($hashtype, $key, $payload, $signature) {
		if (!class_exists('phpseclib\Crypt\RSA')) {
			throw new OpenIDConnectClientException('Crypt_RSA support unavailable.');
		}
		if (!(property_exists($key, 'n') and property_exists($key, 'e'))) {
			throw new OpenIDConnectClientException('Malformed key object');
		}
		/* We already have base64url-encoded data, so re-encode it as
		   regular base64 and use the XML key format for simplicity.
		*/
		$public_key_xml = "<RSAKeyValue>\r\n".
			"  <Modulus>" . b64url2b64($key->n) . "</Modulus>\r\n" .
			"  <Exponent>" . b64url2b64($key->e) . "</Exponent>\r\n" .
			"</RSAKeyValue>";
		$rsa = new RSA();
		$rsa->setHash($hashtype);
		$rsa->loadKey($public_key_xml, RSA::PUBLIC_FORMAT_XML);
		$rsa->signatureMode = RSA::SIGNATURE_PKCS1;
		return $rsa->verify($payload, $signature);
	}

	/**
	 * @param $jwt string encoded JWT
	 * @throws OpenIDConnectClientException
	 * @return bool
	 */
	private function verifyJWTsignature($jwt, $uma) {
		$parts = explode(".", $jwt);
		$signature = base64url_decode(array_pop($parts));
		$header = json_decode(base64url_decode($parts[0]));
		$payload = implode(".", $parts);
		$jwks = json_decode($this->fetchURL($this->getProviderConfigValue('jwks_uri',$uma)));
		if ($jwks === NULL) {
			throw new OpenIDConnectClientException('Error decoding JSON from jwks_uri');
		}
		$verified = false;
		switch ($header->alg) {
		case 'RS256':
		case 'RS384':
		case 'RS512':
			$hashtype = 'sha' . substr($header->alg, 2);
			if (isset($header->kid)) {
				$key = $this->get_key_for_header($jwks->keys, $header);
			} else {
				$key = $this->get_key_for_alg($jwks->keys, 'RSA');
			}
			$verified = $this->verifyRSAJWTsignature($hashtype, $key, $payload, $signature);
			break;
		default:
			throw new OpenIDConnectClientException('No support for signature type: ' . $header->alg);
		}
		return $verified;
	}

	/**
	 * @param object $claims
	 * @return bool
	 */
	private function verifyJWTclaims($claims) {
		return (($claims->iss == $this->getProviderURL())
			&& (($claims->aud == $this->clientID) || (in_array($this->clientID, $claims->aud)))
			&& ($claims->nonce == $_SESSION['openid_connect_nonce']));
	}

	/**
	 * @param object $claims
	 * @return bool
	 */
	private function verifyJWTclaimsRefresh($claims) {
		return (($claims->iss == $this->getProviderURL())
			&& (($claims->aud == $this->clientID) || (in_array($this->clientID, $claims->aud))));
	}

	/**
	 * @param $jwt string encoded JWT
	 * @param int $section the section we would like to decode
	 * @return object
	 */
	private function decodeJWT($jwt, $section = 0) {
		$parts = explode(".", $jwt);
		return json_decode(base64url_decode($parts[$section]));
	}

	/**
	 *
	 * @param $attribute
	 *
	 * Attribute        Type    Description
	 * user_id            string    REQUIRED Identifier for the End-User at the Issuer.
	 * name            string    End-User's full name in displayable form including all name parts, ordered according to End-User's locale and preferences.
	 * given_name        string    Given name or first name of the End-User.
	 * family_name        string    Surname or last name of the End-User.
	 * middle_name        string    Middle name of the End-User.
	 * nickname        string    Casual name of the End-User that may or may not be the same as the given_name. For instance, a nickname value of Mike might be returned alongside a given_name value of Michael.
	 * profile            string    URL of End-User's profile page.
	 * picture            string    URL of the End-User's profile picture.
	 * website            string    URL of End-User's web page or blog.
	 * email            string    The End-User's preferred e-mail address.
	 * verified        boolean    True if the End-User's e-mail address has been verified; otherwise false.
	 * gender            string    The End-User's gender: Values defined by this specification are female and male. Other values MAY be used when neither of the defined values are applicable.
	 * birthday        string    The End-User's birthday, represented as a date string in MM/DD/YYYY format. The year MAY be 0000, indicating that it is omitted.
	 * zoneinfo        string    String from zoneinfo [zoneinfo] time zone database. For example, Europe/Paris or America/Los_Angeles.
	 * locale            string    The End-User's locale, represented as a BCP47 [RFC5646] language tag. This is typically an ISO 639-1 Alpha-2 [ISO639‑1] language code in lowercase and an ISO 3166-1 Alpha-2 [ISO3166‑1] country code in uppercase, separated by a dash. For example, en-US or fr-CA. As a compatibility note, some implementations have used an underscore as the separator rather than a dash, for example, en_US; Implementations MAY choose to accept this locale syntax as well.
	 * phone_number    string    The End-User's preferred telephone number. E.164 [E.164] is RECOMMENDED as the format of this Claim. For example, +1 (425) 555-1212 or +56 (2) 687 2400.
	 * address            JSON object    The End-User's preferred address. The value of the address member is a JSON [RFC4627] structure containing some or all of the members defined in Section 2.4.2.1.
	 * updated_time    string    Time the End-User's information was last updated, represented as a RFC 3339 [RFC3339] datetime. For example, 2011-01-03T23:58:42+0000.
	 *
	 * @return mixed
	 *
	 */
	public function requestUserInfo($attribute) {
		// Check to see if the attribute is already in memory
		if (array_key_exists($attribute, $this->userInfo)) {
			return $this->userInfo->$attribute;
		}
		$user_info_endpoint = $this->getProviderConfigValue("userinfo_endpoint");
		$schema = 'openid';
		$user_info_endpoint .= "?schema=" . $schema;
		$user_json = json_decode($this->fetchURL($user_info_endpoint, null, $this->accessToken));
		$this->userInfo = $user_json;
		if (array_key_exists($attribute, $this->userInfo)) {
			return $this->userInfo->$attribute;
		}
		return null;
	}


	/**
	 * @param $url
	 * @param null $post_body string If this is set the post type will be POST
	 * $put_delete = either "PUT", "DELETE", or null
	 * @throws OpenIDConnectClientException
	 * @return mixed
	 */
	protected function fetchURL($url, $post_body = null, $token = null, $put_delete = null) {
		// OK cool - then let's create a new cURL resource handle
		$ch = curl_init();

		// Determine whether this is a GET or POST
		if ($post_body != null) {
			if ($put_delete != null) {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $put_delete);
			}
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);

			// Default content type is form encoded
			$content_type = 'application/x-www-form-urlencoded';

			// Determine if this is a JSON payload and add the appropriate content type
			if (is_object(json_decode($post_body))) {
				$content_type = 'application/json';
			}
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: {$content_type}",
				'Content-Length: ' . strlen($post_body)
			));
			if ($token != null) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Content-Type: {$content_type}",
					'Content-Length: ' . strlen($post_body),
					'Authorization: Bearer ' . $token
				));
			} else {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Content-Type: {$content_type}",
					'Content-Length: ' . strlen($post_body)
				));
			}
		} else {
			if ($token != null) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Authorization: Bearer ' . $token
				));
			}
		}

		// Set URL to download
		curl_setopt($ch, CURLOPT_URL, $url);
		if (isset($this->httpProxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $this->httpProxy);
		}

		// Include header in result? (0 = yes, 1 = no)
		curl_setopt($ch, CURLOPT_HEADER, 0);

		/**
		 * Set cert
		 * Otherwise ignore SSL peer verification
		 */
		if (isset($this->certPath)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_CAINFO, $this->certPath);
		} else {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		}

		// Should cURL return or print out the data? (true = return, false = print)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Timeout in seconds
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);

		// Download the given URL, and return output
		$output = curl_exec($ch);

		if ($output === false) {
			throw new OpenIDConnectClientException('Curl error: ' . curl_error($ch));
		}

		// Close the cURL resource, and free system resources
		curl_close($ch);
		return $output;
	}

	/**
	 * @return string
	 * @throws OpenIDConnectClientException
	 */
	public function getProviderURL() {

		if (!isset($this->providerConfig['issuer'])) {
			throw new OpenIDConnectClientException("The provider URL has not been set");
		} else {
			return $this->providerConfig['issuer'];
		}
	}

	/**
	 * @param $url
	 */
	public function redirect($url) {
		header('Location: ' . $url);
		exit;
	}

	/**
	 * @param $httpProxy
	 */
	public function setHttpProxy($httpProxy) {
		$this->httpProxy = $httpProxy;
	}

	/**
	 * @param $certPath
	 */
	public function setCertPath($certPath) {
		$this->certPath = $certPath;
	}

	/**
	 *
	 * Use this to alter a provider's endpoints and other attributes
	 *
	 * @param $array
	 *        simple key => value
	 */
	public function providerConfigParam($array) {
		$this->providerConfig = array_merge($this->providerConfig, $array);
	}

	/**
	 * @param $clientSecret
	 */
	public function setClientSecret($clientSecret) {
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @param $clientID
	 */
	public function setClientID($clientID) {
		$this->clientID = $clientID;
	}

	/**
	 * Dynamic registration
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function register($uma=false,$rs=false) {
		if ($uma == false) {
			$registration_endpoint = $this->getProviderConfigValue('registration_endpoint');
			$send_array = (object)array(
				'redirect_uris' => array($this->getRedirectURL(), str_replace('oidc', 'fhir/oidc', $this->getRedirectURL())),
				'client_name' => $this->getClientName(),
				'logo_uri' => 'https://cloud.noshchartingsystem.com/SAAS-Logo.jpg',
				'client_uri' => str_replace('/oidc', '', $this->getRedirectURL())
			);
		} else {
			$registration_endpoint = $this->getProviderConfigValue('registration_endpoint', $uma);
			if ($registration_endpoint == false) {
				// cover for old uma endpoint
				$registration_endpoint = $this->getProviderConfigValue('dynamic_client_endpoint', $uma);
			}
			if ($registration_endpoint == false) {
				throw new OpenIDConnectClientException("The provider {$param} has not been set. Make sure your provider has a well known configuration available.");
			}
			if ($rs == true) {
				$send_array = array(
					'redirect_uris' => array(
						$this->getRedirectURL(),
						str_replace('uma_auth', 'uma_api', $this->getRedirectURL()),
						str_replace('uma_auth', 'oidc', $this->getRedirectURL()),
						str_replace('uma_auth', 'fhir', $this->getRedirectURL()),
						str_replace('uma_auth', 'fhir/oidc', $this->getRedirectURL()),
						str_replace('uma_auth', 'uma_logout', $this->getRedirectURL()),
						str_replace('uma_auth', 'uma_patient_centric', $this->getRedirectURL()),
						str_replace('uma_auth', 'uma_register_auth', $this->getRedirectURL())
					),
					'client_name' => $this->getClientName(),
					'logo_uri' => 'https://cloud.noshchartingsystem.com/SAAS-Logo.jpg',
					'claims_redirect_uris' => array($this->getRedirectURL()),
					'client_uri' => str_replace('/uma_auth', '', $this->getRedirectURL())
				);
			} else {
				$send_array = array(
					'redirect_uris' => array($this->getRedirectURL(),
						str_replace('uma_auth', 'uma_api', $this->getRedirectURL()),
						str_replace('uma_auth', 'uma_aat', $this->getRedirectURL()),
						str_replace('uma_auth', 'uma_register_auth', $this->getRedirectURL())
					),
					'client_name' => $this->getClientName(),
					'logo_uri' => 'https://cloud.noshchartingsystem.com/SAAS-Logo.jpg',
					'claims_redirect_uris' => array($this->getRedirectURL(), str_replace('uma_auth', 'uma_aat', $this->getRedirectURL())),
					'client_uri' => str_replace('/uma_auth', '', $this->getRedirectURL())
				);
			}
		}
		// If the client has been registered with additional scopes
		if (sizeof($this->grant_types) > 0) {
			$send_array = array_merge($send_array, array('grant_types' => $this->grant_types));
		}
		if (sizeof($this->scopes) > 0) {
			$send_array = array_merge($send_array, array('scope' => implode(' ', $this->scopes)));
		}
		$send_object = (object) $send_array;
		$response = $this->fetchURL($registration_endpoint, json_encode($send_object));
		$json_response = json_decode($response);

		// Throw some errors if we encounter them
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			throw new OpenIDConnectClientException($json_response->{'error_description'});
		}
		$this->setClientID($json_response->{'client_id'});

		// The OpenID Connect Dynamic registration protocol makes the client secret optional
		// and provides a registration access token and URI endpoint if it is not present
		if (isset($json_response->{'client_secret'})) {
			$this->setClientSecret($json_response->{'client_secret'});
		} else {
			throw new OpenIDConnectClientException("Error registering:
													Please contact the OpenID Connect provider and obtain a Client ID and Secret directly from them");
		}
	}

	/**
	 * @return mixed
	 */
	public function getClientName() {
		return $this->clientName;
	}

	/**
	 * @param $clientName
	 */
	public function setClientName($clientName) {
		$this->clientName = $clientName;
	}

	/**
	 * @return string
	 */
	public function getClientID() {
		return $this->clientID;
	}

	/**
	 * @return string
	 */
	public function getClientSecret() {
		return $this->clientSecret;
	}

	/**
	 * @return bool
	 */
	public function canVerifySignatures() {
	  return class_exists('phpseclib\Crypt\RSA');
	}

	/**
	 * @param $accessToken
	 */
	public function setAccessToken($accessToken) {
		$this->accessToken = $accessToken;
	}

	/**
	 * @return string
	 */
	public function getAccessToken() {
		return $this->accessToken;
	}

	/**
	 * @param $refreshToken
	 */
	public function setRefreshToken($refreshToken) {
		$this->refreshToken = $refreshToken;
	}

	/**
	 * @return string
	 */
	public function getRefreshToken() {
		return $this->refreshToken;
	}

	/**
	 * @return string
	 */
	public function getPatientToken() {
		return $this->patientToken;
	}

	/**
	 * Everthing below this are UMA specific calls
	 */

	/**
	 * @param $resourceID
	 */
	private function requestUmaAuthorization($type) {
		$auth_endpoint = $this->getProviderConfigValue("authorization_endpoint", true);
		$response_type = "code";

		// Generate and store a nonce in the session
		// The nonce is an arbitrary value
		$nonce = $this->generateRandString();
		$_SESSION['openid_connect_nonce'] = $nonce;

		// State essentially acts as a session key for OIDC
		$state = $this->generateRandString();
		$_SESSION['openid_connect_state'] = $state;

		if ($type == 'user1') {
			$auth_params = array_merge($this->authParams, array(
				'response_type' => $response_type,
				'redirect_uri' => $this->getRedirectURL(),
				'client_id' => $this->clientID,
				'nonce' => $nonce,
				'state' => $state,
				'scope' => 'openid offline_access uma_protection email profile'
			));
		} elseif ($type == 'user') {
			$auth_params = array_merge($this->authParams, array(
				'response_type' => $response_type,
				'redirect_uri' => $this->getRedirectURL(),
				'client_id' => $this->clientID,
				'nonce' => $nonce,
				'state' => $state,
				'scope' => 'openid email profile'
			));
		} else {
			$auth_params = array_merge($this->authParams, array(
				'response_type' => $response_type,
				'redirect_uri' => $this->getRedirectURL(),
				'client_id' => $this->clientID,
				'nonce' => $nonce,
				'state' => $state,
				'scope' => 'uma_authorization email profile'
			));
		}

		// If the client has been registered with additional scopes
		if (sizeof($this->scopes) > 0) {
			$auth_params = array_merge($auth_params, array('scope' => implode(' ', $this->scopes)));
		}
		$auth_endpoint .= '?' . http_build_query($auth_params, null, '&');
		$this->redirect($auth_endpoint);
	}

	/**
	 * UMA - Resource Set Registration
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function resource_set($name, $icon, $scopes) {
		$resource_set_endpoint = $this->getProviderConfigValue('resource_set_registration_endpoint',true);
		$send_object = (object)array(
			'name' => $name,
			'icon_uri' => $icon,
			'scopes' => $scopes
		);
		$response = $this->fetchURL($resource_set_endpoint, json_encode($send_object), $this->accessToken);
		//$json_response = json_decode($response);
		$json_response = json_decode($response);
		// Throw some errors if we encounter them
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			$return['error'] = $json_response->{'error'};
			$return['error_description'] = $json_response->{'error_description'};
			throw new OpenIDConnectClientException($json_response->{'error_description'});
		}
		$return['resource_set_id'] = $json_response->{'_id'};
		$return['user_access_policy_uri'] = $json_response->{'user_access_policy_uri'};
		return $return;
	}

	public function delete_resource_set($id) {
		$resource_set_endpoint = $this->getProviderConfigValue('resource_set_registration_endpoint',true);
		$send_object = (object)array(
			'resource_set_id' => $id
		);
		$response = $this->fetchURL($resource_set_endpoint . '/' . $id, json_encode($send_object), $this->accessToken, 'DELETE');
		$json_response = json_decode($response);
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			$return['error'] = $json_response->{'error'};
			$return['error_description'] = $json_response->{'error_description'};
			throw new OpenIDConnectClientException($json_response->{'error_description'});
		}
		$return['resource_set_id'] = $json_response->{'_id'};
		$return['user_access_policy_uri'] = $json_response->{'user_access_policy_uri'};
		return $return;
	}

	public function update_resource_set($id, $name, $icon, $scopes) {
		$resource_set_endpoint = $this->getProviderConfigValue('resource_set_registration_endpoint',true);
		$send_object = (object)array(
			'name' => $name,
			'icon_uri' => $icon,
			'scopes' => $scopes
		);
		$response = $this->fetchURL($resource_set_endpoint . '/' . $id, json_encode($send_object), $this->accessToken, 'PUT');
		$json_response = json_decode($response);
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			$return['error'] = $json_response->{'error'};
			$return['error_description'] = $json_response->{'error_description'};
			throw new OpenIDConnectClientException($json_response->{'error_description'});
		}
		$return['resource_set_id'] = $json_response->{'_id'};
		$return['user_access_policy_uri'] = $json_response->{'user_access_policy_uri'};
		return $return;
	}

	public function get_resources($client_id) {
		$resource_set_endpoint = $this->getProviderConfigValue('resource_set_registration_endpoint',true);
		$return = json_decode($this->fetchURL($resource_set_endpoint, null, $this->accessToken, null), true);
		return $return;
	}

	/**
	 * UMA - Policy
	 * $permissions is array such as
	 * $permissions[] = [
	 * 	'claim' => 'person@email.com',
	 *	'scopes' => ['scope1', 'scope2' 'scope3']
 	 * ];
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function policy($resource_set_id, $permissions) {
		$policy_endpoint = $this->getProviderConfigValue('policy_endpoint',true);
		$send_object = (object)array(
			'resourceId' => $resource_set_id,
			'permissions' => $permissions
		);
		$response = $this->fetchURL($policy_endpoint, json_encode($send_object), $this->accessToken);
		//$json_response = json_decode($response);
		$json_response = json_decode($response);
		// Throw some errors if we encounter them
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			$return['error'] = $json_response->{'error'};
			$return['error_description'] = $json_response->{'error_description'};
			throw new OpenIDConnectClientException($json_response->{'error_description'});
		}
		$return['message'] = 'Policy Added';
		return $return;
	}

	public function delete_policy($id) {
		$policy_endpoint = $this->getProviderConfigValue('policy_endpoint',true);
		$send_object = (object)array(
			'resourceId' => $resource_set_id,
		);
		$response = $this->fetchURL($policy_endpoint . '/' . $id, json_encode($send_object), $this->accessToken, 'DELETE');
		$json_response = json_decode($response);
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'code'})) {
			$return['error'] = $json_response->{'reason'};
			$return['error_description'] = $json_response->{'message'};
			throw new OpenIDConnectClientException($json_response->{'message'});
		}
		$return['message'] = 'Policy Deleted';
		return $return;
	}

	public function update_policy($id, $resource_set_id, $permissions) {
		$policy_endpoint = $this->getProviderConfigValue('policy_endpoint',true);
		$send_object = (object)array(
			'resourceId' => $resource_set_id,
			'permissions' => $permissions
		);
		$response = $this->fetchURL($policy_endpoint . '/' . $id, json_encode($send_object), $this->accessToken, 'PUT');
		$json_response = json_decode($response);
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'code'})) {
			$return['error'] = $json_response->{'reason'};
			$return['error_description'] = $json_response->{'message'};
			throw new OpenIDConnectClientException($json_response->{'message'});
		}
		$return['message'] = 'Policy Updated';
		return $return;
	}

	public function get_policy($resource_set_id) {
		$policy_endpoint = $this->getProviderConfigValue('policy_endpoint',true);
		$policy_endpoint .= "?resourceId=" . $resource_set_id;
		$return = json_decode($this->fetchURL($policy_endpoint, null, $this->accessToken, null), true);
		return $return;
	}

	/**
	 * UMA - Permission Request
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function permission_request($resource_set_id, $scopes) {
		$permission_request_endpoint = $this->getProviderConfigValue('permission_registration_endpoint',true);
		$send_object = (object)array(
			'resource_set_id' => $resource_set_id,
			'scopes' => array($this->getRedirectURL(), str_replace('oidc', 'fhir/oidc', $this->getRedirectURL()))
		);
		$response = $this->fetchURL($permission_request_endpoint, json_encode($send_object), $this->accessToken);
		$json_response = json_decode($response);
		// Throw some errors if we encounter them
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		} elseif (isset($json_response->{'error_description'})) {
			$return['error'] = $json_response->{'error'};
			$return['error_description'] = $json_response->{'error_description'};
		}
		$return['ticket'] = $json_response->{'ticket'};
		return $return;
	}

	/**
	 * UMA - Requesting Party Claims Request
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function rqp_claims($permission_ticket) {
		$requesting_party_claims_endpoint = $this->getProviderConfigValue('requesting_party_claims_endpoint',true);
		$state = $this->generateRandString();
		$_SESSION['rpt_state'] = $state;
		$requesting_party_claims_endpoint .= "?ticket=" . $permission_ticket . "&claims_redirect_uri=" . $this->getRedirectURL() . "&client_id=" . $this->clientID . "&state=" . $state;
		$this->redirect($requesting_party_claims_endpoint);
	}

	/**
	 * UMA - Requesting Party Token Request
	 *
	 * @throws OpenIDConnectClientException
	 */
	public function rpt_request($permission_ticket) {
		if (isset($_REQUEST["access"])) {
			if ($_REQUEST["access"] == 'granted' && $_REQUEST["state"] == $_SESSION['rpt_state']) {
				// Request new RPT
				$return = $this->rpt_request_token($permission_ticket);
				unset($_SESSION['rpt_state']);
			} else {
				$return['error'] = 'Request to resource denied due to insufficient permissions.';
			}
		} else {
			$return = $this->rpt_request_token($permission_ticket);
		}
		return $return;
	}

	public function rpt_request_token($permission_ticket) {
		$rpt_request_endpoint = $this->getProviderConfigValue('rpt_endpoint',true);
		$send_object = (object)array(
			'ticket' => $permission_ticket
		);
		$response = $this->fetchURL($rpt_request_endpoint, json_encode($send_object), $this->accessToken);
		$json_response = json_decode($response, true);
		// Throw some errors if we encounter them
		if ($json_response === false) {
			throw new OpenIDConnectClientException("Error registering: JSON response received from the server was invalid.");
		}
		return $json_response;
	}

	public function introspect($token) {
		$introspect_endpoint = $this->getProviderConfigValue('introspection_endpoint',true);
		$send_object = array(
			'token' => $token
		);
		$send_object = http_build_query($send_object, null, '&');
		$response = $this->fetchURL($introspect_endpoint, $send_object, $this->accessToken);
		$json_response = json_decode($response, true);
		return $json_response;
	}

	public function api($command, $api_endpoint, $send_object = null, $put_delete = null) {
		if ($send_object != null) {
			$response = $this->fetchURL($api_endpoint, json_encode($send_object), $this->accessToken, $put_delete);
		} else {
			$response = $this->fetchURL($api_endpoint, null, $this->accessToken, $put_delete);
		}
		$json_response = json_decode($response, true);
		return $json_response;
	}

	public function revoke() {
		$revoke_request_endpoint = $this->getProviderConfigValue('revocation_endpoint',true);
		$token_params = array(
			'token' => $this->accessToken,
			'client_id' => $this->clientID,
			'client_secret' => $this->clientSecret
		);
		$token_params = http_build_query($token_params, null, '&');
		return $this->fetchURL($revoke_request_endpoint, $token_params);
	}
}
