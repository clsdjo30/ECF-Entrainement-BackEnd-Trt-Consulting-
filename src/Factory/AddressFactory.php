<?php

namespace App\Factory;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Address>
 *
 * @method static Address|Proxy createOne(array $attributes = [])
 * @method static Address[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Address|Proxy find(object|array|mixed $criteria)
 * @method static Address|Proxy findOrCreate(array $attributes)
 * @method static Address|Proxy first(string $sortedField = 'id')
 * @method static Address|Proxy last(string $sortedField = 'id')
 * @method static Address|Proxy random(array $attributes = [])
 * @method static Address|Proxy randomOrCreate(array $attributes = [])
 * @method static Address[]|Proxy[] all()
 * @method static Address[]|Proxy[] findBy(array $attributes)
 * @method static Address[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Address[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AddressRepository|RepositoryProxy repository()
 * @method Address|Proxy create(array|callable $attributes = [])
 */
final class AddressFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected static function getClass(): string
    {
        return Address::class;
    }

    protected function getDefaults(): array
    {
        $streetType = [
            'rue',
            'impasse',
            'boulevard',
            'chemin',
        ];

        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'street_number' => self::faker()->numberBetween(1, 300),
            'street_type' => self::faker()->randomElement($streetType),
            'street_name' => self::faker()->streetName(),
            'zip_code' => self::faker()->numberBetween(10000, 99000),
            'country' => self::faker()->country(),
            'city' => self::faker()->city(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Address $address): void {})
            ;
    }
}
