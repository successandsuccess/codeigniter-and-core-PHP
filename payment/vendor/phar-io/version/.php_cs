<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->files()
    ->in('src')
    ->in('tests')
    ->name('*.php');

return Symfony\CS\Config\Config::create()
    ->setUsingCache(true)
    ->level(\Symfony\CS\FixerInterface::NONE_LEVEL)
    ->fixers(
        array(
            'align_double_arrow',
            'align_equals',
            'concat_with_spaces',
            'duplicate_semicolon',
            'elseif',
            'empty_return',
            'encoding',
            'eof_ending',
            'extra_empty_lines',
            'function_call_space',
            'function_declaration',
            'indentation',
            'join_function',
            'line_after_namespace',
            'linefeed',
            'list_commas',
            'lowercase_constants',
            'lowercase_keywords',
            'method_argument_space',
            'multiple_use',
            'namespace_no_leading_whitespace',
            'no_blank_lines_after_class_opening',
            'no_empty_lines_after_phpdocs',
            'parenthesis',
            'php_closing_tag',
            'phpdoc_indent',
            'phpdoc_no_access',
            'phpdoc_no_empty_return',
            'phpdoc_no_package',
            'phpdoc_params',
            'phpdoc_scalar',
            'phpdoc_separation',
            'phpdoc_to_comment',
            'phpdoc_trim',
            'phpdoc_types',
            'phpdoc_var_without_name',
            'remove_lines_between_uses',
            'return',
            'self_accessor',
            'short_array_syntax',
            'short_tag',
            'single_line_after_imports',
            'single_quote',
            'spaces_before_semicolon',
            'spaces_cast',
            'ternary_spaces',
            'trailing_spaces',
            'trim_array_spaces',
            'unused_use',
            'visibility',
            'whitespacy_lines'
        )
    )
    ->finder($finder);

