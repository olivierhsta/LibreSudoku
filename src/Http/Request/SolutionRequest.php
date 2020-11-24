<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Domain\Service\Solvers\SolverInterface;
use App\Http\Resource\SolverEnum;
use UnexpectedValueException;

class SolutionRequest implements RequestDto
{
    /**
     * @var SolverInterface[]
     * @Assert\Type("array")
     */
    public $solvers;

    function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if ($solvers = $data['solvers']) {
            foreach ($solvers as $i => $solver) {
                if (!SolverEnum::isValid($solver)) {
                    throw new UnexpectedValueException('Invalid solver name ' . $solver);
                }
            }
        }
    }
}
