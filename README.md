# Benchmark of graphql implementations

Comparing performance of `webonyx/graphql-php` and `digiaonline/graphql-php` Lexers.

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
+--------------------+--------------------------------+--------+--------+------+-----+------------+----------+----------+----------+----------+---------+--------+-------+
| benchmark          | subject                        | groups | params | revs | its | mem_peak   | best     | mean     | mode     | worst    | stdev   | rstdev | diff  |
+--------------------+--------------------------------+--------+--------+------+-----+------------+----------+----------+----------+----------+---------+--------+-------+
| IntrospectionBench | benchWebonyxIntrospectionQuery |        | []     | 2    | 2   | 1,590,488b | 2.191ms  | 2.196ms  | 2.196ms  | 2.201ms  | 0.005ms | 0.24%  | 1.00x |
| IntrospectionBench | benchDigiaIntrospectionQuery   |        | []     | 2    | 2   | 1,553,344b | 11.224ms | 11.591ms | 11.590ms | 11.959ms | 0.368ms | 3.17%  | 5.28x |
+--------------------+--------------------------------+--------+--------+------+-----+------------+----------+----------+----------+----------+---------+--------+-------+
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
+-----------+----------------------------+--------+--------+------+-----+------------+-------------+-------------+-------------+-------------+----------+--------+-----------+
| benchmark | subject                    | groups | params | revs | its | mem_peak   | best        | mean        | mode        | worst       | stdev    | rstdev | diff      |
+-----------+----------------------------+--------+--------+------+-----+------------+-------------+-------------+-------------+-------------+----------+--------+-----------+
| BigOBench | benchWebonyx10TypesSchema  |        | []     | 2    | 2   | 1,778,208b | 3.837ms     | 3.888ms     | 3.888ms     | 3.938ms     | 0.051ms  | 1.30%  | 1.00x     |
| BigOBench | benchWebonyx100TypesSchema |        | []     | 2    | 2   | 3,867,136b | 39.267ms    | 39.283ms    | 39.283ms    | 39.300ms    | 0.017ms  | 0.04%  | 10.11x    |
| BigOBench | benchWebonyx200TypesSchema |        | []     | 2    | 2   | 6,191,808b | 77.249ms    | 77.615ms    | 77.616ms    | 77.982ms    | 0.367ms  | 0.47%  | 19.97x    |
| BigOBench | benchDigia10TypesSchema    |        | []     | 2    | 2   | 1,769,760b | 24.657ms    | 24.846ms    | 24.845ms    | 25.035ms    | 0.189ms  | 0.76%  | 6.39x     |
| BigOBench | benchDigia100TypesSchema   |        | []     | 2    | 2   | 3,858,696b | 1,416.791ms | 1,419.569ms | 1,419.563ms | 1,422.346ms | 2.778ms  | 0.20%  | 365.16x   |
| BigOBench | benchDigia200TypesSchema   |        | []     | 2    | 2   | 6,183,368b | 5,437.041ms | 5,456.733ms | 5,456.694ms | 5,476.425ms | 19.692ms | 0.36%  | 1,403.66x |
+-----------+----------------------------+--------+--------+------+-----+------------+-------------+-------------+-------------+-------------+----------+--------+-----------+
```

### Conclusion:
Webonyx Lexer is O(N), Digia Lexer is O(N^2)
