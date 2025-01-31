<?php
/**
 * Tests for the \PHP_CodeSniffer\Files\File::getMemberProperties method.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\File;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

/**
 * Tests for the \PHP_CodeSniffer\Files\File::getMemberProperties method.
 *
 * @covers \PHP_CodeSniffer\Files\File::getMemberProperties
 */
class GetMemberPropertiesTest extends AbstractMethodUnitTest
{


    /**
     * Test the getMemberProperties() method.
     *
     * @param string $identifier Comment which precedes the test case.
     * @param bool   $expected   Expected function output.
     *
     * @dataProvider dataGetMemberProperties
     *
     * @return void
     */
    public function testGetMemberProperties($identifier, $expected)
    {
        $variable = $this->getTargetToken($identifier, T_VARIABLE);
        $result   = self::$phpcsFile->getMemberProperties($variable);

        // Unset those indexes which are not being tested.
        unset($result['type_token'], $result['type_end_token']);

        $this->assertSame($expected, $result);

    }//end testGetMemberProperties()


    /**
     * Data provider for the GetMemberProperties test.
     *
     * @see testGetMemberProperties()
     *
     * @return array
     */
    public function dataGetMemberProperties()
    {
        return [
            [
                '/* testVar */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testVarType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?int',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPublic */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPublicType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'string',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testProtected */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testProtectedType */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'bool',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPrivate */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPrivateType */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'array',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testStatic */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testStaticType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '?string',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testStaticVar */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testVarStatic */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPublicStatic */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testProtectedStatic */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPrivateStatic */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testNoPrefix */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPublicStaticWithDocblock */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testProtectedStaticWithDocblock */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPrivateStaticWithDocblock */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupType 1 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'float',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupType 2 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'float',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupNullableType 1 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '?string',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testGroupNullableType 2 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '?string',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testGroupProtectedStatic 1 */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupProtectedStatic 2 */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupProtectedStatic 3 */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 1 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 2 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 3 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 4 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 5 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 6 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testGroupPrivate 7 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testMessyNullableType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?array',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testNamespaceType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '\MyNamespace\MyClass',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testNullableNamespaceType 1 */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?ClassName',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testNullableNamespaceType 2 */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?Folder\ClassName',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testMultilineNamespaceType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '\MyNamespace\MyClass\Foo',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPropertyAfterMethod */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testInterfaceProperty */',
                [],
            ],
            [
                '/* testNestedProperty 1 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testNestedProperty 2 */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8MixedTypeHint */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => 'miXed',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8MixedTypeHintNullable */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?mixed',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testNamespaceOperatorTypeHint */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?namespace\Name',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP8UnionTypesSimple */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'int|float',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8UnionTypesTwoClasses */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'MyClassA|\Package\MyClassB',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8UnionTypesAllBaseTypes */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'array|bool|int|float|NULL|object|string',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8UnionTypesAllPseudoTypes */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'false|mixed|self|parent|iterable|Resource',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8UnionTypesIllegalTypes */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'callable|void',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8UnionTypesNullable */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?int|float',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP8PseudoTypeNull */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'null',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8PseudoTypeFalse */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'false',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8PseudoTypeFalseAndBool */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'bool|FALSE',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8ObjectAndClass */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'object|ClassName',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8PseudoTypeIterableAndArray */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'iterable|array|Traversable',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8DuplicateTypeInUnionWhitespaceAndComment */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'int|string|INT',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81Readonly */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => 'int',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81ReadonlyWithNullableType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => '?array',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP81ReadonlyWithUnionType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => 'string|int',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81ReadonlyWithUnionTypeWithNull */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => 'string|null',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81OnlyReadonlyWithUnionType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => 'string|int',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8PropertySingleAttribute */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'string',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP8PropertyMultipleAttributes */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?int|float',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP8PropertyMultilineAttribute */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'mixed',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testEnumProperty */',
                [],
            ],
            [
                '/* testPHP81IntersectionTypes */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'Foo&Bar',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81MoreIntersectionTypes */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'Foo&Bar&Baz',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81IllegalIntersectionTypes */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'int&string',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP81NullableIntersectionType */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => '?Foo&Bar',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP82PseudoTypeTrue */',
                [
                    'scope'           => 'public',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'true',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP82NullablePseudoTypeTrue */',
                [
                    'scope'           => 'protected',
                    'scope_specified' => true,
                    'is_static'       => true,
                    'is_readonly'     => false,
                    'type'            => '?true',
                    'nullable_type'   => true,
                ],
            ],
            [
                '/* testPHP82PseudoTypeTrueInUnion */',
                [
                    'scope'           => 'private',
                    'scope_specified' => true,
                    'is_static'       => false,
                    'is_readonly'     => false,
                    'type'            => 'int|string|true',
                    'nullable_type'   => false,
                ],
            ],
            [
                '/* testPHP82PseudoTypeFalseAndTrue */',
                [
                    'scope'           => 'public',
                    'scope_specified' => false,
                    'is_static'       => false,
                    'is_readonly'     => true,
                    'type'            => 'true|FALSE',
                    'nullable_type'   => false,
                ],
            ],

        ];

    }//end dataGetMemberProperties()


    /**
     * Test receiving an expected exception when a non property is passed.
     *
     * @param string $identifier Comment which precedes the test case.
     *
     * @dataProvider dataNotClassProperty
     *
     * @return void
     */
    public function testNotClassPropertyException($identifier)
    {
        $msg       = '$stackPtr is not a class member var';
        $exception = 'PHP_CodeSniffer\Exceptions\RuntimeException';

        if (\method_exists($this, 'expectException') === true) {
            // PHPUnit 5+.
            $this->expectException($exception);
            $this->expectExceptionMessage($msg);
        } else {
            // PHPUnit 4.
            $this->setExpectedException($exception, $msg);
        }

        $variable = $this->getTargetToken($identifier, T_VARIABLE);
        $result   = self::$phpcsFile->getMemberProperties($variable);

    }//end testNotClassPropertyException()


    /**
     * Data provider for the NotClassPropertyException test.
     *
     * @see testNotClassPropertyException()
     *
     * @return array
     */
    public function dataNotClassProperty()
    {
        return [
            ['/* testMethodParam */'],
            ['/* testImportedGlobal */'],
            ['/* testLocalVariable */'],
            ['/* testGlobalVariable */'],
            ['/* testNestedMethodParam 1 */'],
            ['/* testNestedMethodParam 2 */'],
            ['/* testEnumMethodParamNotProperty */'],
        ];

    }//end dataNotClassProperty()


    /**
     * Test receiving an expected exception when a non variable is passed.
     *
     * @return void
     */
    public function testNotAVariableException()
    {
        $msg       = '$stackPtr must be of type T_VARIABLE';
        $exception = 'PHP_CodeSniffer\Exceptions\RuntimeException';

        if (\method_exists($this, 'expectException') === true) {
            // PHPUnit 5+.
            $this->expectException($exception);
            $this->expectExceptionMessage($msg);
        } else {
            // PHPUnit 4.
            $this->setExpectedException($exception, $msg);
        }

        $next   = $this->getTargetToken('/* testNotAVariable */', T_RETURN);
        $result = self::$phpcsFile->getMemberProperties($next);

    }//end testNotAVariableException()


}//end class
