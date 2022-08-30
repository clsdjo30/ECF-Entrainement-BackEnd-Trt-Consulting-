<?php

namespace App\Factory;

use App\Entity\PublishValidation;
use App\Repository\PublishValidationRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PublishValidation>
 *
 * @method static PublishValidation|Proxy createOne(array $attributes = [])
 * @method static PublishValidation[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PublishValidation|Proxy find(object|array|mixed $criteria)
 * @method static PublishValidation|Proxy findOrCreate(array $attributes)
 * @method static PublishValidation|Proxy first(string $sortedField = 'id')
 * @method static PublishValidation|Proxy last(string $sortedField = 'id')
 * @method static PublishValidation|Proxy random(array $attributes = [])
 * @method static PublishValidation|Proxy randomOrCreate(array $attributes = [])
 * @method static PublishValidation[]|Proxy[] all()
 * @method static PublishValidation[]|Proxy[] findBy(array $attributes)
 * @method static PublishValidation[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PublishValidation[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PublishValidationRepository|RepositoryProxy repository()
 * @method PublishValidation|Proxy create(array|callable $attributes = [])
 */
final class PublishValidationFactory extends ModelFactory
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
            'announceIsValid' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PublishValidation $publishValidation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PublishValidation::class;
    }
}
