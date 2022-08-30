<?php

namespace App\Factory;

use App\Entity\ApplyValidation;
use App\Repository\ApplyValidationRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ApplyValidation>
 *
 * @method static ApplyValidation|Proxy createOne(array $attributes = [])
 * @method static ApplyValidation[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ApplyValidation|Proxy find(object|array|mixed $criteria)
 * @method static ApplyValidation|Proxy findOrCreate(array $attributes)
 * @method static ApplyValidation|Proxy first(string $sortedField = 'id')
 * @method static ApplyValidation|Proxy last(string $sortedField = 'id')
 * @method static ApplyValidation|Proxy random(array $attributes = [])
 * @method static ApplyValidation|Proxy randomOrCreate(array $attributes = [])
 * @method static ApplyValidation[]|Proxy[] all()
 * @method static ApplyValidation[]|Proxy[] findBy(array $attributes)
 * @method static ApplyValidation[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ApplyValidation[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ApplyValidationRepository|RepositoryProxy repository()
 * @method ApplyValidation|Proxy create(array|callable $attributes = [])
 */
final class ApplyValidationFactory extends ModelFactory
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
            'candidateIsValid' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ApplyValidation $applyValidation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ApplyValidation::class;
    }
}
