<?php

namespace App\Infrastructure\Doctrine\Values;

use App\Domain\Factory\GridFactory;
use App\Domain\Value\Difficulty;
use App\Domain\Value\Grid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GridType extends Type
{
    const GRID = 'grid';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'Grid';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return GridFactory::new()->createFromEncoding(str_split($value));
    }

    /**
     * @param Grid $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    public function getName()
    {
        return self::GRID;
    }
}