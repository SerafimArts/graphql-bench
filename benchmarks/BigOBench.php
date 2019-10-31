<?php

/**
 * @BeforeMethods({"setUp"})
 * @OutputTimeUnit("milliseconds", precision=3)
 * @Warmup(1)
 * @Revs(2)
 * @Iterations(2)
 */
class BigOBench
{
    private $webonyxSource10;
    private $webonyxSource100;
    private $webonyxSource200;

    private $digiaSource10;
    private $digiaSource100;
    private $digiaSource200;

    private $railtSource10;
    private $railtSource100;
    private $railtSource200;

    public function setUp()
    {
        $str10 = file_get_contents(__DIR__ . '/resources/schema_10types.graphqls');
        $str100 = file_get_contents(__DIR__ . '/resources/schema_100types.graphqls');
        $str200 = file_get_contents(__DIR__ . '/resources/schema_200types.graphqls');

        $this->webonyxSource10 = new \GraphQL\Language\Source($str10);
        $this->webonyxSource100 = new \GraphQL\Language\Source($str100);
        $this->webonyxSource200 = new \GraphQL\Language\Source($str200);

        $this->digiaSource10 = new \Digia\GraphQL\Language\Source($str10);
        $this->digiaSource100 = new \Digia\GraphQL\Language\Source($str100);
        $this->digiaSource200 = new \Digia\GraphQL\Language\Source($str200);

        $this->railtSource10 = \Phplrt\Source\File::fromSources($str10);
        $this->railtSource100 = \Phplrt\Source\File::fromSources($str100);
        $this->railtSource200 = \Phplrt\Source\File::fromSources($str200);
    }

    public function benchWebonyx10TypesSchema()
    {
        $lexer = new \GraphQL\Language\Lexer($this->webonyxSource10);
        do {
            $token = $lexer->advance();
        } while ($token->kind !== \GraphQL\Language\Token::EOF);
    }

    public function benchWebonyx100TypesSchema()
    {
        $lexer = new \GraphQL\Language\Lexer($this->webonyxSource100);
        do {
            $token = $lexer->advance();
        } while ($token->kind !== \GraphQL\Language\Token::EOF);
    }

    public function benchWebonyx200TypesSchema()
    {
        $lexer = new \GraphQL\Language\Lexer($this->webonyxSource200);
        do {
            $token = $lexer->advance();
        } while ($token->kind !== \GraphQL\Language\Token::EOF);
    }

    public function benchDigia10TypesSchema()
    {
        $lexer = new \Digia\GraphQL\Language\Lexer($this->digiaSource10, []);
        do {
            $token = $lexer->advance();
        } while ($token->getKind() !== \Digia\GraphQL\Language\TokenKindEnum::EOF);
    }

    public function benchDigia100TypesSchema()
    {
        $lexer = new \Digia\GraphQL\Language\Lexer($this->digiaSource100, []);
        do {
            $token = $lexer->advance();
        } while ($token->getKind() !== \Digia\GraphQL\Language\TokenKindEnum::EOF);
    }

    public function benchDigia200TypesSchema()
    {
        $lexer = new \Digia\GraphQL\Language\Lexer($this->digiaSource200, []);
        do {
            $token = $lexer->advance();
        } while ($token->getKind() !== \Digia\GraphQL\Language\TokenKindEnum::EOF);
    }

    public function benchRailt10TypesSchema()
    {
        $lexer = (new \Railt\Parser\Runtime\Lexer())->lex($this->railtSource10);

        while ($lexer->valid()) {
            $lexer->next();
        }
    }

    public function benchRailt100TypesSchema()
    {
        $lexer = (new \Railt\Parser\Runtime\Lexer())->lex($this->railtSource100);
        while ($lexer->valid()) {
            $lexer->next();
        }
    }

    public function benchRailt200TypesSchema()
    {
        $lexer = (new \Railt\Parser\Runtime\Lexer())->lex($this->railtSource200);
        while ($lexer->valid()) {
            $lexer->next();
        }
    }
}
