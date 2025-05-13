<?php

namespace App\Services;

use App\Enum\StatisticsKey;

use Illuminate\Support\Facades\Redis;

final class StatisticsService {

    public final function __construct() {

        if (!$this->isset(StatisticsKey::StartDate)) {

            $this->set(StatisticsKey::StartDate, now()->toDateTimeString());
        }
    }

    public final function all(array $additionalKeys = []): array {

        $keys = array_merge(StatisticsKey::cases(), $additionalKeys);

        return array_combine(
            array_map(fn(string|StatisticsKey $key) => is_string($key) ? $key : $key->value, $keys),
            array_map(fn(string|StatisticsKey $key) => $this->get($key), $keys),
        );
    }

    public final function get(string|StatisticsKey $key): ?string {

        $key = is_string($key) ? StatisticsKey::tryFrom($key) ?? $key : $key;

        if (!is_null($value = Redis::get(is_string($key) ? $key : $key->value))) {

            return $value;
        }

        if ($key instanceof StatisticsKey) {

            $value = $key->getInitialValue();

            $this->set($key, $value);
        }

        return $value;
    }

    public final function delete(string|StatisticsKey $key): void {

        Redis::del(is_string($key) ? $key : $key->value);
    }

    public final function isset(string|StatisticsKey $key): bool {

        $key = is_string($key) ? $key : $key->value;

        return !is_null($this->get($key));
    }

    public final function set(string|StatisticsKey $key, string|callable $value): void {

        if (is_callable($value)) {

            $this->set($key, $value($this->get($key)));

            return;
        }

        $key = is_string($key) ? $key : $key->value;

        Redis::set($key, $value);
    }

    public final function increment(string|StatisticsKey $key, int $increment = 1): void {

        $this->set($key, fn (int $count) => $count + $increment);
    }

    public final function decrement(string|StatisticsKey $key, int $decrement = 1): void {

        $this->set($key, fn (int $count) => $count - $decrement);
    }

    public final function clear(): void {

        foreach (StatisticsKey::cases() as $key) {

            $this->delete($key);
        }
    }
}
