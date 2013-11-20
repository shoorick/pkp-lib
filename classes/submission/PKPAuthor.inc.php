<?php

/**
 * @file classes/submission/PKPAuthor.inc.php
 *
 * Copyright (c) 2000-2013 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PKPAuthor
 * @ingroup submission
 * @see PKPAuthorDAO
 *
 * @brief Author metadata class.
 */

class PKPAuthor extends DataObject {
	/**
	 * Constructor.
	 */
	function PKPAuthor() {
		parent::DataObject();
	}

	///**
	// * Get a piece of data for this object, localized to the current
	// * locale if possible.
	// * @param $key string
	// * @param $preferredLocale string
	// * @return mixed
	// */
	//// copied from lib/pkp/classes/submission/Submission.inc.php
	//function &getLocalizedData($key, $preferredLocale = null) {
	//	if (is_null($preferredLocale)) $preferredLocale = AppLocale::getLocale();
	//	$localePrecedence = array($preferredLocale, $this->getLocale());
	//	foreach ($localePrecedence as $locale) {
	//		if (empty($locale)) continue;
	//		$value =& $this->getData($key, $locale);
	//		if (!empty($value)) return $value;
	//		unset($value);
	//	}
	//
	//	// Fallback: Get the first available piece of data.
	//	$data =& $this->getData($key, null);
	//	if (!empty($data)) return $data[array_shift(array_keys($data))];
	//
	//	// No data available; return null.
	//	unset($data);
	//	$data = null;
	//	return $data;
	//}

	/**
	 * Get the author's complete name.
	 * Includes first name, middle name (if applicable), and last name.
	 * @param $lastFirst boolean False / default: Firstname Middle Lastname
	 * 	If true: Lastname, Firstname Middlename
	 * @return string
	 */
	function getFullName($lastFirst = false) {
		$locale = AppLocale::getLocale();
		//error_log( __FUNCTION__ . ' at ' . __FILE__ . ':' . __LINE__ . "\nlocale = $locale");
		if ($lastFirst)
			return $this->getData('lastName', $locale) . ', '
			. $this->getData('firstName', $locale)
			. ($this->getData('middleName', $locale) != '' ? ' ' . $this->getData('middleName', $locale) : '');
		else
			return $this->getData('firstName', $locale) . ' '
			. ($this->getData('middleName', $locale) != '' ? $this->getData('middleName', $locale) . ' ' : '')
			.  $this->getData('lastName', $locale)
			. ($this->getData('suffix') != '' ? ', ' . $this->getData('suffix') : '');
	}

	/**
	 * Get the author's localized complete name.
	 * Includes first name, middle name (if applicable), and last name.
	 * @param $lastFirst boolean False / default: Firstname Middle Lastname
	 * 	If true: Lastname, Firstname Middlename
	 * @return string
	 */
	function getLocalizedFullName($lastFirst = false) {
		//error_log( __FUNCTION__ . ' at ' . __FILE__ . ':' . __LINE__ );
		if ($lastFirst)
			return $this->getLocalizedData('lastName') . ', ' . $this->getLocalizedData('firstName')
			. ($this->getLocalizedData('middleName') != '' ? ' ' . $this->getLocalizedData('middleName') : '');
		else
			return $this->getLocalizedData('firstName') . ' '
			. ($this->getLocalizedData('middleName') != '' ? $this->getLocalizedData('middleName') . ' ' : '')
			.  $this->getLocalizedData('lastName')
			. ($this->getData('suffix') != '' ? ', ' . $this->getData('suffix') : '');
	}

	//
	// Get/set methods
	//

	/**
	 * Get ID of author.
	 * @return int
	 */
	function getAuthorId() {
		if (Config::getVar('debug', 'deprecation_warnings')) trigger_error('Deprecated function.');
		return $this->getId();
	}

	/**
	 * Set ID of author.
	 * @param $authorId int
	 */
	function setAuthorId($authorId) {
		if (Config::getVar('debug', 'deprecation_warnings'))
			trigger_error('Deprecated function.');
		return $this->setId($authorId);
	}

	/**
	 * Get ID of submission.
	 * @return int
	 */
	function getSubmissionId() {
		return $this->getData('submissionId');
	}

	/**
	 * Set ID of submission.
	 * @param $submissionId int
	 */
	function setSubmissionId($submissionId) {
		return $this->setData('submissionId', $submissionId);
	}

	/**
	 * Set the user group id
	 * @param $userGroupId int
	 */
	function setUserGroupId($userGroupId) {
		$this->setData('userGroupId', $userGroupId);
	}

	/**
	 * Get the user group id
	 * @return int
	 */
	function getUserGroupId() {
		return $this->getData('userGroupId');
	}

	/**
	 * Get first name.
	 * @param $locale string
	 * @return string
	 */
	function getFirstName($locale) {
		return $this->getData('firstName', $locale);
	}

	/**
	 * Set first name.
	 * @param $firstName string
	 * @param $locale string
	 */
	function setFirstName($firstName, $locale) {
		return $this->setData('firstName', $firstName, $locale);
	}

	/**
	 * Get localized first name.
	 * @return string
	 */
	function getLocalizedFirstName() {
		return $this->getLocalizedData('firstName');
	}

	/**
	 * Get middle name.
	 * @param $locale string
	 * @return string
	 */
	function getMiddleName($locale) {
		return $this->getData('middleName', $locale);
	}

	/**
	 * Set middle name.
	 * @param $middleName string
	 * @param $locale string
	 */
	function setMiddleName($middleName, $locale) {
		return $this->setData('middleName', $middleName, $locale);
	}

	/**
	 * Get localized middle name.
	 * @return string
	 */
	function getLocalizedMiddleName() {
		return $this->getLocalizedData('middleName');
	}

	/**
	 * Get initials.
	 * @return string
	 */
	function getInitials() {
		return $this->getData('initials');
	}

	/**
	 * Set initials.
	 * @param $initials string
	 */
	function setInitials($initials) {
		return $this->setData('initials', $initials);
	}

	/**
	 * Get last name.
	 * @param $locale string
	 * @return string
	 */
	function getLastName($locale) {
		return $this->getData('lastName', $locale);
	}

	/**
	 * Set last name.
	 * @param $locale string
	 * @param $lastName string
	 */
	function setLastName($lastName, $locale) {
		return $this->setData('lastName', $lastName, $locale);
	}

	/**
	 * Get localized last name.
	 * @return string
	 */
	function getLocalizedLastName() {
		return $this->getLocalizedData('lastName');
	}

	/**
	 * Get suffix.
	 * @return string
	 */
	function getSuffix() {
		return $this->getData('suffix');
	}

	/**
	 * Set suffix.
	 * @param $suffix string
	 */
	function setSuffix($suffix) {
		return $this->setData('suffix', $suffix);
	}

	/**
	 * Get user salutation.
	 * @return string
	 */
	function getSalutation() {
		return $this->getData('salutation');
	}

	/**
	 * Set user salutation.
	 * @param $salutation string
	 */
	function setSalutation($salutation) {
		return $this->setData('salutation', $salutation);
	}

	/**
	 * Get affiliation (position, institution, etc.).
	 * @param $locale string
	 * @return string
	 */
	function getAffiliation($locale) {
		return $this->getData('affiliation', $locale);
	}

	/**
	 * Set affiliation.
	 * @param $affiliation string
	 * @param $locale string
	 */
	function setAffiliation($affiliation, $locale) {
		return $this->setData('affiliation', $affiliation, $locale);
	}

	/**
	 * Get the localized affiliation for this author
	 */
	function getLocalizedAffiliation() {
		return $this->getLocalizedData('affiliation');
	}

	/**
	 * Get country code
	 * @return string
	 */
	function getCountry() {
		return $this->getData('country');
	}

	/**
	 * Get localized country
	 * @return string
	 */
	function getCountryLocalized() {
		$countryDao =& DAORegistry::getDAO('CountryDAO');
		$country = $this->getCountry();
		if ($country) {
			return $countryDao->getCountry($country);
		}
		return null;
	}

	/**
	 * Set country code.
	 * @param $country string
	 */
	function setCountry($country) {
		return $this->setData('country', $country);
	}

	/**
	 * Get email address.
	 * @return string
	 */
	function getEmail() {
		return $this->getData('email');
	}

	/**
	 * Set email address.
	 * @param $email string
	 */
	function setEmail($email) {
		return $this->setData('email', $email);
	}

	/**
	 * Get URL.
	 * @return string
	 */
	function getUrl() {
		return $this->getData('url');
	}

	/**
	 * Set URL.
	 * @param $url string
	 */
	function setUrl($url) {
		return $this->setData('url', $url);
	}

	/**
	 * Get the localized biography for this author
	 */
	function getLocalizedBiography() {
		return $this->getLocalizedData('biography');
	}

	function getAuthorBiography() {
		if (Config::getVar('debug', 'deprecation_warnings')) trigger_error('Deprecated function.');
		return $this->getLocalizedBiography();
	}

	/**
	 * Get author biography.
	 * @param $locale string
	 * @return string
	 */
	function getBiography($locale) {
		return $this->getData('biography', $locale);
	}

	/**
	 * Set author biography.
	 * @param $biography string
	 * @param $locale string
	 */
	function setBiography($biography, $locale) {
		return $this->setData('biography', $biography, $locale);
	}

	/**
	 * Get primary contact.
	 * @return boolean
	 */
	function getPrimaryContact() {
		return $this->getData('primaryContact');
	}

	/**
	 * Set primary contact.
	 * @param $primaryContact boolean
	 */
	function setPrimaryContact($primaryContact) {
		return $this->setData('primaryContact', $primaryContact);
	}

	/**
	 * Get sequence of author in article's author list.
	 * @return float
	 */
	function getSequence() {
		return $this->getData('sequence');
	}

	/**
	 * Set sequence of author in article's author list.
	 * @param $sequence float
	 */
	function setSequence($sequence) {
		return $this->setData('sequence', $sequence);
	}
}

?>
