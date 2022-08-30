<?php

namespace App\Factory;

use App\Entity\Consultant;
use App\Repository\ConsultantRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Consultant>
 *
 * @method static Consultant|Proxy createOne(array $attributes = [])
 * @method static Consultant[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Consultant|Proxy find(object|array|mixed $criteria)
 * @method static Consultant|Proxy findOrCreate(array $attributes)
 * @method static Consultant|Proxy first(string $sortedField = 'id')
 * @method static Consultant|Proxy last(string $sortedField = 'id')
 * @method static Consultant|Proxy random(array $attributes = [])
 * @method static Consultant|Proxy randomOrCreate(array $attributes = [])
 * @method static Consultant[]|Proxy[] all()
 * @method static Consultant[]|Proxy[] findBy(array $attributes)
 * @method static Consultant[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Consultant[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ConsultantRepository|RepositoryProxy repository()
 * @method Consultant|Proxy create(array|callable $attributes = [])
 */
final class ConsultantFactory extends ModelFactory
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
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Consultant $consultant): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Consultant::class;
    }
}
