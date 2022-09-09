<?php

namespace App\Factory;

use App\Entity\Recruiter;
use App\Repository\RecruiterRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recruiter>
 *
 * @method static Recruiter|Proxy createOne(array $attributes = [])
 * @method static Recruiter[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Recruiter|Proxy find(object|array|mixed $criteria)
 * @method static Recruiter|Proxy findOrCreate(array $attributes)
 * @method static Recruiter|Proxy first(string $sortedField = 'id')
 * @method static Recruiter|Proxy last(string $sortedField = 'id')
 * @method static Recruiter|Proxy random(array $attributes = [])
 * @method static Recruiter|Proxy randomOrCreate(array $attributes = [])
 * @method static Recruiter[]|Proxy[] all()
 * @method static Recruiter[]|Proxy[] findBy(array $attributes)
 * @method static Recruiter[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Recruiter[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecruiterRepository|RepositoryProxy repository()
 * @method Recruiter|Proxy create(array|callable $attributes = [])
 */
final class RecruiterFactory extends ModelFactory
{

    protected static function getClass(): string
    {
        return Recruiter::class;
    }

    protected function getDefaults(): array
    {
        return [
            'company_name' => self::faker()->company(),
            'address' => self::faker()->address(),
            'city' => self::faker()->city(),
            'country' => self::faker()->country(),
            'postal_code' => self::faker()->countryCode(),

        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Recruiter $recruiter): void {})
            ;
    }
}
