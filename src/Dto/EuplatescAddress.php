<?php
/**
 * Contains the EuplatescAddress class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Vanilo\Euplatesc\Dto;

use Vanilo\Contracts\Address;
use Vanilo\Contracts\Billpayer;

class EuplatescAddress
{
    /** @var  string    Client first name (length 1-255) */
    private $firstName = '';

    /** @var  string    Client last name (length 1-255) */
    private $lastName = '';

    /** @var  string    Company name, optional (length 1-255) */
    private $company = '';

    /** @var  string    Client street (length 1-255) */
    private $address = '';

    /** @var  string    Client city (length 1-255) */
    private $city = '';

    /** @var  string    Client state, optional (length 1-255) */
    private $state = '';

    /** @var  string    Client postal code (length 1-25) */
    private $zip = '';

    /** @var  string    Client country (length 1-55) */
    private $country = '';

    /** @var  string    Client phone (length 1-25) */
    private $phone = '';

    /** @var  string    Client fax - optional (length 1-25) */
    private $fax = '';

    /** @var  string    Client email (length 1-55 or 1-65? <- doc is ambiguous here) */
    private $email = '';

    public static function fromVaniloAddress(Address $address): EuplatescAddress
    {
        $result = new self();

        $names = explode(' ', $address->getName(), 2);
        if (count($names) >= 2) {
            [$firstName, $lastName] = $names;
        } else {
            $firstName = $address->getName();
            $lastName  = '';
        }

        $result->setFirstName($firstName)
               ->setLastName($lastName)
               ->setAddress($address->getAddress())
               ->setCity($address->getCity())
               ->setZip($address->getPostalCode() ?? '')
               ->setState($address->getProvinceCode() ?? '')
               ->setCountry($address->getCountryCode());

        return $result;
    }

    public static function fromVaniloBillpayer(Billpayer $billpayer): EuplatescAddress
    {
        $result = new self();
        $address = $billpayer->getBillingAddress();

        $result->setFirstName($billpayer->getFirstName())
               ->setLastName($billpayer->getLastName())
               ->setAddress($address->getAddress())
               ->setCity($address->getCity())
               ->setZip($address->getPostalCode() ?? '')
               ->setState($address->getProvinceCode() ?? '')
               ->setCountry($address->getCountryCode())
               ->setEmail($billpayer->getEmail() ?? '')
               ->setPhone($billpayer->getPhone() ?? '')
               ->setCompany($billpayer->getCompanyName() ?? '');

        return $result;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): EuplatescAddress
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): EuplatescAddress
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): EuplatescAddress
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): EuplatescAddress
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): EuplatescAddress
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): EuplatescAddress
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): EuplatescAddress
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): EuplatescAddress
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): EuplatescAddress
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): EuplatescAddress
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): EuplatescAddress
    {
        $this->email = $email;

        return $this;
    }
}
