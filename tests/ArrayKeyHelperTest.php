<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Daniel Leppänen
 */
class ArrayKeyHelperTest extends TestCase
{
    protected $testArray = [
        'UPPERCASE'     => true,
        'lowercase'     => true,
        'iNVERTER'      => true,
        'Pascal'        => true,
        'PascalCat'     => true,
        'kebab-case'    => true,
        'snake_case'    => true,
        'DEEP_ARRAY' => [
            'UPPERCASE'     => true,
            'lowercase'     => true,
            'iNVERTER'      => true,
            'Pascal'        => true,
            'PascalCat'     => true,
            'kebab-case'    => true,
            'snake_case'    => true,
        ]
    ];

    /**
     * @covers array_keys_to_camel_case()
     * @group array_keys
     */
    public function test_array_keys_to_camel_case()
    {
        $this->assertEquals([
            'uPPERCASE' => true,
            'lowercase' => true,
            'iNVERTER'  => true,
            'pascal'    => true,
            'pascalCat' => true,
            'kebabCase' => true,
            'snakeCase' => true,
            'dEEPARRAY' => [
                'uPPERCASE' => true,
                'lowercase' => true,
                'iNVERTER'  => true,
                'pascal'    => true,
                'pascalCat' => true,
                'kebabCase' => true,
                'snakeCase' => true,
            ]
        ], array_keys_to_camel_case($this->testArray));
    }

    /**
     * @covers array_keys_to_snake_case()
     * @group array_keys
     */
    public function test_array_keys_to_snake_case()
    {
        $this->assertEquals([
            'u_p_p_e_r_c_a_s_e' => true,
            'lowercase'         => true,
            'i_n_v_e_r_t_e_r'   => true,
            'pascal'            => true,
            'pascal_cat'        => true,
            'kebab_case'        => true,
            'snake_case'        => true,
            'd_e_e_p__a_r_r_a_y' => [
                'u_p_p_e_r_c_a_s_e'     => true,
                'lowercase'             => true,
                'i_n_v_e_r_t_e_r'       => true,
                'pascal'                => true,
                'pascal_cat'            => true,
                'kebab_case'            => true,
                'snake_case'            => true,
            ]
        ], array_keys_to_snake_case($this->testArray));
    }

    /**
     * @covers array_keys_to_ucfirst()
     * @group array_keys
     */
    public function test_array_keys_to_ucfirst()
    {
        $this->assertEquals([
            'UPPERCASE'     => true,
            'Lowercase'     => true,
            'INVERTER'      => true,
            'Pascal'        => true,
            'PascalCat'     => true,
            'Kebab-case'    => true,
            'Snake_case'    => true,
            'DEEP_ARRAY' => [
                'UPPERCASE'     => true,
                'Lowercase'     => true,
                'INVERTER'      => true,
                'Pascal'        => true,
                'PascalCat'     => true,
                'Kebab-case'    => true,
                'Snake_case'    => true,
            ]
        ], array_keys_to_ucfirst($this->testArray));
    }

    /**
     * @covers array_keys_to_lcfirst()
     * @group array_keys
     */
    public function test_array_keys_to_lcfirst()
    {
        $this->assertEquals([
            'uPPERCASE'     => true,
            'lowercase'     => true,
            'iNVERTER'      => true,
            'pascal'        => true,
            'pascalCat'     => true,
            'kebab-case'    => true,
            'snake_case'    => true,
            'dEEP_ARRAY' => [
                'uPPERCASE'     => true,
                'lowercase'     => true,
                'iNVERTER'      => true,
                'pascal'        => true,
                'pascalCat'     => true,
                'kebab-case'    => true,
                'snake_case'    => true,
            ]
        ], \Halpdesk\Helpers\array_keys_to_lcfirst($this->testArray));
    }
}
