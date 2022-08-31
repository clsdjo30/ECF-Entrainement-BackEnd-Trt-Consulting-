<?php

namespace App\Factory;

use App\Entity\Candidate;
use App\Repository\CandidateRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

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

    protected static function getClass(): string
    {
        return Candidate::class;
    }

    protected function getDefaults(): array
    {
        return [
            'firstname' => self::faker()->firstName(),
            'lastname' => self::faker()->lastName(),
            'cvFile' => self::faker()->sentence(6),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Candidate $candidate): void {})
            ;
    }
}
