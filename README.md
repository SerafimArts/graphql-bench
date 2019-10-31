# Benchmark of graphql implementations

Comparing performance of `webonyx/graphql-php`, `digiaonline/graphql-php` and `railt/railt` Lexers.

## Installation

```sh
composer install
```

## Benchmarks

Results here: https://github.com/SerafimArts/graphql-bench/actions

### Introspection
Compares Lexer performance on GraphQL [introspection](benchmarks/resources/introspection.graphql) query.

```sh
composer bench-introspection
```

Last result:
```
+--------------------+--------------------------------+--------+--------+------+-----+------------+---------+---------+---------+---------+---------+--------+-------+
| benchmark          | subject                        | groups | params | revs | its | mem_peak   | best    | mean    | mode    | worst   | stdev   | rstdev | diff  |
+--------------------+--------------------------------+--------+--------+------+-----+------------+---------+---------+---------+---------+---------+--------+-------+
| IntrospectionBench | benchWebonyxIntrospectionQuery |        | []     | 2    | 2   | 1,494,256b | 0.813ms | 0.817ms | 0.817ms | 0.822ms | 0.005ms | 0.58%  | 1.84x |
| IntrospectionBench | benchDigiaIntrospectionQuery   |        | []     | 2    | 2   | 1,522,400b | 4.246ms | 4.275ms | 4.275ms | 4.304ms | 0.029ms | 0.67%  | 9.63x |
| IntrospectionBench | benchRailtIntrospectionQuery   |        | []     | 2    | 2   | 1,828,560b | 0.444ms | 0.444ms | 0.444ms | 0.444ms | 0.000ms | 0.06%  | 1.00x |
+--------------------+--------------------------------+--------+--------+------+-----+------------+---------+---------+---------+---------+---------+--------+-------+
```

### BigO
Compares Lexer performance using schema defined as SDL(with 
[10](benchmarks/resources/schema_10types.graphqls), 
[100](benchmarks/resources/schema_100types.graphqls) and 
[200](benchmarks/resources/schema_200types.graphqls) types)

```sh
composer bench-bigo
```

Last result:
```
+-----------+----------------------------+--------+--------+------+-----+-------------+-------------+-------------+-------------+-------------+---------+--------+-----------+
| benchmark | subject                    | groups | params | revs | its | mem_peak    | best        | mean        | mode        | worst       | stdev   | rstdev | diff      |
+-----------+----------------------------+--------+--------+------+-----+-------------+-------------+-------------+-------------+-------------+---------+--------+-----------+
| BigOBench | benchWebonyx10TypesSchema  |        | []     | 2    | 2   | 1,748,608b  | 1.518ms     | 1.527ms     | 1.527ms     | 1.537ms     | 0.010ms | 0.62%  | 1.93x     |
| BigOBench | benchWebonyx100TypesSchema |        | []     | 2    | 2   | 3,837,536b  | 15.306ms    | 15.375ms    | 15.375ms    | 15.445ms    | 0.070ms | 0.45%  | 19.45x    |
| BigOBench | benchWebonyx200TypesSchema |        | []     | 2    | 2   | 6,162,208b  | 30.518ms    | 30.642ms    | 30.642ms    | 30.766ms    | 0.124ms | 0.40%  | 38.76x    |
| BigOBench | benchDigia10TypesSchema    |        | []     | 2    | 2   | 1,755,032b  | 11.303ms    | 11.485ms    | 11.484ms    | 11.667ms    | 0.182ms | 1.58%  | 14.53x    |
| BigOBench | benchDigia100TypesSchema   |        | []     | 2    | 2   | 3,843,968b  | 977.666ms   | 977.699ms   | 977.699ms   | 977.733ms   | 0.034ms | 0.00%  | 1,236.81x |
| BigOBench | benchDigia200TypesSchema   |        | []     | 2    | 2   | 6,168,640b  | 3,893.302ms | 3,893.998ms | 3,893.997ms | 3,894.695ms | 0.697ms | 0.02%  | 4,925.99x |
| BigOBench | benchRailt10TypesSchema    |        | []     | 2    | 2   | 2,209,192b  | 0.776ms     | 0.791ms     | 0.791ms     | 0.805ms     | 0.015ms | 1.83%  | 1.00x     |
| BigOBench | benchRailt100TypesSchema   |        | []     | 2    | 2   | 7,549,136b  | 7.888ms     | 8.103ms     | 8.103ms     | 8.318ms     | 0.215ms | 2.65%  | 10.25x    |
| BigOBench | benchRailt200TypesSchema   |        | []     | 2    | 2   | 13,489,680b | 16.148ms    | 16.150ms    | 16.150ms    | 16.153ms    | 0.003ms | 0.02%  | 20.43x    |
+-----------+----------------------------+--------+--------+------+-----+-------------+-------------+-------------+-------------+-------------+---------+--------+-----------+
```

### Conclusion:

Webonyx Lexer is O(N), Digia Lexer is O(N^2)

P.S. Railt Lexer is O(N/2)? =)))
