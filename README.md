## Coding Standards
Over 200 sniffs with additional checks and code analysis (eg. detecting unreachable code, unused variables, etc).

The rule set is located in `coding-standard/Everon/ruleset.xml`.

### Installation
Installation with composer.

`composer require everon/coding-standard --dev`

### Configuration
After installation create your own rule set under `<project dir>phpcs.xml`.

Project's configuration example.

```
<?xml version="1.0"?>
<ruleset name="Everon">

    <exclude-pattern>*/tests/App/*</exclude-pattern>
    <exclude-pattern>*/tests/logs/*</exclude-pattern>

    <rule ref="Everon"/>
    <rule ref="Everon.Files.TypeNameMatchesFileName">
        <properties>
            <property name="rootNamespaces" type="array"
                      value="src/App=>App,tests/App=>Tests\App"/>
            <property name="skipDirs" type="array"
                      value="tests/App/Generated"/>
            <property name="extensions" type="array"
                      value="php"/>
        </properties>
    </rule>

</ruleset>
```

Configuring `rootNamespaces` will allow for the sniffs to automatically expand and take care of FQCN. 

### Coding Standards Usage
The rules are installed by composer post-install command automatically.
But if you need to, you can run it manually with `cs-setup`. 
Once it has been executed you can start using other coding standard commands.

```
  vendor/bin/cs-check    Checks and reports coding style violations
  vendor/bin/cs-fix      Fixes coding style violations automatically
  vendor/bin/cs-list     Show coding standard rules
  vendor/bin/cs-setup    Execute once to setup coding standard rules
```


#### cs-check
By default it will look for code under `src` directory.
It can be overwritten from the command line.

`vendor/bin/cs-check [<path>]`


#### cs-fix
By default it will look for code under `src` directory.
It can be overwritten from the command line.

`vendor/bin/cs-fix [<path>]`


#### cs-list
List available coding standard rules.

`vendor/bin/cs-list`

#### cs-setup
Run once in order to setup the coding standard. 
Usually it's not needed to run it, as composer post-install does it.

`vendor/bin/cs-setup`

## Sniffs
    The EveronCodingStandard standard contains 118 sniffs

    Everon (1 sniff)
    -----------------
      Everon.Files.TypeNameMatchesFileName
    
    Generic (22 sniffs)
    -------------------
      Generic.Arrays.DisallowLongArraySyntax
      Generic.CodeAnalysis.ForLoopShouldBeWhileLoop
      Generic.CodeAnalysis.ForLoopWithTestFunctionCall
      Generic.CodeAnalysis.JumbledIncrementer
      Generic.CodeAnalysis.UnconditionalIfStatement
      Generic.CodeAnalysis.UnnecessaryFinalModifier
      Generic.ControlStructures.InlineControlStructure
      Generic.Files.ByteOrderMark
      Generic.Files.LineEndings
      Generic.Files.LineLength
      Generic.Formatting.DisallowMultipleStatements
      Generic.Formatting.NoSpaceAfterCast
      Generic.Functions.FunctionCallArgumentSpacing
      Generic.NamingConventions.UpperCaseConstantName
      Generic.PHP.DeprecatedFunctions
      Generic.PHP.DisallowShortOpenTag
      Generic.PHP.ForbiddenFunctions
      Generic.PHP.LowerCaseConstant
      Generic.PHP.LowerCaseKeyword
      Generic.PHP.NoSilencedErrors
      Generic.WhiteSpace.DisallowTabIndent
      Generic.WhiteSpace.ScopeIndent
    
    PEAR (4 sniffs)
    ---------------
      PEAR.Classes.ClassDeclaration
      PEAR.ControlStructures.ControlSignature
      PEAR.Functions.ValidDefaultValue
      PEAR.NamingConventions.ValidClassName
    
    PSR1 (3 sniffs)
    ---------------
      PSR1.Classes.ClassDeclaration
      PSR1.Files.SideEffects
      PSR1.Methods.CamelCapsMethodName
    
    PSR2 (12 sniffs)
    ----------------
      PSR2.Classes.ClassDeclaration
      PSR2.Classes.PropertyDeclaration
      PSR2.ControlStructures.ControlStructureSpacing
      PSR2.ControlStructures.ElseIfDeclaration
      PSR2.ControlStructures.SwitchDeclaration
      PSR2.Files.ClosingTag
      PSR2.Files.EndFileNewline
      PSR2.Methods.FunctionCallSignature
      PSR2.Methods.FunctionClosingBrace
      PSR2.Methods.MethodDeclaration
      PSR2.Namespaces.NamespaceDeclaration
      PSR2.Namespaces.UseDeclaration
    
    SlevomatCodingStandard (50 sniffs)
    ----------------------------------
      SlevomatCodingStandard.Arrays.TrailingArrayComma
      SlevomatCodingStandard.Classes.ClassConstantVisibility
      SlevomatCodingStandard.Classes.UnusedPrivateElements
      SlevomatCodingStandard.Commenting.DisallowOneLinePropertyDocComment
      SlevomatCodingStandard.Commenting.DocCommentSpacing
      SlevomatCodingStandard.Commenting.EmptyComment
      SlevomatCodingStandard.Commenting.ForbiddenAnnotations
      SlevomatCodingStandard.Commenting.ForbiddenComments
      SlevomatCodingStandard.Commenting.InlineDocCommentDeclaration
      SlevomatCodingStandard.Commenting.RequireOneLinePropertyDocComment
      SlevomatCodingStandard.ControlStructures.AssignmentInCondition
      SlevomatCodingStandard.ControlStructures.DisallowEmpty
      SlevomatCodingStandard.ControlStructures.DisallowEqualOperators
      SlevomatCodingStandard.ControlStructures.DisallowShortTernaryOperator
      SlevomatCodingStandard.ControlStructures.DisallowYodaComparison
      SlevomatCodingStandard.ControlStructures.EarlyExit
      SlevomatCodingStandard.ControlStructures.LanguageConstructWithParentheses
      SlevomatCodingStandard.ControlStructures.NewWithParentheses
      SlevomatCodingStandard.ControlStructures.RequireNullCoalesceOperator
      SlevomatCodingStandard.ControlStructures.RequireShortTernaryOperator
      SlevomatCodingStandard.ControlStructures.RequireYodaComparison
      SlevomatCodingStandard.Exceptions.DeadCatch
      SlevomatCodingStandard.Exceptions.ReferenceThrowableOnly
      SlevomatCodingStandard.Files.TypeNameMatchesFileName
      SlevomatCodingStandard.Namespaces.AlphabeticallySortedUses
      SlevomatCodingStandard.Namespaces.DisallowGroupUse
      SlevomatCodingStandard.Namespaces.FullyQualifiedClassNameAfterKeyword
      SlevomatCodingStandard.Namespaces.FullyQualifiedClassNameInAnnotation
      SlevomatCodingStandard.Namespaces.FullyQualifiedExceptions
      SlevomatCodingStandard.Namespaces.FullyQualifiedGlobalConstants
      SlevomatCodingStandard.Namespaces.FullyQualifiedGlobalFunctions
      SlevomatCodingStandard.Namespaces.MultipleUsesPerLine
      SlevomatCodingStandard.Namespaces.NamespaceDeclaration
      SlevomatCodingStandard.Namespaces.NamespaceSpacing
      SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly
      SlevomatCodingStandard.Namespaces.RequireOneNamespaceInFile
      SlevomatCodingStandard.Namespaces.UnusedUses
      SlevomatCodingStandard.Namespaces.UseDoesNotStartWithBackslash
      SlevomatCodingStandard.Namespaces.UseFromSameNamespace
      SlevomatCodingStandard.Namespaces.UseSpacing
      SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators
      SlevomatCodingStandard.PHP.ShortList
      SlevomatCodingStandard.PHP.TypeCast
      SlevomatCodingStandard.TypeHints.DeclareStrictTypes
      SlevomatCodingStandard.TypeHints.LongTypeHints
      SlevomatCodingStandard.TypeHints.NullableTypeForNullDefaultValue
      SlevomatCodingStandard.TypeHints.ParameterTypeHintSpacing
      SlevomatCodingStandard.TypeHints.ReturnTypeHintSpacing
      SlevomatCodingStandard.TypeHints.TypeHintDeclaration
      SlevomatCodingStandard.Types.EmptyLinesAroundTypeBraces
    
    Squiz (26 sniffs)
    -----------------
      Squiz.Arrays.ArrayBracketSpacing
      Squiz.Classes.LowercaseClassKeywords
      Squiz.Classes.ValidClassName
      Squiz.Commenting.DocCommentAlignment
      Squiz.ControlStructures.ControlSignature
      Squiz.ControlStructures.ForEachLoopDeclaration
      Squiz.ControlStructures.ForLoopDeclaration
      Squiz.ControlStructures.LowercaseDeclaration
      Squiz.Functions.FunctionDeclaration
      Squiz.Functions.FunctionDeclarationArgumentSpacing
      Squiz.Functions.LowercaseFunctionKeywords
      Squiz.Functions.MultiLineFunctionDeclaration
      Squiz.Operators.ValidLogicalOperators
      Squiz.PHP.Eval
      Squiz.PHP.NonExecutableCode
      Squiz.Scope.MemberVarScope
      Squiz.Scope.MethodScope
      Squiz.Scope.StaticThisUsage
      Squiz.WhiteSpace.ControlStructureSpacing
      Squiz.WhiteSpace.LanguageConstructSpacing
      Squiz.WhiteSpace.LogicalOperatorSpacing
      Squiz.WhiteSpace.MemberVarSpacing
      Squiz.WhiteSpace.ScopeClosingBrace
      Squiz.WhiteSpace.ScopeKeywordSpacing
      Squiz.WhiteSpace.SemicolonSpacing
      Squiz.WhiteSpace.SuperfluousWhitespace
