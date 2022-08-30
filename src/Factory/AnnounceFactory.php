<?php

namespace App\Factory;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Announce>
 *
 * @method static Announce|Proxy createOne(array $attributes = [])
 * @method static Announce[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Announce|Proxy find(object|array|mixed $criteria)
 * @method static Announce|Proxy findOrCreate(array $attributes)
 * @method static Announce|Proxy first(string $sortedField = 'id')
 * @method static Announce|Proxy last(string $sortedField = 'id')
 * @method static Announce|Proxy random(array $attributes = [])
 * @method static Announce|Proxy randomOrCreate(array $attributes = [])
 * @method static Announce[]|Proxy[] all()
 * @method static Announce[]|Proxy[] findBy(array $attributes)
 * @method static Announce[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Announce[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AnnounceRepository|RepositoryProxy repository()
 * @method Announce|Proxy create(array|callable $attributes = [])
 */
final class AnnounceFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'title' => self::faker()->text(),
            'description' => self::faker()->text(),
            'experience' => self::faker()->text(),
            'salary' => self::faker()->randomNumber(),
            'hourly' => self::faker()->text(),
            'benefits' => self::faker()->text(),
            'slug' => self::faker()->text(),
            'isValid' => self::faker()->boolean(),
            'createdAt' => null, // TODO add DATETIME ORM type manually
            'updatedAt' => null, // TODO add DATETIME ORM type manually
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Announce $announce): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Announce::class;
    }
}
