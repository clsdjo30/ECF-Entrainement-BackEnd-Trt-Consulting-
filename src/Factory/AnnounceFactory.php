<?php

namespace App\Factory;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

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

    protected static function getClass(): string
    {
        return Announce::class;
    }

    protected function getDefaults(): array
    {
        $experience = [
            '1 ans souhaité',
            '2 ans souhaité',
            '5 ans souhaité',
        ];
        $beneficts = [
            'Ticket restaurant',
            'Logé',
            'Nouri',
            'Blanchi',
            '13iem mois',
            'Prime sur ratio',
        ];
        $hourly = [
            'Horaire en coupure',
            'Horaire continue journée',
            'Horaire continue soirée',
        ];

        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'title' => self::faker()->sentence(5),
            'description' => self::faker()->text(),
            'experience' => self::faker()->randomElement($experience),
            'salary' => self::faker()->numberBetween(1500, 5000),
            'hourly' => self::faker()->randomElement($hourly),
            'benefits' => self::faker()->randomElement($beneficts),
            'isValid' => self::faker()->boolean(),
            'createdAt' => self::faker()->dateTime(), // TODO add DATETIME ORM type manually
            'updatedAt' => self::faker()->dateTime(), // TODO add DATETIME ORM type manually
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Announce $announce): void {})
            ;
    }
}
