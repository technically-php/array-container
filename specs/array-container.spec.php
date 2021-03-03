<?php

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Technically\ArrayContainer\Exceptions\ServiceNotFound;
use Technically\ArrayContainer\ArrayContainer;

describe('ArrayContainer', function() {

    it('should instantiate a new instance', function() {
        $container = new ArrayContainer();
        assert($container instanceof ArrayContainer);
    });

    it('should implement PSR container interface', function() {
        $container = new ArrayContainer();
        assert($container instanceof ContainerInterface);
    });

    it('should instantiate a new instance with array of entries', function() {
        $container = new ArrayContainer([
            'a' => 'A',
            'b' => 'B',
        ]);
        assert($container->has('a'));
        assert($container->has('b'));
        assert($container->toArray() === [
            'a' => 'A',
            'b' => 'B',
        ]);
    });

    describe('->has()', function() {
        it('should return true for defined entries', function () {
            $container = new ArrayContainer([
                'a' => 'A',
                'b' => 'B',
            ]);

            assert($container->has('a') === true);
            assert($container->has('b') === true);
        });
        it('should return false for entries not defined', function () {
            $container = new ArrayContainer([
                'a' => 'A',
                'b' => 'B',
            ]);

            assert($container->has('A') === false);
            assert($container->has('B') === false);
        });
    });

    describe('->get()', function() {
        it('should return entries by identifier', function () {
            $now = new DateTime('now');
            $container = new ArrayContainer([
                'greeting' => 'Hello',
                'date'     => $now,
            ]);

            assert($container->get('greeting') === 'Hello');
            assert($container->get('date') === $now);
        });

        it('should throw ServiceNotFound exception for entries not defined', function () {
            $container = new ArrayContainer(['a' => 'A']);

            assert($container->has('b') === false);

            try {
                $container->get('b');
            } catch (ServiceNotFound $exception) {
                // passthru
            }

            assert(isset($exception));
            assert($exception instanceof ServiceNotFound);
            assert($exception instanceof NotFoundExceptionInterface);
        });
    });

    describe('->set()', function() {
        it('should set entries for identifier', function () {
            $now = new DateTime('now');
            $container = new ArrayContainer();

            assert($container->has('date') === false);

            $container->set('date', $now);

            assert($container->has('date') === true);
            assert($container->get('date') === $now);
        });

        it('should overwrite previously defined entries for the same identifier', function () {
            $container = new ArrayContainer(['a' => 'A']);

            assert($container->get('a') === 'A');

            $container->set('a', 'B');

            assert($container->get('a') === 'B');
        });
    });

    describe('->toArray()', function() {
        it('should return all container entries in array', function () {
            $container = new ArrayContainer(['a' => 'A']);

            assert($container->toArray() === ['a' => 'A']);

            $container->set('b', 'B');

            assert($container->toArray() === ['a' => 'A', 'b' => 'B']);
        });
    });
});
