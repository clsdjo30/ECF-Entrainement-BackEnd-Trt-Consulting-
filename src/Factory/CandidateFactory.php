<?php

namespace App\Factory;

use App\Entity\Candidate;
use App\Repository\CandidateRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Candidate>
 *
 * @method static Candidate|Proxy createOne(array $attributes = [])
 * @method static Candidate[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Candidate|Proxy find(object|array|mixed $criteria)
 * @method static Candidate|Proxy findOrCreate(array $attributes)
 * @method static Candidate|Proxy first(string $sortedField = 'id')
 * @method static Candidate|Proxy last(string $sortedField = 'id')
 * @method static Candidate|Proxy random(array $attributes = [])
 * @method static Candidate|Proxy randomOrCreate(array $attributes = [])
 * @method static Candidate[]|Proxy[] all()
 * @method static Candidate[]|Proxy[] findBy(array $attributes)
 * @method static Candidate[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Candidate[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CandidateRepository|RepositoryProxy repository()
 * @method Candidate|Proxy create(array|callable $attributes = [])
 */
final class CandidateFactory extends ModelFactory
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
            // ->afterInstantiate(function(Candidate $candidate): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Candidate::class;
    }
}
