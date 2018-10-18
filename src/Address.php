<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Address implements Arrayable {

    private $name;
    private $street;
    private $other;
    private $city;
    private $zip;
    private $country;
    private $phone;

    public function __construct(string $name, string $street, string $city, string $zip, string $country, ?string $phone = null, ?string $other = null)
    {
        $this->name = $name;
        $this->street = $street;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
        $this->phone = $phone;
        $this->other = $other;
    }

    public function toArray()
    {
        return [
            'recipient_name' => $this->name,
            'line1' => $this->street,
            'line2' => $this->other,
            'city' => $this->city,
            'postal_code' => $this->zip,
            'country_code' => $this->country,
            'phone' => $this->phone
        ];
    }

}