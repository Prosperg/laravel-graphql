<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgTransformerDirective;
use Illuminate\Support\Facades\Hash;

use GraphQL\Language\AST\DirectiveNode;


class BcryptDirective extends BaseDirective implements ArgTransformerDirective {
    public function name(): string {
        return 'bcrypt';
    }

    public function transform(mixed $argumentValue): mixed {
        // Chiffre la valeur avec bcrypt
        return Hash::make($argumentValue);
    }

    public static function definition(): string {
        return /** @lang GraphQL */ <<<'GRAPHQL'
        """
        Hash a given argument using bcrypt before storing it in the database.
        """
        directive @bcrypt on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
        GRAPHQL;
    }
}